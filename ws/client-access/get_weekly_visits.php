<?php
header('Content-Type: application/json');
include 'dbconnections.php';

$startDate = $_GET['startDate'] ?? null;
$clientId = $_GET['clientId'] ?? null;

if (!$startDate || !$clientId) {
    echo json_encode([]);
    exit;
}

$result = [];

for ($i = 0; $i < 7; $i++) {
    $date = date('Y-m-d', strtotime("+$i day", strtotime($startDate)));
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
