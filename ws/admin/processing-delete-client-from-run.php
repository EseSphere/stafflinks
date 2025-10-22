<?php
if (isset($_POST['btnDeleteClientList'])) {
    include('dbconnections.php');

    session_start(); // Ensure session is started
    $today = date("Y-m-d");

    // Collect and sanitize POST data
    $txtUserId = $_POST['txtUserId'] ?? '';
    $txtRunSpecialId = $_POST['txtRunSpecialId'] ?? '';
    $txtClientSpecialId = $_POST['txtClientSpecialId'] ?? '';
    $txtcare_calls = $_POST['txtcare_calls'] ?? '';

    // Delete from tbl_manage_runs
    $stmt1 = $conn->prepare("DELETE FROM tbl_manage_runs WHERE userId = ? AND col_company_Id = ?");
    $stmt1->bind_param("ss", $txtUserId, $_SESSION['usr_compId']);
    $stmt1->execute();

    if ($stmt1->affected_rows >= 0) {
        // Delete from tbl_schedule_calls
        $stmt2 = $conn->prepare("DELETE FROM tbl_schedule_calls WHERE uryyToeSS4 = ? 
        AND Clientshift_Date >= ? AND care_calls = ? AND col_area_Id = ?");
        $stmt2->bind_param("ssss", $txtClientSpecialId, $today, $txtcare_calls, $txtRunSpecialId);
        $stmt2->execute();

        if ($stmt2->affected_rows >= 0) {
            header('Location: ./attach-clients?run_ids=' . urlencode($txtRunSpecialId));
            exit;
        } else {
            echo "Error deleting schedule calls: " . $stmt2->error;
        }
        $stmt2->close();
    } else {
        echo "Error deleting manage runs: " . $stmt1->error;
    }
    $stmt1->close();
    $conn->close();
}
