<?php
session_start();
include('dbconnections.php');

if (isset($_POST['btnChangeTeamView'])) {

    $checkCityView =  mysqli_real_escape_string($conn, $_POST['checkCityView']);
    $sql = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `team_view` = '$checkCityView' WHERE user_email_address = '" . $_SESSION['usr_email'] . "' ");

    if ($sql) {
        header("Location: ./team-list?team_view=$checkCityView");
    } else {
    }
}
