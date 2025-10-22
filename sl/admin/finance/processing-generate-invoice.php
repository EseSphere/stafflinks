<?php

if (isset($_POST['btnGenerateInvoice'])) {
    include('dbconnections.php');

    if (isset($_POST['txtGenerateId'])) {
        foreach ($_POST['txtGenerateId'] as $updateid) {
            $txtClientPayer = mysqli_real_escape_string($conn, $_REQUEST['txtClientPayer_' . $updateid]);
            $txtClientPayRate = mysqli_real_escape_string($conn, $_REQUEST['txtClientPayRate_' . $updateid]);
            $txtShiftDate = mysqli_real_escape_string($conn, $_REQUEST['txtShiftDate_' . $updateid]);
            $txtClientName = mysqli_real_escape_string($conn, $_REQUEST['txtClientName_' . $updateid]);
            $txtCareCallRate = mysqli_real_escape_string($conn, $_REQUEST['txtCareCallRate_' . $updateid]);
            $txtWorkedTime = mysqli_real_escape_string($conn, $_REQUEST['txtWorkedTime_' . $updateid]);

            $txtInvoiceStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
            $txtInvoiceEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodEnd']);

            $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtInStartDate_' . $updateid]);
            $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtInEndDate_' . $updateid]);

            $txtCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtCarerId_' . $updateid]);
            $txtClientId = mysqli_real_escape_string($conn, $_REQUEST['txtClientId_' . $updateid]);
            $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId_' . $updateid]);

            $myCheckres = mysqli_query($conn, "SELECT * FROM tbl_invoices 
            WHERE (col_invoice_start_date = '$txtInvoiceStart' AND `col_invoice_end_date` = '$txtInvoiceEnd' AND `col_client_Id` = '$txtClientId' AND `col_company_Id` = '$txtCompanyId')");
            $countRes = mysqli_num_rows($myCheckres);
            if ($countRes != 0) {
                header('Location: ./already-exist.php');
            } else {
                $sql_get_invId = mysqli_query($conn, "SELECT col_invoice_Id FROM `tbl_invoices` ORDER BY userId DESC LIMIT 1 ");
                $row_InvId = mysqli_fetch_array($sql_get_invId, MYSQLI_ASSOC);
                $varInvoiceId = $row_InvId['col_invoice_Id'];
                $countInvoice = mysqli_num_rows($sql_get_invId);
                if ($countInvoice != 0) {
                    $varIncrementPayRunId = $varInvoiceId + 1;
                    $sql_generate_Invoice = mysqli_query($conn, "INSERT INTO tbl_invoices (col_invoice_Id, col_payer, col_payer_rate, col_time_in, col_time_out, col_care_recipient, col_worked_rate, col_worked_time, col_invoice_start_date, col_invoice_end_date, col_carer_Id, col_client_Id, col_company_Id) 
                    SELECT '$varIncrementPayRunId', col_client_payer, col_client_rate, planned_timeIn, planned_timeOut, client_name, col_carecall_rate, col_worked_time, '$txtPeriodStart', '$txtPeriodEnd', col_carer_Id, uryyToeSS4, col_company_Id FROM tbl_daily_shift_records WHERE (shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND col_visit_confirmation = 'Confirmed' AND col_carer_Id = '$txtCarerId' AND col_company_Id = '$txtCompanyId') ");
                    if ($sql_generate_Invoice) {
                        header("Location: ./invoice-dashboard-455365-7748665-ik664gh");
                    }
                } else {
                    $varIncrementPayRunId = '1021';
                    $sql_generate_Invoice = mysqli_query($conn, "INSERT INTO tbl_invoices (col_invoice_Id, col_payer, col_payer_rate, col_time_in, col_time_out, col_care_recipient, col_worked_rate, col_worked_time, col_invoice_start_date, col_invoice_end_date, col_carer_Id, col_client_Id, col_company_Id) 
                    SELECT '$varIncrementPayRunId', col_client_payer, col_client_rate, planned_timeIn, planned_timeOut, client_name, col_carecall_rate, col_worked_time, '$txtPeriodStart', '$txtPeriodEnd', col_carer_Id, uryyToeSS4, col_company_Id FROM tbl_daily_shift_records WHERE (shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND col_visit_confirmation = 'Confirmed' AND col_carer_Id = '$txtCarerId' AND col_company_Id = '$txtCompanyId') ");
                    if ($sql_generate_Invoice) {
                        header("Location: ./invoice-dashboard-455365-7748665-ik664gh");
                    }
                }
            }
        }
    } else {
        header("Location: ./error-page");
    }
}
