<?php
require_once 'dbconnections.php';
$current_hour = date('H:00');
$current_minute = date('H:59');

$today = date('Y-m-d');
$sql = "SELECT * FROM tbl_schedule_calls WHERE (col_area_city = '" . $_SESSION['usr_city'] . "' AND dateTime_in = '$current_hour' 
AND dateTime_out <= '$current_minute' AND call_status = 'Scheduled' AND Clientshift_Date = '$today' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
$result = $conn->query($sql);

$alerts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alerts[] = $row["first_carer"] . ' running late for ' . $row["client_name"] . ' ' . $row["care_calls"] . ' call';
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Return JSON response
echo json_encode($alerts);
