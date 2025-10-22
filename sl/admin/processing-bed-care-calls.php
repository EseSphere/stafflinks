<?php

if (isset($_POST['btnSubmitCaregCall'])) {
    include('dbconnections.php');

    $clientId = mysqli_real_escape_string($conn, $_POST['clientId'] ?? '');
    $txtDateTimeIn = mysqli_real_escape_string($conn, $_POST['txtDateTimeIn'] ?? '');
    $txtDateTimeOut = mysqli_real_escape_string($conn, $_POST['txtDateTimeOut'] ?? '');
    $txtRequiredCarers = mysqli_real_escape_string($conn, $_POST['txtRequiredCarers'] ?? '');
    $txtClientFunding = mysqli_real_escape_string($conn, $_POST['txtClientFunding'] ?? '');

    $txtMonday = mysqli_real_escape_string($conn, $_POST['txtMonday'] ?? '');
    $txtTuesday = mysqli_real_escape_string($conn, $_POST['txtTuesday'] ?? '');
    $txtWednesday = mysqli_real_escape_string($conn, $_POST['txtWednesday'] ?? '');
    $txtThursday = mysqli_real_escape_string($conn, $_POST['txtThursday'] ?? '');
    $txtFriday = mysqli_real_escape_string($conn, $_POST['txtFriday'] ?? '');
    $txtSaturday = mysqli_real_escape_string($conn, $_POST['txtSaturday'] ?? '');
    $txtSunday = mysqli_real_escape_string($conn, $_POST['txtSunday'] ?? '');

    $txtBedStarts = mysqli_real_escape_string($conn, $_REQUEST['txtBedStarts'] ?? '');
    $txtBedEnd = mysqli_real_escape_string($conn, $_REQUEST['txtBedEnd'] ?? '');

    $txtPeriod = mysqli_real_escape_string($conn, $_REQUEST['txtPeriod'] ?? '');
    $txtPeriodCategory = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodCategory'] ?? '');

    $clickDisplayDaily = mysqli_real_escape_string($conn, $_REQUEST['clickDisplayDaily'] ?? '');
    $clickDisplayOneTime = mysqli_real_escape_string($conn, $_REQUEST['clickDisplayOneTime'] ?? '');
    $clickDisplayCustom = mysqli_real_escape_string($conn, $_REQUEST['clickDisplayCustom'] ?? '');

    if ($clickDisplayDaily) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        if ($txtDateTimeOut <= $txtDateTimeIn) {
            header("Location: ./date-time-error-page");
        } else {
            $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Daily' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($sqlInsertCareCalls) {
                $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Daily' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlUpdateManageRunCareCalls) {
                    $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_required_carers` = '$txtRequiredCarers', `col_period_two` = 'Daily' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtBedStarts' AND care_calls = 'Bed') ");
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
            $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Monthly' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($sqlInsertCareCalls) {
                $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Monthly' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlUpdateManageRunCareCalls) {
                    $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_required_carers` = '$txtRequiredCarers', `col_period_two` = 'Monthly' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtBedStarts' AND care_calls = 'Bed') ");
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
            $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($sqlInsertCareCalls) {
                $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE uryyToeSS4 = '$clientId' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlUpdateManageRunCareCalls) {
                    $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_required_carers` = '$txtRequiredCarers', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtBedStarts' AND care_calls = 'Bed') ");
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
