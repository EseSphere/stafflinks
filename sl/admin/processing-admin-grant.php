<?php
ob_start();
session_start();
if (isset($_POST['btnGrantAccess'])) {
    include('dbconnections.php');
    $adminSpecialId = $_POST['adminSpecialId'];
    $verification = "Granted";
    $stmt = $conn->prepare("UPDATE `tbl_goesoft_users` SET `admin_access` = ? 
    WHERE user_special_Id = ? AND col_company_Id = ?");
    $stmt->bind_param("sss", $verification, $adminSpecialId, $_SESSION['usr_compId']);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header("Location: ./administrator-l009948-i887446-476hs8846ist");
    }
    $stmt->close();
}
