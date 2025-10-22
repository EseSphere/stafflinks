<?php
$sql_total_balance = mysqli_query($conn, "SELECT SUM(`col_carecall_rate`) AS total_payment FROM `tbl_daily_shift_records` WHERE (col_carer_Id = '$carer_specialId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
$row_total_balance = mysqli_fetch_array($sql_total_balance, MYSQLI_ASSOC);
$total_carerPayment = number_format(round($row_total_balance['total_payment']));

$sql_total_hour = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) AS total_worked_hours FROM `tbl_daily_shift_records` WHERE (col_carer_Id = '$carer_specialId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
$row_total_hour = mysqli_fetch_array($sql_total_hour, MYSQLI_ASSOC);
$total_hours = $row_total_hour['total_worked_hours'];
// Split the time into hours, minutes, and seconds
list($hours, $minutes, $seconds) = explode(':', $total_hours);
// Convert the time into seconds
$total_seconds = $hours * 3600 + $minutes * 60 + $seconds; // Outputs: 9045

$hours = floor($total_seconds / 3600);
$minutes = floor(($total_seconds % 3600) / 60);
$seconds = $total_seconds % 60;

$formatted_Carertime = sprintf('%02d:%02d', $hours, $minutes, $seconds);

$sql_total_mileage = mysqli_query($conn, "SELECT SUM(`col_mileage`) AS total_mileage FROM `tbl_daily_shift_records` WHERE (col_carer_Id = '$carer_specialId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
$row_total_mileage = mysqli_fetch_array($sql_total_mileage, MYSQLI_ASSOC);
$total_carerMileage = number_format(round($row_total_mileage['total_mileage']));

$varTotalAmount = $total_carerPayment + $total_carerMileage;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
