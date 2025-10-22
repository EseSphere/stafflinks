<?php

if (isset($_POST['btnUpdateHolidayData'])) {

    include('dbconnections.php');

    $txtOne = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txtTwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtThree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtFour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);

    $myRateId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $queryIns = mysqli_query($conn, "UPDATE tbl_holiday SET `col_description`='" . $txtOne . "', `col_holiday_date`='" . $txtTwo . "', `col_pay_multiplier`='" . $txtThree . "', `col_charge_multiplier`='" . $txtFour . "', `col_date` = '" . $txtCurrentDate . "' WHERE `col_special_Id` = '" . $myRateId . "' ");

    if ($queryIns) {
        header("Location: ./edit-holiday?col_special_Id=$myRateId");
    } else {
        echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
    }
}
