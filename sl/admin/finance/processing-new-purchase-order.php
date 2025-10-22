<?php

if (isset($_POST['btnAddNewPurchaseData'])) {

    include('dbconnections.php');

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $txtfive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);

    $mySpecialId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myRateId = hash('sha256', $mySpecialId);

    $selectClientId = mysqli_query($conn, "SELECT client_first_name, client_last_name FROM tbl_general_client_form WHERE uryyToeSS4 = '$txtone' ");
    while ($holdClientId = mysqli_fetch_array($selectClientId)) {
        $txtClientName = $holdClientId['client_first_name'] . ' ' . $holdClientId['client_last_name'];

        $selectClientRC = mysqli_query($conn, "SELECT col_rate_card FROM tbl_contract WHERE col_name = '$txtthree' ");
        while ($holdClientRC = mysqli_fetch_array($selectClientRC)) {
            $txtRateCard = $holdClientRC['col_rate_card'];

            $queryIns = mysqli_query($conn, "INSERT INTO tbl_purchase_order (col_client_name, col_payer, col_contract_name, col_contract_rate, col_service_type, col_hours_per_week, col_client_Id, col_special_Id, col_company_Id, col_date) 
        VALUES('" . $txtClientName . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtRateCard . "', '" . $txtfour . "', '" . $txtfive . "', '" . $txtone . "', '" . $myRateId . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");

            if ($queryIns) {
                unset($txtone);
                unset($txttwo);
                unset($txtthree);
                unset($txtfour);
                unset($txtfive);
                unset($txtClientName);
                unset($mySpecialId);
                unset($txtCurrentDate);
                unset($myCompanyId);
                header("Location: ./new-purchase-order");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        }
    }
}
