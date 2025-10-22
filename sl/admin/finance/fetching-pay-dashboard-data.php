<?php
$varCareCallStatus = 'Completed';
$varConfirmation = 'Confirmed';

// Prepare SQL query for total payment
$sql_total_balance = $conn->prepare("
    SELECT SUM(`col_carecall_rate`) AS total_payment 
    FROM `tbl_daily_shift_records`
    WHERE (`shift_date` BETWEEN ? AND ?) 
    AND (col_carer_Id = ? OR shift_status = ?) 
    AND col_call_status = ? 
    AND col_company_Id = ?
");
$sql_total_balance->bind_param("ssssss", $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $varCareCallStatus, $txtCompanyId);
$sql_total_balance->execute();
$result_balance = $sql_total_balance->get_result();
$row_total_balance = $result_balance->fetch_assoc();
$total_payment = number_format((float)($row_total_balance['total_payment'] ?? 0), 2, '.', '');
$sql_total_balance->close();

// Prepare SQL query for total worked hours
$sql_total_hour = $conn->prepare("
    SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) AS total_worked_hours 
    FROM `tbl_daily_shift_records`
    WHERE (`shift_date` BETWEEN ? AND ?) 
    AND (col_carer_Id = ? OR shift_status = ?) 
    AND col_call_status = ? 
    AND col_company_Id = ?
");
$sql_total_hour->bind_param("ssssss", $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $varCareCallStatus, $txtCompanyId);
$sql_total_hour->execute();
$result_hour = $sql_total_hour->get_result();
$row_total_hour = $result_hour->fetch_assoc();
$sql_total_hour->close();

// Handle time conversion safely
$total_hours = $row_total_hour['total_worked_hours'] ?? '00:00:00';

// Check if the format is correct before exploding
$timeParts = explode(':', $total_hours);
$hours = $timeParts[0] ?? '00'; // Default to '00' if missing
$minutes = $timeParts[1] ?? '00';
$seconds = $timeParts[2] ?? '00';

// Convert time into seconds
$total_seconds = ($hours * 3600) + ($minutes * 60) + $seconds;

// Convert seconds back to HH:MM format
$formatted_time = sprintf('%02d:%02d', floor($total_seconds / 3600), floor(($total_seconds % 3600) / 60));

//echo "Total Payment: $total_payment <br>";
//echo "Total Worked Hours: $formatted_time";
