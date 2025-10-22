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
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="page-header-title">
                            <h5 class="m-b-10">
                                <?php
                                $stmt = $conn->prepare("SELECT client_first_name FROM tbl_general_client_form 
                                                        WHERE uryyToeSS4 = ? AND col_company_Id = ?");
                                $stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
                                $stmt->execute();
                                $stmt->bind_result($clientFirstName);
                                $stmt->fetch();
                                echo htmlspecialchars($clientFirstName, ENT_QUOTES, 'UTF-8') . "'s MarChart";
                                $stmt->close();
                                ?>
                            </h5>
                            <p style="margin-top: -10px;">Download eMarchart from start month to end month.</p>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i>Home</a></li>
                            <li class="breadcrumb-item"><a href="#!">Client</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-xl-6 col-sm-6 col-lg-6">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="startMonth">Start Month</label>
                                <input type="month" id="startMonth" class="form-control" value="<?= $startMonth ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="endMonth">End Month</label>
                                <input type="month" id="endMonth" class="form-control" value="<?= $endMonth ?>">
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button id="printBtn" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="printMarchart">
            <?php if (!empty($months)): ?>
                <?php foreach ($months as $monthKey => $monthDates): ?>
                    <div class="card table-card month-card mb-4"> <!-- Added month-card -->
                        <div class="card-header">
                            <h5><?= date('F Y', strtotime($monthDates[0])) ?></h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-left mb-0">
                                    <thead>
                                        <tr>
                                            <th>Medication Name</th>
                                            <?php foreach ($monthDates as $date_key): ?>
                                                <th><?= date('j', strtotime($date_key)) ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($medications as $med_name => $med_dates): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($med_name) ?></td>
                                                <?php foreach ($monthDates as $date_key): ?>
                                                    <td class="text-center">
                                                        <?php
                                                        if (isset($med_dates[$date_key])) {
                                                            $sorted_doses = [];
                                                            foreach ($dose_order as $label) {
                                                                foreach ($med_dates[$date_key] as $entry) {
                                                                    if ($entry['care_calls'] === $label) $sorted_doses[] = $entry;
                                                                }
                                                            }
                                                            foreach ($sorted_doses as $entry) {
                                                                $status = $entry['outcome'];
                                                                $colorClass = ($status === "Fully taken") ? "green-circle" : (($status === "Not taken") ? "red-circle" : "grey-circle");
                                                                echo '<span title="' . $entry['care_calls'] . ' - ' . $status . '" class="' . $colorClass . '" style="cursor:pointer;" ' .
                                                                    'data-med_date="' . $entry['med_date'] . '" ' .
                                                                    'data-task_timeIn="' . $entry['task_timeIn'] . '" ' .
                                                                    'data-task_note="' . htmlspecialchars($entry['task_note'], ENT_QUOTES) . '" ' .
                                                                    'data-col_dosage="' . htmlspecialchars($entry['col_dosage'], ENT_QUOTES) . '" ' .
                                                                    'data-care_calls="' . htmlspecialchars($entry['care_calls'], ENT_QUOTES) . '" ' .
                                                                    'data-toggle="modal" data-target="#medDetailModal"></span> ';
                                                            }
                                                        } else {
                                                            $circleClass = ($date_key < $today_date) ? 'red-circle' : 'grey-circle';
                                                            $title = ($date_key < $today_date) ? 'Missed' : 'Pending';
                                                            echo '<span title="' . $title . '" class="' . $circleClass . '"></span>';
                                                        }
                                                        ?>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No medication records found for the selected range.</p>
            <?php endif; ?>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="medDetailModal" tabindex="-1" role="dialog" aria-labelledby="medDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="medDetailModalLabel">Medication Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered justify-start items-start text-start">
                            <tr>
                                <th>Med Date</th>
                                <td id="modal-med-date"></td>
                            </tr>
                            <tr>
                                <th>Dose Label</th>
                                <td id="modal-dose-label"></td>
                            </tr>
                            <tr>
                                <th>Time In</th>
                                <td id="modal-task-timeIn"></td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td id="modal-task-note"></td>
                            </tr>
                            <tr>
                                <th>Dosage</th>
                                <td id="modal-col-dosage"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Limit medication name column width */
    .table td:first-child,
    .table th:first-child {
        max-width: 300px !important;
        word-wrap: break-word;
        white-space: normal;
    }

    /* Ensure each month starts on a new page when printing */
    .month-card {
        page-break-inside: avoid;
        page-break-after: always;
    }
</style>

<script type="text/javascript">
    $('#medDetailModal').on('show.bs.modal', function(event) {
        var span = $(event.relatedTarget);
        $('#modal-med-date').text(span.data('med_date'));
        $('#modal-dose-label').text(span.data('care_calls'));
        $('#modal-task-timeIn').text(span.data('task_timein'));
        $('#modal-task-note').text(span.data('task_note'));
        $('#modal-col-dosage').text(span.data('col_dosage'));
    });

    document.getElementById('startMonth').addEventListener('change', updateURL);
    document.getElementById('endMonth').addEventListener('change', updateURL);

    function updateURL() {
        var start = document.getElementById('startMonth').value;
        var end = document.getElementById('endMonth').value;
        window.location.href = window.location.pathname + '?uryyToeSS4=<?= urlencode($uryyToeSS4) ?>&startMonth=' + start + '&endMonth=' + end;
    }

    document.getElementById('printBtn').addEventListener('click', function() {
        var printContents = document.getElementById('printMarchart').innerHTML;

        var printWindow = window.open('', '', 'height=800,width=1200');
        printWindow.document.write('<html><head><title>Print eMarChart</title>');

        // Add landscape and table styles
        printWindow.document.write('<style>');
        printWindow.document.write('@page { size: landscape; margin: 10mm; }');
        printWindow.document.write('.table td:first-child, .table th:first-child { max-width: 250px !important; word-wrap: break-word; white-space: normal; }');
        printWindow.document.write('.green-circle { display:inline-block; width:12px; height:12px; background-color:green; border-radius:50%; margin:1px; }');
        printWindow.document.write('.red-circle { display:inline-block; width:12px; height:12px; background-color:red; border-radius:50%; margin:1px; }');
        printWindow.document.write('.grey-circle { display:inline-block; width:12px; height:12px; background-color:grey; border-radius:50%; margin:1px; }');
        printWindow.document.write('.month-card { page-break-inside: avoid; page-break-after: always; }');
        printWindow.document.write('</style>');

        printWindow.document.write('</head><body>');
        printWindow.document.write(printContents);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    });
</script>


<?php include('footer-contents.php'); ?>