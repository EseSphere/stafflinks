<?php

if (isset($_POST['btnCreatePayRun'])) {
    include('dbconnections.php');

    if (isset($_POST['txtConfirmId'])) {
        foreach ($_POST['txtConfirmId'] as $updateid) {
            $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart_' . $updateid]);
            $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd_' . $updateid]);
            $txtCareGiver = mysqli_real_escape_string($conn, $_POST['txtCareGiver_' . $updateid]);
            $txtConfirmedVisits = 'Confirmed';

            $sql_confirm_visits = mysqli_query($conn, "UPDATE `tbl_daily_shift_records` SET `col_visit_confirmation` = '$txtConfirmedVisits' 
            WHERE ((col_carer_Id = '$updateid' OR col_carer_Id = '$txtCareGiver') AND shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
            if ($sql_confirm_visits) {
                header("Location: ./dashboard-009475-i93544-88847-11264");
            } else {
                header("Location: ./error-page");
            }
        }
    } else {
        header("Location: ./error-page");
    }
}
