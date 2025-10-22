<?php


if (isset($_POST['btnAddBillingConfigData'])) {

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtfive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);


    $mySpecialId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myRateId = hash('sha256', $mySpecialId);

    $myCheck = "SELECT * FROM tbl_billing_config WHERE col_communication = '" . $txtfive . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";

        unset($txtone);
        unset($txttwo);
        unset($txtthree);
        unset($txtfour);
        unset($txtfive);
        unset($mySpecialId);
        unset($txtCurrentDate);
        unset($myCompanyId);
    } else {

        $queryIns = mysqli_query($conn, "INSERT INTO tbl_billing_config (col_billing_add, col_invoice_numb, col_office_numb, col_payment_details, col_communication, col_special_Id, col_date, col_company_Id) 
        VALUES('" . $txtone . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtfour . "', '" . $txtfive . "', '" . $myRateId . "', '" . $txtCurrentDate . "', '" . $myCompanyId . "') ");

        if ($queryIns) {
            header("Location: ./configuration");
        } else {
            echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
        }
    }
}
