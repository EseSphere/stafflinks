<?php
ob_start();
session_start();
include('dbconnections.php');

if (isset($_POST['btnDeactivateAdmin'])) {
    $adminSpecialId = $_POST['adminSpecialId'];
    $verification = "Deactivated";
    $deactivatebtn = "disabled";
    $activatebtn = "0";
    $companyId = $_SESSION['usr_compId'];

    $stmt = $conn->prepare("UPDATE `tbl_goesoft_users` SET `verification_code` = ?, `status1` = ?, `status2` = ? 
    WHERE user_special_Id = ? AND col_company_Id = ?");
    $stmt->bind_param("sssss", $verification, $deactivatebtn, $activatebtn, $adminSpecialId, $companyId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ./administrators");
        exit();
    }

    $stmt->close();
}
