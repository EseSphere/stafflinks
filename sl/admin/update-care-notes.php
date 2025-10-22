<?php
include('dbconnections.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId   = trim($_POST['txtClientSpecId']);
    $careCalls  = trim($_POST['txtCeCalls']);
    $shiftDate  = trim($_POST['txtShiftDate']);
    $careNotes  = trim($_POST['txtCareNotes']);

    $sql = "UPDATE tbl_daily_shift_records SET task_note = ? WHERE uryyToeSS4 = ? 
    AND col_care_call = ? AND shift_date = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $careNotes, $clientId, $careCalls, $shiftDate);
        if ($stmt->execute()) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $stmt->close();
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

$mysqli->close();
