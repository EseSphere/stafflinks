<?php
header('Content-Type: application/json');
include 'db-connect.php';

$startDate = $_GET['startDate'] ?? null;
$userId    = $_GET['userId'] ?? null; // Changed from clientId to userId (team member)

if (!$startDate || !$userId) {
    echo json_encode([]);
    exit;
}

$result = [];

// Loop through 7 days starting from $startDate
for ($i = 0; $i < 7; $i++) {
    $date = date('Y-m-d', strtotime("+$i day", strtotime($startDate)));

    $sql = "SELECT 
                userId AS visit_id, 
                client_name, 
                uryyToeSS4 AS client_specId, 
                Clientshift_Date AS visit_date,
                care_calls AS visit_time,
                call_status AS visit_status,
                first_carer AS carer_name,
                dateTime_in AS visit_time_in,
                dateTime_out AS visit_time_out
            FROM tbl_schedule_calls
            WHERE Clientshift_Date = ? 
              AND (first_carer = ? OR second_carer = ?)
            ORDER BY FIELD(care_calls, 
                           'Morning','Extra Morning',
                           'Lunch','Extra Lunch',
                           'Tea','Extra Tea',
                           'Bed','Extra Bed')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $date, $userId, $userId);
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
