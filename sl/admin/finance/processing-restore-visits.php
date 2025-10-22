<?php

if (isset($_POST['btnRestoreVisits'])) {
    include('dbconnections.php');

    $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
    $txtCareGiverId = mysqli_real_escape_string($conn, $_POST['txtCareGiverId']);
    $txtConfirmedVisits = 'Unconfirmed';

    $sql_confirm_visits = mysqli_query($conn, "UPDATE `tbl_daily_shift_records` SET `col_visit_confirmation` = '$txtConfirmedVisits' 
    WHERE ((col_carer_Id = '$txtCareGiverId') AND shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    if ($sql_confirm_visits) {
        header("Location: ./pay-dashboard-657464i-77rf6646-8ui4746");
    }
}
