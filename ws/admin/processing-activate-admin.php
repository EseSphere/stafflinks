<?php
ob_start();
session_start();
if (isset($_POST['btnDeactivateAdmin'])) {
    include('dbconnections.php');
    $adminSpecialId = $_POST['adminSpecialId'];
    $verification = "Verified";
    $deactivatebtn = "0";
    $activatebtn = "disabled";
    $stmt = $conn->prepare("UPDATE `tbl_goesoft_users` SET `verification_code` = ?, `status1` = ?, `status2` = ? 
    WHERE user_special_Id = ? AND col_company_Id = ?");
    $stmt->bind_param("sssss", $verification, $deactivatebtn, $activatebtn, $adminSpecialId, $_SESSION['usr_compId']);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header("Location: ./administrators");
    }
    $stmt->close();
}
