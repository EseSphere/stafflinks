<?php
header('Content-Type: application/json');
include 'db-connect.php';

$date = isset($_GET['date']) ? trim($_GET['date']) : null;
$clientId = isset($_GET['clientId']) ? trim($_GET['clientId']) : null;

if (!$date || !$clientId) {
    echo json_encode([]);
    exit;
}

// Include all normal and extra calls in order
$callOrder = [
    'Morning',
    'EM morning call',
    'Lunch',
    'EL lunch call',
    'Tea',
    'ET tea call',
    'Bed',
    'EB bed call'
];

$placeholders = implode(',', array_fill(0, count($callOrder), '?'));

// Use prepared statement with dynamic ordering
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
        ORDER BY FIELD(care_calls, " . implode(',', array_map(function ($v) {
    return "'$v'";
}, $callOrder)) . ")";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $date, $clientId);
$stmt->execute();
$result_set = $stmt->get_result();

$result = [];

while ($visit = $result_set->fetch_assoc()) {
    $day = date('l', strtotime($visit['visit_date']));
    $time = trim($visit['visit_time']); // Morning, EM morning call, etc.

    if (!isset($result[$day])) {
        $result[$day] = [];
    }
    if (!isset($result[$day][$time])) {
        $result[$day][$time] = [];
    }

    $result[$day][$time][] = $visit;
}

echo json_encode($result);
