<?php


if (isset($_POST['btnUpdatePayRateData'])) {
    include('dbconnections.php');

    $txtName = mysqli_real_escape_string($conn, $_REQUEST['txtName']);
    $txtdayType = mysqli_real_escape_string($conn, $_REQUEST['txtdayType']);
    $txtWWTA = mysqli_real_escape_string($conn, $_REQUEST['txtWWTA']);
    $txtRateType = mysqli_real_escape_string($conn, $_REQUEST['txtRateType']);
    $txtHourlyRate = mysqli_real_escape_string($conn, $_REQUEST['txtHourlyRate']);
    $txtSelectservicetype = mysqli_real_escape_string($conn, $_REQUEST['txtSelectservicetype']);


    $myRateId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myCheck = "SELECT * FROM tbl_pay_rate WHERE col_name = '" . $txtName . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";

        unset($txtName);
        unset($txtdayType);
        unset($txtWWTA);
        unset($txtRateType);
        unset($txtHourlyRate);
        unset($txtSelectservicetype);
        unset($mySpecialId);
        unset($txtCurrentDate);
    } else {

        $queryIns = mysqli_query($conn, "UPDATE tbl_pay_rate SET `col_name`='" . $txtName . "', `col_days`='" . $txtdayType . "', `col_applies`='" . $txtWWTA . "', `col_type`='" . $txtRateType . "', `col_rates`='" . $txtHourlyRate . "', `col_service_type` = '" . $txtSelectservicetype . "', `col_date` = '" . $txtCurrentDate . "' WHERE `col_special_Id` = '" . $myRateId . "' ");

        if ($queryIns) {
            header("Location: ./edit-sponsorship?col_special_Id=$myRateId");
        } else {
            echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
        }
    }
}
