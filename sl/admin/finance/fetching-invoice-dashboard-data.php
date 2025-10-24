<?php
$varCareCallStatus = 'Completed';
$varConfirmation = 'Confirmed';

// Prepare and execute the first query for total payment
$stmt_total_balance = $conn->prepare("
    SELECT SUM(`col_client_rate`) AS total_payment 
    FROM `tbl_daily_shift_records` 
    WHERE (`shift_date` BETWEEN ? AND ?) 
    AND (col_carer_Id = ? OR shift_status = ?) 
    AND col_call_status = ? 
    AND col_company_Id = ?
");
$stmt_total_balance->bind_param('ssssss', $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $varCareCallStatus, $txtCompanyId);
$stmt_total_balance->execute();
$result_total_balance = $stmt_total_balance->get_result();
$row_total_balance = $result_total_balance->fetch_assoc();

// Safely handle total payment value
$total_invoice_payment = isset($row_total_balance['total_payment'])
    ? number_format((float)$row_total_balance['total_payment'], 2, '.', '')
    : '0.00';

// Prepare and execute the second query for total worked hours
$stmt_total_hour = $conn->prepare("
    SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) AS total_worked_hours 
    FROM `tbl_daily_shift_records` 
    WHERE (`planned_timeOut` IS NOT NULL AND `planned_timeIn` IS NOT NULL) 
    AND (`shift_date` BETWEEN ? AND ?) 
    AND (col_carer_Id = ? OR shift_status = ?) 
    AND col_call_status = ? 
    AND col_company_Id = ?
");
$stmt_total_hour->bind_param('ssssss', $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $varCareCallStatus, $txtCompanyId);
$stmt_total_hour->execute();
$result_total_hour = $stmt_total_hour->get_result();
$row_total_hour = $result_total_hour->fetch_assoc();

// Safely handle total worked hours
$total_hours = $row_total_hour['total_worked_hours'] ?? null;

// ✅ Fix: Safely split and process time
if (!empty($total_hours) && strpos($total_hours, ':') !== false) {
    $timeParts = explode(':', $total_hours);

    // Ensure all parts exist
    $hours = isset($timeParts[0]) ? (int)$timeParts[0] : 0;
    $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;
    $seconds = isset($timeParts[2]) ? (int)$timeParts[2] : 0;
} else {
    // Default to zero if no data returned
    $hours = $minutes = $seconds = 0;
}

// Convert the time into seconds and format back to HH:MM
$total_seconds = $hours * 3600 + $minutes * 60 + $seconds;
$hours = floor($total_seconds / 3600);
$minutes = floor(($total_seconds % 3600) / 60);
$formatted_invoice_time = sprintf('%02d:%02d', $hours, $minutes);

// Close statements
$stmt_total_balance->close();
$stmt_total_hour->close();
