<?php
session_start();
ob_start();
if (isset($_POST['btnChangeClientRun'])) {
    include('dbconnections.php');
    $txtRunAreaId = mysqli_real_escape_string($conn, $_POST['txtRunAreaId']);
    $txtClientId = mysqli_real_escape_string($conn, $_POST['txtClientId']);
    $txtDateChange = mysqli_real_escape_string($conn, $_POST['txtDateChange']);
    $txtClientRunName = mysqli_real_escape_string($conn, $_POST['txtClientRunName']);
    $stmt = $conn->prepare("UPDATE tbl_manage_runs SET run_area_nameId = ?, col_run_name = ? WHERE userId = ?");
    $stmt->bind_param("sss", $txtRunAreaId, $txtClientRunName, $txtClientId);
    if ($stmt->execute()) {
        header("Location: ./roster/schedule-visits?txtDate=$txtDateChange");
    }
    $stmt->close();
    $conn->close();
}
