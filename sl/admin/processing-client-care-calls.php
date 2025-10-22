<?php
if (isset($_POST['btnSubmitClientgCalls'])) {
    include('dbconnections.php');

    $clientId = mysqli_real_escape_string($conn, $_POST['clientId']);

    $careCalls = [
        'Morning' => ['in' => $_POST['txtMorDateTimeIn'], 'out' => $_POST['txtMorDateTimeOut']],
        'Lunch' => ['in' => $_POST['txtLunDateTimeIn'], 'out' => $_POST['txtLunDateTimeOut']],
        'tea' => ['in' => $_POST['txtTeaDateTimeIn'], 'out' => $_POST['txtTeaDateTimeOut']],
        'bed' => ['in' => $_POST['txtBedDateTimeIn'], 'out' => $_POST['txtBedDateTimeOut']]
    ];

    foreach ($careCalls as $callType => $times) {
        $dateTimeIn = mysqli_real_escape_string($conn, $times['in']);
        $dateTimeOut = mysqli_real_escape_string($conn, $times['out']);

        $updateClientCalls = "UPDATE tbl_clienttime_calls SET dateTime_in = '$dateTimeIn', dateTime_out = '$dateTimeOut' 
                              WHERE uryyToeSS4 = '$clientId' AND care_calls = '$callType'";
        $updateManageRuns = "UPDATE tbl_manage_runs SET dateTime_in = '$dateTimeIn', dateTime_out = '$dateTimeOut' 
                             WHERE uryyToeSS4 = '$clientId' AND care_calls = '$callType'";

        if (!mysqli_query($conn, $updateClientCalls) || !mysqli_query($conn, $updateManageRuns)) {
            die("Error updating records: " . mysqli_error($conn));
        }
    }

    header("Location: ./client-details?uryyToeSS4=$clientId");
    exit();
}
