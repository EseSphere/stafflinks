<?php
header('Content-Type: application/json');
include 'db-connect.php';

$year = $_GET['year'] ?? null;
$month = $_GET['month'] ?? null;
$clientId = $_GET['clientId'] ?? null;

if (!$year || !$month || !$clientId) {
    echo json_encode([]);
    exit;
}

// Ensure month is 2 digits
$month = str_pad($month, 2, '0', STR_PAD_LEFT);

// Get number of days in the month
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

$result = [];

for ($day = 1; $day <= $daysInMonth; $day++) {
    $date = date('Y-m-d', strtotime("$year-$month-$day"));

    $sql = "SELECT 
                userId AS visit_id, 
                client_name, 
                first_carer AS carer_name, 
                call_status AS visit_status, 
                care_calls AS visit_time,
                uryyToeSS4 AS client_specId, 
                Clientshift_Date AS visit_date,
                dateTime_in AS visit_time_in,
                dateTime_out AS visit_time_out
            FROM tbl_schedule_calls
            WHERE Clientshift_Date = ? AND uryyToeSS4 = ?
            ORDER BY FIELD(care_calls, 'Morning', 'Extra Morning', 'Lunch', 'Extra Lunch', 'Tea', 'Extra Tea', 'Bed', 'Extra Bed')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $clientId);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($visit = $res->fetch_assoc()) {
        if (!isset($result[$date])) $result[$date] = [];
        $slot = $visit['visit_time'];
        if (!isset($result[$date][$slot])) $result[$date][$slot] = [];
        $result[$date][$slot][] = $visit;
    }

    $stmt->close();
}

echo json_encode($result);
