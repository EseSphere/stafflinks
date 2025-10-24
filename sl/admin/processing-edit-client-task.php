<?php
include('dbconnections.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['btnEditClientTask'])) {

    // Collect inputs
    $txtTaskId         = $_POST['txtTaskId']        ?? '';
    $txtClientSocialId = $_POST['txtClientSocialId'] ?? '';
    $txtTask           = $_POST['txtTask']          ?? '';
    $txtTaskDetails    = $_POST['txtTaskDetails']   ?? '';

    $txtMorning = $_POST['txtMorning'] ?? '';
    $txtLunch   = $_POST['txtLunch']   ?? '';
    $txtTea     = $_POST['txtTea']     ?? '';
    $txtBed     = $_POST['txtBed']     ?? '';

    $txtExM = $_POST['txtEM'] ?? '';
    $txtExL = $_POST['txtEL'] ?? '';
    $txtExT = $_POST['txtET'] ?? '';
    $txtExB = $_POST['txtEB'] ?? '';

    $txtMonday    = $_POST['txtMonday']    ?? '';
    $txtTuesday   = $_POST['txtTuesday']   ?? '';
    $txtWednesday = $_POST['txtWednesday'] ?? '';
    $txtThursday  = $_POST['txtThursday']  ?? '';
    $txtFriday    = $_POST['txtFriday']    ?? '';
    $txtSaturday  = $_POST['txtSaturday']  ?? '';
    $txtSunday    = $_POST['txtSunday']    ?? '';

    $txtStarts = $_POST['txtStarts'] ?? '';
    $txtEnd    = $_POST['txtEnd']    ?? '';
    $txtStop   = $_POST['txtStop']   ?? '';

    $txtPeriod         = $_POST['txtPeriod']         ?? null;
    $txtPeriodCategory = $_POST['txtPeriodCategory'] ?? null;

    $clickDisplayDaily   = $_POST['clickDisplayDaily']   ?? '';
    $clickDisplayOneTime = $_POST['clickDisplayOneTime'] ?? '';
    $clickDisplayCustom  = $_POST['clickDisplayCustom']  ?? '';

    // Determine end date and periods
    $col_occurence = ($txtStop === "Stop") ? $txtStop : $txtStarts;

    if ($clickDisplayDaily) {
        $col_period_two = 'Daily';
        $col_period_one = null;
    } elseif ($clickDisplayOneTime) {
        $col_period_two = 'Monthly';
        $col_period_one = null;
    } elseif ($clickDisplayCustom) {
        $col_period_two = $txtPeriodCategory;
        $col_period_one = $txtPeriod;
    } else {
        $col_period_two = null;
        $col_period_one = null;
    }

    // Prepared statement
    $stmt = $conn->prepare("
        UPDATE tbl_clients_task_records SET
            client_taskName = ?, client_task_details = ?,
            care_call1 = ?, care_call2 = ?, care_call3 = ?, care_call4 = ?,
            extra_call1 = ?, extra_call2 = ?, extra_call3 = ?, extra_call4 = ?,
            monday = ?, tuesday = ?, wednesday = ?, thursday = ?, friday = ?, saturday = ?, sunday = ?,
            task_startDate = ?, task_endDate = ?, col_occurence = ?, col_period_one = ?, col_period_two = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "sssssssssssssssssssssss",
        $txtTask,
        $txtTaskDetails,
        $txtMorning,
        $txtLunch,
        $txtTea,
        $txtBed,
        $txtExM,
        $txtExL,
        $txtExT,
        $txtExB,
        $txtMonday,
        $txtTuesday,
        $txtWednesday,
        $txtThursday,
        $txtFriday,
        $txtSaturday,
        $txtSunday,
        $txtStarts,
        $txtEnd,
        $col_occurence,
        $col_period_one,
        $col_period_two,
        $txtTaskId
    );

    if ($stmt->execute()) {
        header("Location: ./client-task?uryyToeSS4=$txtClientSocialId");
        exit();
    } else {
        echo "Error updating task record: " . $stmt->error;
    }
}
