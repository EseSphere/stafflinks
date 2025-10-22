<?php

session_start();

if (isset($_POST['btnGrantAccess'])) {

    include('dbconnections.php');

    $adminSpecialId =  mysqli_real_escape_string($conn, $_POST['adminSpecialId']);
    $verification =  "Granted";

    $sql = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `finance_access` = '$verification' WHERE user_special_Id = '$adminSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
    if ($sql) {

        header("Location: ./administrator-l009948-i887446-476hs8846ist");
    } else {
    }
}
