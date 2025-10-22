<?php

if (isset($_POST['btnEndCareCall'])) {
    include('dbconnections.php');

    $txtClientId = mysqli_real_escape_string($conn, $_POST['txtClientId']);
    $txtClientCareCall = mysqli_real_escape_string($conn, $_POST['txtClientCareCall']);
    $txtEndDate = mysqli_real_escape_string($conn, $_POST['txtEndDate']);

    $sql_delete_extratime_call = mysqli_query($conn, "UPDATE tbl_clienttime_calls SET col_endDate = '$txtEndDate' WHERE (uryyToeSS4 = '$txtClientId' AND care_calls = '$txtClientCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    if ($sql_delete_extratime_call) {
        $sql_delete_managerun_call = mysqli_query($conn, "UPDATE tbl_manage_runs SET col_endDate = '$txtEndDate' WHERE (uryyToeSS4 = '$txtClientId' AND care_calls = '$txtClientCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
        if ($sql_delete_managerun_call) {
            $sql_delete_schedule_call = mysqli_query($conn, "UPDATE tbl_schedule_calls SET Clientshift_Date = '$txtEndDate', first_carer = '', first_carer_Id = '', team_resource = '' WHERE (uryyToeSS4 = '$txtClientId' AND Clientshift_Date >= '$txtEndDate' AND care_calls = '$txtClientCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
            if ($sql_delete_schedule_call) {
                header('Location: ./client-details?uryyToeSS4=' . $txtClientId . '');
            }
        }
    }
}
