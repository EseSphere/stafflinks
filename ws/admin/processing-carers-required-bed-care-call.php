<?php

if (isset($_POST['btnSaveRequiredCarer'])) {

    include('dbconnections.php');

    $clientId =  mysqli_real_escape_string($conn, $_POST['clientId']);
    $txtRequiredCarers =  mysqli_real_escape_string($conn, $_POST['txtRequiredCarers']);

    $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `col_required_carers` = '$txtRequiredCarers' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
    if ($sqlInsertCareCalls) {
        $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `col_required_carers` = '$txtRequiredCarers' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        if ($sqlUpdateManageRunCareCalls) {
            $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `col_required_carers` = '$txtRequiredCarers' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($sqlUpdateScheduleRunCareCalls) {
                header("Location: ./client-details?uryyToeSS4=$clientId");
            } else {
                header("Location: ./client-details?uryyToeSS4=$clientId");
            }
        } else {
            header("Location: ./client-details?uryyToeSS4=$clientId");
        }
    } else {
    }
}
