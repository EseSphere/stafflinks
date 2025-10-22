<?php

if (isset($_POST['btnUpdateInvoiceRateData'])) {
    include_once('dbconnections.php');

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtfive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);
    $txtsix = mysqli_real_escape_string($conn, $_REQUEST['txtsix']);
    $txtseven = mysqli_real_escape_string($conn, $_REQUEST['txtseven']);
    $txteight = mysqli_real_escape_string($conn, $_REQUEST['txteight']);

    $mySpecialId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $sql_update_invoice_rate = mysqli_query($conn, "UPDATE tbl_invoice_rate SET col_name = '$txtone', col_days = '$txttwo', 
    col_applies = '$txtthree', col_type = '$txtfour', col_rates = '$txtfive', col_service_type = '$txtsix', 
    col_fee_name = '$txtseven', col_fee_rate = '$txteight', col_date = '$txtCurrentDate' WHERE (col_special_Id = '$mySpecialId' 
    AND col_company_Id = '$myCompanyId') ");
    if ($sql_update_invoice_rate) {
        header("Location: ./invoicing-rate?col_special_Id=$mySpecialId");
    } else {
        echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
    }
}
