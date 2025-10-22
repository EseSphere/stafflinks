<?php
include('client-header-contents.php');
$userId = $_GET['userId'];
$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_schedule_calls 
WHERE userId = ?");
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$clientShiftDate = $row['Clientshift_Date'] ?? '';
$myuryyToeSS4 = $row['uryyToeSS4'] ?? '';
$mycare_calls = $row['care_calls'] ?? '';
$myrun_name = $row['col_run_name'] ?? '';
$clientFullName = $row['client_name'] ?? '';
$timeIn = $row['dateTime_in'] ?? '';
$timeOut = $row['dateTime_out'] ?? '';
mysqli_stmt_close($stmt);

///////////////////////////////////////////////////////////////////////////////////////////////////////////

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_daily_shift_records 
WHERE shift_date = ? AND uryyToeSS4 = ? AND col_care_call = ?");
mysqli_stmt_bind_param($stmt, "sss", $clientShiftDate, $myuryyToeSS4, $mycare_calls);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
$varCarerName = $row['carer_Name'] ?? '';
$clientName = $row['client_name'] ?? '';
$shiftDate = $row['shift_date'] ?? '';
$uryyToeSS4 = $row['uryyToeSS4'] ?? '';
$firstCareNotes = $row['task_note'] ?? 'Null';
$care_calls = $row['col_care_call'] ?? '';
$planTimeIn = $row['planned_timeIn'] ?? '';
$planTimeOut = $row['planned_timeOut'] ?? '';
$callStatus = $row['col_call_status'] ?? '';
$firstCarerId = $row['col_carer_Id'] ?? '';
$firstCarActTimeIn = $row['shift_start_time'] ?? '';
$firstCarActTimeOut = $row['shift_end_time'] ?? '';
mysqli_stmt_close($stmt);


///////////////////////////////////////////////////////////////////////////////////////////////////////////

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_daily_shift_records WHERE shift_date = ? 
AND uryyToeSS4 = ? AND col_care_call = ? AND col_carer_Id != ?");
mysqli_stmt_bind_param($stmt, "ssss", $shiftDate, $uryyToeSS4, $care_calls, $firstCarerId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
$shiftUserId = $row['userId'] ?? 'Null';
$varCarerName2 = $row['carer_Name'] ?? 'Null';
$firstCarActTimeIn2 = $row['shift_start_time'] ?? 'Null';
$firstCarActTimeOut2 = $row['shift_end_time'] ?? 'Null';
$careNotes = $row['task_note'] ?? 'Null';
$shiftDate = $row['shift_date'] ?? 'Null';
$shiftClientId = $row['uryyToeSS4'] ?? 'Null';
$shiftCareCall = $row['col_care_call'] ?? 'Null';
$shiftCarer = $row['col_carer_Id'] ?? 'Null';
mysqli_stmt_close($stmt);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
$taskQuery = "SELECT * FROM tbl_finished_tasks WHERE task_date = '$clientShiftDate' 
AND uryyToeSS4 = '$uryyToeSS4' AND care_calls = '$care_calls'";
$tasks = mysqli_query($conn, $taskQuery);

$medQuery = "SELECT * FROM tbl_finished_meds WHERE med_date = '$clientShiftDate' 
AND uryyToeSS4 = '$uryyToeSS4' AND care_calls = '$care_calls'";
$meds = mysqli_query($conn, $medQuery);
