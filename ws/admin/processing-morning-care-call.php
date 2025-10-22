<?php

if (isset($_POST['btnSubmitCaregCall'])) {
    include('dbconnections.php');
    function get_post($conn, $key)
    {
        return mysqli_real_escape_string($conn, trim($_POST[$key] ?? ''));
    }

    $clientId = get_post($conn, 'clientId');
    $txtDateTimeIn = get_post($conn, 'txtDateTimeIn');
    $txtDateTimeOut = get_post($conn, 'txtDateTimeOut');
    $txtRequiredCarers = get_post($conn, 'txtRequiredCarers');
    $txtClientFunding = get_post($conn, 'txtClientFunding');
    $txtMonday = get_post($conn, 'txtMonday');
    $txtTuesday = get_post($conn, 'txtTuesday');
    $txtWednesday = get_post($conn, 'txtWednesday');
    $txtThursday = get_post($conn, 'txtThursday');
    $txtFriday = get_post($conn, 'txtFriday');
    $txtSaturday = get_post($conn, 'txtSaturday');
    $txtSunday = get_post($conn, 'txtSunday');
    $txtMorningStarts = get_post($conn, 'txtMorningStarts');
    $txtMorningEnd = get_post($conn, 'txtMorningEnd');
    $txtPeriod = get_post($conn, 'txtPeriod');
    $txtPeriodCategory = get_post($conn, 'txtPeriodCategory');
    $clickDisplayDaily = get_post($conn, 'clickDisplayDaily');
    $clickDisplayOneTime = get_post($conn, 'clickDisplayOneTime');
    $clickDisplayCustom = get_post($conn, 'clickDisplayCustom');


    if ($clickDisplayDaily) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        if ($txtDateTimeOut <= $txtDateTimeIn) {
            header("Location: ./date-time-error-page");
        } else {
            $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtMorningStarts', `col_endDate` = '$txtMorningEnd', `col_occurence` = '$txtMorningStarts', `col_period_two` = 'Daily' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($sqlInsertCareCalls) {
                $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtMorningStarts', `col_endDate` = '$txtMorningEnd', `col_occurence` = '$txtMorningStarts', `col_period_two` = 'Daily' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlUpdateManageRunCareCalls) {
                    $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_required_carers` = '$txtRequiredCarers', `col_period_two` = 'Daily' WHERE (uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND Clientshift_Date >= '$txtMorningStarts' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
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
    } else if ($clickDisplayOneTime) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        if ($txtDateTimeOut <= $txtDateTimeIn) {
            header("Location: ./date-time-error-page");
        } else {
            $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtMorningStarts', `col_endDate` = '$txtMorningEnd', `col_occurence` = '$txtMorningStarts', `col_period_two` = 'Monthly' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($sqlInsertCareCalls) {
                $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtMorningStarts', `col_endDate` = '$txtMorningEnd', `col_occurence` = '$txtMorningStarts', `col_period_two` = 'Monthly' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlUpdateManageRunCareCalls) {
                    $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_required_carers` = '$txtRequiredCarers', `col_period_two` = 'Monthly' WHERE (uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND Clientshift_Date >= '$txtMorningStarts' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
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
    } else if ($clickDisplayCustom) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        if ($txtDateTimeOut <= $txtDateTimeIn) {
            header("Location: ./date-time-error-page");
        } else {
            $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtMorningStarts', `col_endDate` = '$txtMorningEnd', `col_occurence` = '$txtMorningStarts', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($sqlInsertCareCalls) {
                $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtMorningStarts', `col_endDate` = '$txtMorningEnd', `col_occurence` = '$txtMorningStarts', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlUpdateManageRunCareCalls) {
                    $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_required_carers` = '$txtRequiredCarers', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE (uryyToeSS4 = '$clientId' AND care_calls = 'Morning' AND Clientshift_Date >= '$txtMorningStarts' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
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
    }
}
