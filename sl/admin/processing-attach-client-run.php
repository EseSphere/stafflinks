<?php

if (isset($_POST['btnAddToGroup'])) {

    include('dbconnections.php');

    $txtReturnDefault = mysqli_real_escape_string($conn, $_REQUEST['txtReturnDefault']);
    $txtAllClientIds = mysqli_real_escape_string($conn, $_REQUEST['txtAllClientIds']);
    $txtrunName = mysqli_real_escape_string($conn, $_REQUEST['txtrunName']);
    $txtAllClientCalls = mysqli_real_escape_string($conn, $_REQUEST['txtAllClientCalls']);
    $txtAllRunsId = mysqli_real_escape_string($conn, $_REQUEST['txtAllRunsId']);
    $txtAllRunCity = mysqli_real_escape_string($conn, $_REQUEST['txtAllRunCity']);

    $txtextRequiredCarers = mysqli_real_escape_string($conn, $_REQUEST['txtextRequiredCarers']);
    $txtStartDate = mysqli_real_escape_string($conn, $_REQUEST['txtStartDate']);
    $txtendDate = mysqli_real_escape_string($conn, $_REQUEST['txtendDate']);
    $txtOccurence = mysqli_real_escape_string($conn, $_REQUEST['txtOccurence']);
    $txtPeriodOne = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodOne']);
    $txtPeriodTwo = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodTwo']);
    $txtRightToDisplay = mysqli_real_escape_string($conn, $_REQUEST['txtRightToDisplay']);

    $txtRunCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtRunCompanyId']);
    $txtStatuscolor = "rgba(22, 160, 133,1.0)";

    $myCheck = "SELECT * FROM tbl_manage_runs WHERE (uryyToeSS4 = '$txtAllClientIds' AND run_area_nameId = '$txtAllRunsId' 
    AND care_calls = '$txtAllClientCalls' AND col_company_Id = '$txtRunCompanyId') ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        header('Location: ./error-manage-run');
    } else {
        $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_manage_runs (client_name, col_run_name, client_area, col_client_city, 
    uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, 
    col_sunday, col_client_funding, col_funding_rate, col_required_carers, col_startDate, col_endDate, col_occurence, col_period_one, 
    col_period_two, col_right_to_display, run_area_nameId, col_status, col_company_Id) 
    SELECT client_name, '$txtrunName', client_area, '$txtAllRunCity', uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, 
    col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, col_sunday, col_client_funding, col_funding_rate, 
    col_required_carers, col_startDate, col_endDate, col_occurence, col_period_one, col_period_two, col_right_to_display, 
    '$txtAllRunsId', '$txtStatuscolor', col_company_Id FROM tbl_clienttime_calls WHERE (uryyToeSS4 = '$txtAllClientIds' 
    AND care_calls ='$txtAllClientCalls') ");
        if ($CopyClient_timeDetail) {
            header("Location: ./attach-clients?run_ids=$txtAllRunsId");
        }
    }
}
