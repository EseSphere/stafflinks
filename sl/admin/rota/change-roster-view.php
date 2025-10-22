<?php
session_start();
include('dbconnect.php');

if (isset($_POST['btnChangeRosterView'])) {

    $checkCityView =  mysqli_real_escape_string($myConnection, $_POST['checkCityView']);
    $sql = mysqli_query($myConnection, "UPDATE `tbl_goesoft_users` SET `myviewArea` = '$checkCityView' WHERE user_email_address = '" . $_SESSION['usr_email'] . "' ");

    if ($sql) {
        header("Location: ./index?col_area_city=$checkCityView");
    } else {
    }
}
