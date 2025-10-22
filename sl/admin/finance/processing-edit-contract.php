<?php

if (isset($_POST['btnUpdateContractData'])) {

    include('dbconnections.php');

    $txtOne = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txtTwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtThree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtFour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtFive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);


    $myRateId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $queryIns = mysqli_query($conn, "UPDATE tbl_contract SET `col_name`='" . $txtOne . "', `col_payer`='" . $txtTwo . "', `col_service_type`='" . $txtThree . "', `col_rate_card`='" . $txtFour . "', `col_invoice_format`='" . $txtFive . "', `col_date` = '" . $txtCurrentDate . "' WHERE `col_special_Id` = '" . $myRateId . "' ");

    if ($queryIns) {

        unset($txtOne);
        unset($txtTwo);
        unset($txtThree);
        unset($txtFour);
        unset($txtFive);
        unset($txtSelectservicetype);
        unset($mySpecialId);
        unset($txtCurrentDate);

        header("Location: ./edit-contract?col_special_Id=$myRateId");
    } else {
        echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
    }
}
