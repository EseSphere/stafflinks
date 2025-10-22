<?php
if (isset($_POST['btnCancelCareCall'])) {
    include('dbconnections.php');

    $txtClientName = mysqli_real_escape_string($conn, $_POST['txtClientName']);
    $txtClientCareCall = mysqli_real_escape_string($conn, $_POST['txtClientCareCall']);
    $txtClientId = mysqli_real_escape_string($conn, $_POST['txtClientId']);
    $txtDateOfVisit = mysqli_real_escape_string($conn, $_POST['txtDateOfVisit']);
    $txtTimeOfVisit = mysqli_real_escape_string($conn, $_POST['txtTimeOfVisit']);
    $txtCancellationby = mysqli_real_escape_string($conn, $_POST['txtCancellationby']);
    $txtClientReason = mysqli_real_escape_string($conn, $_POST['txtClientReason']);
    $txtPayCarer = mysqli_real_escape_string($conn, $_POST['txtPayCarer']);
    $txtDontPayCarer = mysqli_real_escape_string($conn, $_POST['txtDontPayCarer']);
    $txtInvoice = mysqli_real_escape_string($conn, $_POST['txtInvoice']);
    $txtDontInvoice = mysqli_real_escape_string($conn, $_POST['txtDontInvoice']);
    $txtcancelNote = mysqli_real_escape_string($conn, $_POST['txtcancelNote']);
    $careCallStatus = 'Cancelled';
    $careCallStatusColor = 'rgba(189, 195, 199,.6)';
    $varVisitColorCode = "rgba(189, 195, 199,1.0)";
    $txtCarerName = $_SESSION['usr_userName'];

    // Determine pay status and invoice option
    $payStatus = $txtPayCarer ?: $txtDontPayCarer;
    $invoiceStatus = $txtInvoice ?: $txtDontInvoice;

    if (!$payStatus) {
        header("Location: ./pay-option-error");
        exit();
    }
    if (!$invoiceStatus) {
        header("Location: ./invoice-option-error");
        exit();
    }

    // ✅ Check if record already exists for same client & date
    $checkSql = "SELECT * FROM tbl_cancelled_call 
                 WHERE col_client_Id = '$txtClientId' 
                 AND col_date = '$txtDateOfVisit' 
                 AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // ✅ Update existing record
        $query = "UPDATE tbl_cancelled_call 
                  SET col_client_name = '$txtClientName',
                  cancelled_by = '$txtCarerName',
                      col_care_call = '$txtClientCareCall',
                      col_time = '$txtTimeOfVisit',
                      col_cancellation_by = '$txtCancellationby',
                      col_reason = '$txtClientReason',
                      col_pay_status = '$payStatus',
                      col_invoice = '$invoiceStatus',
                      col_note = '$txtcancelNote'
                  WHERE col_client_Id = '$txtClientId' 
                  AND col_date = '$txtDateOfVisit' 
                  AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
    } else {
        // ✅ Insert new record
        $query = "INSERT INTO tbl_cancelled_call 
                  (col_client_name, cancelled_by, col_care_call, col_client_Id, col_date, col_time, col_cancellation_by, col_reason, col_pay_status, col_invoice, col_note, col_company_Id) 
                  VALUES('$txtClientName', '$txtCarerName', '$txtClientCareCall', '$txtClientId', '$txtDateOfVisit', '$txtTimeOfVisit', '$txtCancellationby', '$txtClientReason', '$payStatus', '$invoiceStatus', '$txtcancelNote', '" . $_SESSION['usr_compId'] . "')";
    }

    $queryIns = mysqli_query($conn, $query);

    if ($queryIns) {
        // ✅ Update rota as well
        $sqlUpdateRota = mysqli_query($conn, "UPDATE `tbl_schedule_calls` 
            SET `call_status` = '$careCallStatus', 
                `team_resource` = '$careCallStatus',
                `timeline_colour` = '$careCallStatusColor' 
            WHERE (uryyToeSS4 = '$txtClientId' 
            AND care_calls = '$txtClientCareCall' 
            AND Clientshift_Date = '$txtDateOfVisit' 
            AND col_company_Id = '" . $_SESSION['usr_compId'] . "')");

        if ($sqlUpdateRota) {
            echo "<script>window.history.go(-3);</script>";
            exit();
        }
    }
}
