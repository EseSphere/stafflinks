<?php
// get_team_daily_visits.php
header('Content-Type: application/json');
include 'db-connect.php';

$date = isset($_GET['date']) ? trim($_GET['date']) : null;
$teamId = isset($_GET['teamId']) ? trim($_GET['teamId']) : null;

if (!$date || !$teamId) {
    echo json_encode([]);
    exit;
}

/*
   Assuming tbl_schedule_calls has a column like `first_carer_Id` (or similar)
   that stores which team member (carer) is assigned.

   Adjust the column name below if your schema uses a different one.
*/
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
        WHERE Clientshift_Date = ? 
          AND first_carer_Id = ?
        ORDER BY 
            FIELD(care_calls, 'Morning', 'Extra Morning', 'Lunch', 'Extra Lunch', 'Tea', 'Extra Tea', 'Bed', 'Extra Bed')";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $date, $teamId);
    $stmt->execute();
    $result_set = $stmt->get_result();

    $result = [];

    while ($visit = $result_set->fetch_assoc()) {
        $day = date('l', strtotime($visit['visit_date']));
        $time = trim($visit['visit_time']);

        if (!isset($result[$day])) {
            $result[$day] = [];
        }
        if (!isset($result[$day][$time])) {
            $result[$day][$time] = [];
        }

        $result[$day][$time][] = $visit;
    }

    echo json_encode($result);
} else {
    echo json_encode([]);
}
