<?php

if (isset($_POST['btnUpdateTravelRateData'])) {

    include('dbconnections.php');

    $txtOne = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txtTwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtThree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtFour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtFive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);


    $myRateId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myCheck = "SELECT * FROM tbl_travel_rate WHERE col_name = '" . $txtone . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";

        unset($txtOne);
        unset($txtTwo);
        unset($txtThree);
        unset($txtFour);
        unset($txtFive);
        unset($txtSelectservicetype);
        unset($mySpecialId);
        unset($txtCurrentDate);
    } else {

        $queryIns = mysqli_query($conn, "UPDATE tbl_travel_rate SET `col_name`='" . $txtOne . "', `col_hourly_rate`='" . $txtTwo . "', `col_mileage_rate`='" . $txtThree . "', `col_break`='" . $txtFour . "', `col_pay_waiting_time`='" . $txtFive . "', `col_date` = '" . $txtCurrentDate . "' WHERE `col_special_Id` = '" . $myRateId . "' ");

        if ($queryIns) {
            header("Location: ./edit-travel-rate?col_special_Id=$myRateId");
        } else {
            echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
        }
    }
}
