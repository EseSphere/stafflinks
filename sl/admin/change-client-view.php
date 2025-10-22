<?php
session_start();
include('dbconnections.php');

if (isset($_POST['btnChangeClientView'])) {

    $checkCityView =  mysqli_real_escape_string($conn, $_POST['checkCityView']);
    $sql = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `client_view` = '$checkCityView' WHERE user_email_address = '" . $_SESSION['usr_email'] . "' ");

    if ($sql) {
        header("Location: ./client-list?client_view=$checkCityView");
    } else {
    }
}
