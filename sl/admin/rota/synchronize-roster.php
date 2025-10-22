<?php
session_start();
include('dbconnect.php');

$result = mysqli_query($myConnection, "SELECT * FROM tbl_goesoft_users WHERE user_email_address = '" . $_SESSION['usr_email'] . "'");
while ($row = mysqli_fetch_array($result)) {
    $holdmyViewArea = $row['myviewArea'];


    $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_city = '$holdmyViewArea' ";
    $myCheckres = mysqli_query($myConnection, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        header("Location: ./index?col_area_city=$holdmyViewArea");
    } else {
        header("Location: ./nonstop?");
    }
}
