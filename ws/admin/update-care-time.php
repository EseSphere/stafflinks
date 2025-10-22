<?php
include('dbconnections.php');

$clientId        = trim($_POST['txtClientUserId']);
$careCalls       = trim($_POST['txtCareCalls']);
$txtClientSpecId = trim($_POST['txtClientSpecId']);
$txtTimeIn       = trim($_POST['txtTimeIn']);
$txtTimeOut      = trim($_POST['txtTimeOut']);
$shiftDate      = trim($_POST['txtclientShiftDate']);
$companyId       = $_SESSION['usr_compId'] ?? null;

if (!$companyId) {
    die("Company ID not found in session.");
}

if (isset($_POST['btnCurTime'])) {
    $sql = "UPDATE tbl_schedule_calls 
            SET dateTime_in = ?, dateTime_out = ? 
            WHERE userId = ? AND col_company_Id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssis", $txtTimeIn, $txtTimeOut, $clientId, $companyId);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} elseif (isset($_POST['btnAllTimes'])) {
    $sql = "UPDATE tbl_schedule_calls 
        SET dateTime_in = ?, dateTime_out = ? 
        WHERE uryyToeSS4 = ? AND care_calls = ? 
        AND Clientshift_Date >= ? AND col_company_Id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // s = string, i = integer
        $stmt->bind_param("ssssss", $txtTimeIn, $txtTimeOut, $txtClientSpecId, $careCalls, $shiftDate, $companyId);
        $stmt->execute();
        $stmt->close();
    }

    // Then update tbl_manage_runs
    $sql = "UPDATE tbl_manage_runs 
            SET dateTime_in = ?, dateTime_out = ? 
            WHERE uryyToeSS4 = ? AND care_calls = ? AND col_company_Id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssss", $txtTimeIn, $txtTimeOut, $txtClientSpecId, $careCalls, $companyId);
        $stmt->execute();
        $stmt->close();
    }

    // And then update tbl_manage_runs
    $sql = "UPDATE tbl_clienttime_calls 
            SET dateTime_in = ?, dateTime_out = ? 
            WHERE uryyToeSS4 = ? AND care_calls = ? AND col_company_Id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssss", $txtTimeIn, $txtTimeOut, $txtClientSpecId, $careCalls, $companyId);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo 'No button pressed';
}

$conn->close();
