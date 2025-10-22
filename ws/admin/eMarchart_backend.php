<?php

include('client-header-contents.php');

$uryyToeSS4 = isset($_GET['uryyToeSS4']) ? $_GET['uryyToeSS4'] : '';
if (empty($uryyToeSS4)) die("Error: Missing authentication token.");
$uryyToeSS4 = $conn->real_escape_string($uryyToeSS4);
$varCompanyId = $_SESSION['usr_compId'];

// Start and end month
$startMonth = isset($_GET['startMonth']) ? $_GET['startMonth'] : date('Y-m');
$endMonth   = isset($_GET['endMonth']) ? $_GET['endMonth'] : date('Y-m');

$startDate = $startMonth . '-01';
$endDate   = date('Y-m-t', strtotime($endMonth));

$dose_order = [
    'Morning',
    'EM morning call',
    'Lunch',
    'EL lunch call',
    'Tea',
    'ET tea call',
    'Bed',
    'EB bed call'
];

// Fetch medications in range
$sql = "SELECT task_name, med_date, task_timeIn, task_note, col_dosage, care_calls, col_outcome 
        FROM tbl_finished_meds 
        WHERE uryyToeSS4 = ? 
        AND med_date BETWEEN ? AND ? 
        AND col_company_Id = ?
        ORDER BY med_date ASC, task_timeIn ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $uryyToeSS4, $startDate, $endDate, $varCompanyId);
$stmt->execute();
$result = $stmt->get_result();

$medications = [];
$allDates = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $med_name = $row['task_name'];
        $med_date = $row['med_date'];

        $medications[$med_name][$med_date][] = [
            'med_date' => $row['med_date'],
            'task_timeIn' => $row['task_timeIn'],
            'task_note' => $row['task_note'],
            'col_dosage' => $row['col_dosage'],
            'care_calls' => $row['care_calls'],
            'outcome' => $row['col_outcome']
        ];
        $allDates[$med_date] = $med_date;
    }
}

// Ensure all days are included for each month
$monthStart = strtotime($startDate);
$monthEnd   = strtotime($endDate);
for ($t = $monthStart; $t <= $monthEnd; $t = strtotime("+1 day", $t)) {
    $dateStr = date('Y-m-d', $t);
    $allDates[$dateStr] = $dateStr;
}
ksort($allDates);

$today_date = date('Y-m-d');

// Group dates by month
$months = [];
foreach ($allDates as $date) {
    $monthKey = date('Y-m', strtotime($date));
    $months[$monthKey][] = $date;
}

// Prepare analytics data
$analyticsData = [];
foreach ($months as $monthKey => $monthDates) {
    $taken = 0;
    $notTaken = 0;
    $pending = 0;

    foreach ($medications as $med_name => $med_dates) {
        foreach ($monthDates as $date) {
            if (isset($med_dates[$date])) {
                foreach ($med_dates[$date] as $entry) {
                    if ($entry['outcome'] === "Fully taken") $taken++;
                    else if ($entry['outcome'] === "Not taken") $notTaken++;
                    else $pending++;
                }
            } else {
                if ($date >= $today_date) $pending++;
            }
        }
    }

    $analyticsData['months'][] = date('F Y', strtotime($monthKey . '-01'));
    $analyticsData['taken'][] = $taken;
    $analyticsData['notTaken'][] = $notTaken;
    $analyticsData['pending'][] = $pending;
}
?>

<style>
    /* Landscape print */
    @media print {
        @page {
            size: landscape !important;
            margin: 10mm;
        }

        .month-card {
            page-break-inside: avoid;
            page-break-after: always;
        }

        .table td:first-child,
        .table th:first-child {
            max-width: 250px !important;
            word-wrap: break-word;
            white-space: normal;
        }

        #startMonth,
        #endMonth,
        #printBtn,
        #analyticsBtn,
        .breadcrumb,
        .page-header,
        .modal {
            display: none !important;
        }
    }

    .green-circle,
    .red-circle,
    .grey-circle {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 1px;
    }

    .green-circle {
        background-color: green;
    }

    .red-circle {
        background-color: red;
    }

    .grey-circle {
        background-color: grey;
    }

    /* Landscape print for analytics modal only */
    @media print {
        body * {
            visibility: hidden;
        }

        #analyticsModal,
        #analyticsModal * {
            visibility: visible;
        }

        #analyticsModal {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        #analyticsModal .modal-footer {
            display: none !important;
        }
    }
</style>