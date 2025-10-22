<?php

if (isset($_POST['btnAddNewInvoiceData'])) {

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtfive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);
    $txtsix = mysqli_real_escape_string($conn, $_REQUEST['txtsix']);
    $txtseven = mysqli_real_escape_string($conn, $_REQUEST['txtseven']);
    $txteight = mysqli_real_escape_string($conn, $_REQUEST['txteight']);

    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myCheck = "SELECT * FROM tbl_invoice_rate WHERE (col_name = '" . $txtone . "' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";
    } else {
        $sql_get_payer_Id = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate ORDER BY userId DESC LIMIT 1");
        $row_get_payer_Id = mysqli_fetch_array($sql_get_payer_Id);
        $count_rows = mysqli_num_rows($sql_get_payer_Id);
        $varSpecialId = $row_get_payer_Id['col_special_Id'];
        if ($count_rows = 0) {
            $myRateId = 235540;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_invoice_rate (col_name, col_days, col_applies, col_type, col_rates, col_service_type, col_fee_name, col_fee_rate, col_special_Id, col_company_Id, col_date) 
            VALUES('" . $txtone . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtfour . "', '" . $txtfive . "', '" . $txtsix . "', '" . $txtseven . "', '" . $txteight . "', '" . $myRateId . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "',) ");
            if ($queryIns) {
                header("Location: ./new-invoice-rate");
            }
        } else {
            $myRateId = $varSpecialId + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_invoice_rate (col_name, col_days, col_applies, col_type, col_rates, col_service_type, col_fee_name, col_fee_rate, col_special_Id, col_company_Id, col_date) 
            VALUES('" . $txtone . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtfour . "', '" . $txtfive . "', '" . $txtsix . "', '" . $txtseven . "', '" . $txteight . "', '" . $myRateId . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");
            if ($queryIns) {
                header("Location: ./new-invoice-rate");
            }
        }
    }
}
