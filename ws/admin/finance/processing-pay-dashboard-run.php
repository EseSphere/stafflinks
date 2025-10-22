<?php

if (isset($_POST['btnCreatePayRun'])) {
    include('dbconnections.php');

    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodEnd']);
    $txtCareGiverId = mysqli_real_escape_string($conn, $_REQUEST['txtCareGiver']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $txtTravelRate = '0.00';
    $txtWaitingRate = '0.00';
    $txtExtraRate = '0.00';
    $txtCareStatus = 'Checked in';
    $txtMonth = date('F');

    //$sel_firstcarer_Name = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$txtPeriodStart' ");
    //while ($row = mysqli_fetch_array($sel_firstcarer_Name)) {
    //$db_workerNames = $row['team_first_name'] . " " . $row['team_last_name'];
    //$db_firstCarerWorkRes = $row['col_team_resource'];
    // }

    $myCheckres = mysqli_query($conn, "SELECT * FROM tbl_pay_run WHERE (col_start_date = '$txtPeriodStart' AND col_carer_Id = '$txtCareGiverId' AND `col_end_date` = '$txtPeriodEnd' AND `col_company_Id` = '$txtCompanyId')");
    $countRes = mysqli_num_rows($myCheckres);
    if ($countRes == 1) {
        header('Location: ./already-exist.php');
    } else {
        $sql_get_pay_runId = mysqli_query($conn, "SELECT col_pay_runId FROM `tbl_pay_run` ORDER BY userId DESC LIMIT 1");
        $row_get_pay_runId = mysqli_fetch_array($sql_get_pay_runId, MYSQLI_ASSOC);
        $count_pay_runId = mysqli_num_rows($sql_get_pay_runId);
        $varPayRunId = $row_get_pay_runId['col_pay_runId'];
        if ($count_pay_runId != 0) {
            $varIncrementPayRunId = $varPayRunId + 1;
            $sql_create_pay_run = mysqli_query($conn, "INSERT INTO tbl_pay_run (col_caregiver, col_Time_In, col_Time_Out, col_work_rate, col_travel_rate, col_waiting_rate, col_miles, col_mileage_rate, col_extra_rate, col_start_date, col_end_date, col_month, col_pay_runId, col_carer_Id, col_company_Id) 
            SELECT carer_Name, planned_timeIn, planned_timeOut, col_carecall_rate, '$txtTravelRate', '$txtWaitingRate', col_miles, col_mileage, '$txtExtraRate', '$txtPeriodStart', '$txtPeriodEnd', '$txtMonth', '$varIncrementPayRunId', col_carer_Id, col_company_Id FROM tbl_daily_shift_records WHERE (shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND (col_carer_Id = '$txtCareGiverId' OR shift_status = '$txtCareStatus') AND col_visit_confirmation = 'Confirmed' AND col_company_Id = '$txtCompanyId') ");
            if ($sql_create_pay_run) {
                header("Location: ./pay-dashboard-657464i-77rf6646-8ui4746");
            } else {
                echo "Error: " . $sql_create_pay_run . "<br>" . mysqli_error($conn);
            }
        } else {
            $varIncrementPayRunId = '0095778';
            $sql_create_pay_run = mysqli_query($conn, "INSERT INTO tbl_pay_run (col_caregiver, col_Time_In, col_Time_Out, col_work_rate, col_travel_rate, col_waiting_rate, col_miles, col_mileage_rate, col_extra_rate, col_start_date, col_end_date, col_month, col_pay_runId, col_carer_Id, col_company_Id) 
            SELECT carer_Name, planned_timeIn, planned_timeOut, col_carecall_rate, '$txtTravelRate', '$txtWaitingRate', col_miles, col_mileage, '$txtExtraRate', '$txtPeriodStart', '$txtPeriodEnd', '$txtMonth', '$varIncrementPayRunId', col_carer_Id, col_company_Id FROM tbl_daily_shift_records WHERE (shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND (col_carer_Id = '$txtCareGiverId' OR shift_status = '$txtCareStatus') AND col_visit_confirmation = 'Confirmed' AND col_company_Id = '$txtCompanyId') ");
            if ($sql_create_pay_run) {
                header("Location: ./pay-dashboard-657464i-77rf6646-8ui4746");
            } else {
                echo "Error: " . $sql_create_pay_run . "<br>" . mysqli_error($conn);
            }
        }
    }
}
