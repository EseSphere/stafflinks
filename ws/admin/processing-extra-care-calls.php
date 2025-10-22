<?php

if (isset($_POST['btnSubmitMorningCall'])) {

    include('dbconnections.php');

    $clientId =  mysqli_real_escape_string($conn, $_POST['clientId']);
    $txtDateTimeIn =  mysqli_real_escape_string($conn, $_POST['txtDateTimeIn']);
    $txtDateTimeOut =  mysqli_real_escape_string($conn, $_POST['txtDateTimeOut']);

    if ($txtDateTimeOut <= $txtDateTimeIn) {
        header("Location: ./date-time-error-page");
    } else {
        $Insert_carecall_data_sql = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut' WHERE uryyToeSS4 = '$clientId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' AND care_calls = 'Extra' ");
        if ($Insert_carecall_data_sql) {
            header("Location: ./client-details?uryyToeSS4=$clientId");
        } else {
        }
    }
}
