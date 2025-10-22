<?php

include('dbconnections.php');

if (isset($_REQUEST['hdn_insert'])) {
    $data = array();

    $txtAllClientIds = mysqli_escape_string($conn, $_REQUEST['txtAllClientIds']);
    $txtAllClientIds = mysqli_escape_string($conn, $_REQUEST['txtAllClientIds']);
    $txtAllRunsId = mysqli_escape_string($conn, $_REQUEST['txtAllRunsId']);
    $txtStatuscolor = "rgba(22, 160, 133,1.0)";

    $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_manage_runs (client_name, client_area, uryyToeSS4, care_calls, dateTime_in, dateTime_out) 
    SELECT client_name, client_area, uryyToeSS4, care_calls, dateTime_in, dateTime_out FROM tbl_clienttime_calls WHERE uryyToeSS4 = '$txtAllClientIds' AND care_calls ='$txtAllClientCalls' ");

    if (mysqli_affected_rows($conn)) {
        $data['status'] = 1;
    } else {
        $data['status'] = 0;
    }

    echo json_encode($data);
}
