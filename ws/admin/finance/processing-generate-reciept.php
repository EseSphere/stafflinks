<?php


if (isset($_POST['btnGenerateInvoice'])) {

    include('dbconnections.php');

    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodEnd']);
    $txtCareRecipient = mysqli_real_escape_string($conn, $_REQUEST['txtCareRecipient']);
    //$txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    //$txtfive = mysqli_real_escape_string($conn, $_REQUEST['txtfive']);
    //$txtsix = mysqli_real_escape_string($conn, $_REQUEST['txtsix']);


    $mySpecialId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myRateId = hash('sha256', $mySpecialId);

    $selectClientRC = mysqli_query($conn, "SELECT col_contract_name, col_contract_rate FROM tbl_purchase_order WHERE col_client_Id = '$txtCareRecipient' ");
    while ($holdClientRC = mysqli_fetch_array($selectClientRC)) {
        //$txtRateName = $holdClientRC['col_contract_name'];
        $txtRateCard = $holdClientRC['col_contract_rate'];

        $CopyClient_carecalls = mysqli_query($conn, "INSERT INTO tbl_client_invoice (col_invoice_date, col_invoice_time, col_client_name, col_contract_rate, col_worked_time, col_client_Id, col_special_Id, col_company_Id, col_date) 
        SELECT shift_date, planned_timeIn, client_name, $txtRateCard, col_worked_time, uryyToeSS4, $myRateId, $myCompanyId, $txtCurrentDate FROM tbl_daily_shift_records WHERE uryyToeSS4 = '$txtCareRecipient' AND timesheet_date = '$txtPeriodStart' AND timesheet_date = '$txtPeriodEnd' ");

        if ($queryIns) {
            unset($txtPeriodStart);
            unset($txtPeriodEnd);
            unset($txtCareRecipient);
            //unset($txtfour);
            //unset($txtfive);
            //unset($txtsix);
            unset($mySpecialId);
            unset($txtCurrentDate);
            unset($myCompanyId);
            header("Location: ./invoice-dashboard");
        } else {
            echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
        }
    }
}
