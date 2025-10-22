<?php
if (isset($_POST['btnSubmitVisitSettings'])) {
    include('dbconnections.php');

    $clientId = mysqli_real_escape_string($conn, $_POST['clientId']);
    $txtDateTimeIn = mysqli_real_escape_string($conn, $_POST['txtDateTimeIn']);
    $txtDateTimeOut = mysqli_real_escape_string($conn, $_POST['txtDateTimeOut']);

    $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut' 
    WHERE (userId = '$clientId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    if ($sqlUpdateScheduleRunCareCalls) {
        header("Location: ./view-alerts-feed?userId=$clientId");
    }
}
