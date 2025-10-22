<?php

if (isset($_POST['btnRestoreSingleVisit'])) {
    include('dbconnections.php');

    $txtUserId = mysqli_real_escape_string($conn, $_POST['txtUserId']);
    $txtCarerSpecialId = mysqli_real_escape_string($conn, $_POST['txtCarerSpecialId']);
    $txtConfirmedVisits = 'Unconfirmed';

    $sql_confirm_visits = mysqli_query($conn, "UPDATE `tbl_daily_shift_records` SET `col_visit_confirmation` = '$txtConfirmedVisits' 
    WHERE (userId = '$txtUserId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    if ($sql_confirm_visits) {
        echo "<script>
                window.history.go(-1);
            </script>";
        //header("Location: ./pay-run-brake-down?col_carer_Id=$txtCarerSpecialId");
    }
}
