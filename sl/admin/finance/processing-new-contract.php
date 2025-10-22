<?php

if (isset($_POST['btnAddNewContractData'])) {

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtfive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);
    $txtsix = mysqli_real_escape_string($conn, $_REQUEST['txtsix']);

    $mySpecialId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $txtZero = 'All';

    $myRateId = hash('sha256', $mySpecialId);

    $sql_get_payer = mysqli_query($conn, "SELECT * FROM `tbl_payer` WHERE (col_special_Id = '$txttwo' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
    $row_get_payer = mysqli_fetch_array($sql_get_payer, MYSQLI_ASSOC);
    $varGetPayerName = $row_get_payer['col_name'];
    $varGetPayerId = $row_get_payer['col_special_Id'];


    $myCheck = mysqli_query($conn, "SELECT * FROM tbl_contract WHERE (col_name = '$txtone' AND col_payer = '$varGetPayerName' AND col_service_type = '$txtthree')");
    $row_payer = mysqli_fetch_array($myCheck);
    $varSpecialId = $row_payer['col_special_Id'];
    $countRes = mysqli_num_rows($myCheck);
    if ($countRes != 0) {
        echo "
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#popupAlert').show();
            });
        </script>";
    } else {
        $sql_get_payer_Id = mysqli_query($conn, "SELECT * FROM tbl_contract ORDER BY userId DESC LIMIT 1");
        $row_get_payer_Id = mysqli_fetch_array($sql_get_payer_Id);
        $varSpecialId = $row_get_payer_Id['col_special_Id'];
        if ($row_get_payer_Id == 0) {
            $varSpecialIdNumb = 1021;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_contract (col_all, col_name, col_payer, col_service_type, col_rate_card, col_invoice_format, col_invoice_group, col_payer_Id, col_special_Id, col_company_Id, col_date) 
            VALUES('" . $txtZero . "', '" . $txtone . "', '" . $varGetPayerName . "', '" . $txtthree . "', '" . $txtfour . "', '" . $txtfive . "', '" . $txtsix . "', '" . $varGetPayerId . "', '" . $varSpecialIdNumb . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");
            if ($queryIns) {
                header("Location: ./view-contract?col_special_Id=$mySpecialId");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        } else {
            $varIncrementSpecialId = $varSpecialId + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_contract (col_all, col_name, col_payer, col_service_type, col_rate_card, col_invoice_format, col_invoice_group, col_payer_Id, col_special_Id, col_company_Id, col_date) 
            VALUES('" . $txtZero . "', '" . $txtone . "', '" . $varGetPayerName . "', '" . $txtthree . "', '" . $txtfour . "', '" . $txtfive . "', '" . $txtsix . "', '" . $varGetPayerId . "', '" . $varIncrementSpecialId . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");
            if ($queryIns) {
                header("Location: ./view-contract?col_special_Id=$mySpecialId");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        }
    }
}
