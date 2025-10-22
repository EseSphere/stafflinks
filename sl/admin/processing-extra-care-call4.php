<?php
include('dbconnections.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['btnSubmitExtraCall'])) {
    $clientId           = $_POST['clientId']           ?? '';
    $txtDateTimeIn      = $_POST['txtDateTimeIn']      ?? '';
    $txtDateTimeOut     = $_POST['txtDateTimeOut']     ?? '';
    $txtRequiredCarers  = $_POST['txtRequiredCarers']  ?? '';
    $txtClientFunding   = $_POST['txtClientFunding']   ?? '';

    $txtClientFullName  = $_POST['txtClientFullName']  ?? '';
    $txtClientArea       = $_POST['txtClientArea']     ?? '';
    $txtClientCity       = $_POST['txtClientCity']     ?? '';

    $txtExtraBedCareCall = "EB bed call"; // static value

    $txtMonday          = $_POST['txtMonday']          ?? '';
    $txtTuesday         = $_POST['txtTuesday']         ?? '';
    $txtWednesday       = $_POST['txtWednesday']       ?? '';
    $txtThursday        = $_POST['txtThursday']        ?? '';
    $txtFriday          = $_POST['txtFriday']          ?? '';
    $txtSaturday        = $_POST['txtSaturday']        ?? '';
    $txtSunday          = $_POST['txtSunday']          ?? '';

    $txtEBBedStarts     = $_POST['txtBedStarts']       ?? '';
    $txtEBBedEnd        = $_POST['txtBedEnd']          ?? '';

    $txtPeriod          = $_POST['txtPeriod']          ?? '';
    $txtPeriodCategory  = $_POST['txtPeriodCategory']  ?? '';

    $clickDisplayDaily   = $_POST['clickDisplayDaily']   ?? '';
    $clickDisplayOneTime = $_POST['clickDisplayOneTime'] ?? '';
    $clickDisplayCustom  = $_POST['clickDisplayCustom']  ?? '';


    if ($clickDisplayDaily) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        $myCheck = "SELECT * FROM tbl_clienttime_calls WHERE (uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        $myCheckres = mysqli_query($conn, $myCheck);
        $countRes = mysqli_num_rows($myCheckres);

        if ($countRes != 0) {
            if ($txtDateTimeOut <= $txtDateTimeIn) {
                header("Location: ./date-time-error-page");
            } else {
                $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Daily' WHERE uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlInsertCareCalls) {
                    $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Daily' WHERE uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($sqlUpdateManageRunCareCalls) {
                        $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_period_two` = 'Daily' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtEBBedStarts' AND care_calls = '$txtExtraBedCareCall') ");
                        if ($sqlUpdateScheduleRunCareCalls) {
                            header("Location: ./extra-bed-call-option?uryyToeSS4=$clientId");
                        } else {
                            header("Location: ./client-details?uryyToeSS4=$clientId");
                        }
                    } else {
                        header("Location: ./client-details?uryyToeSS4=$clientId");
                    }
                } else {
                }
            }
        } else {
            $insert_client_queryIns0 = mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, client_city, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, col_sunday, col_client_funding, col_funding_rate, col_required_carers, col_startDate, col_endDate, col_occurence, col_period_two, col_right_to_display, col_company_Id) 
        VALUES('" . $txtClientFullName . "', '" . $txtClientArea . "', '" . $txtClientCity . "', '" . $clientId . "', '" . $txtExtraBedCareCall . "', '" . $txtDateTimeIn . "', '" . $txtDateTimeOut . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $var_client_funding_name . "', '" . $var_client_funding_rate . "', '" . $txtRequiredCarers . "', '" . $txtBedStarts . "', '" . $txtBedEnd . "', '" . $txtBedStarts . "', 'Daily', 'True', '" . $_SESSION['usr_compId'] . "') ");
            if ($insert_client_queryIns0) {
                header("Location: ./extra-bed-call-option?uryyToeSS4=$clientId");
            }
        }
    } else if ($clickDisplayOneTime) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        $myCheck = "SELECT * FROM tbl_clienttime_calls WHERE (uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        $myCheckres = mysqli_query($conn, $myCheck);
        $countRes = mysqli_num_rows($myCheckres);

        if ($countRes != 0) {
            if ($txtDateTimeOut <= $txtDateTimeIn) {
                header("Location: ./date-time-error-page");
            } else {
                $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Monthly' WHERE uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlInsertCareCalls) {
                    $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_two` = 'Monthly' WHERE uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($sqlUpdateManageRunCareCalls) {
                        $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_period_two` = 'Monthly' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtEBBedStarts' AND care_calls = '$txtExtraBedCareCall') ");
                        if ($sqlUpdateScheduleRunCareCalls) {
                            header("Location: ./extra-bed-call-option?uryyToeSS4=$clientId");
                        } else {
                            header("Location: ./client-details?uryyToeSS4=$clientId");
                        }
                    } else {
                        header("Location: ./client-details?uryyToeSS4=$clientId");
                    }
                } else {
                }
            }
        } else {
            $insert_client_queryIns0 = mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, client_city, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, col_sunday, col_client_funding, col_funding_rate, col_required_carers, col_startDate, col_endDate, col_occurence, col_period_two, col_right_to_display, col_company_Id) 
        VALUES('" . $txtClientFullName . "', '" . $txtClientArea . "', '" . $txtClientCity . "', '" . $clientId . "', '" . $txtExtraBedCareCall . "', '" . $txtDateTimeIn . "', '" . $txtDateTimeOut . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $var_client_funding_name . "', '" . $var_client_funding_rate . "', '" . $txtRequiredCarers . "', '" . $txtBedStarts . "', '" . $txtBedEnd . "', '" . $txtBedStarts . "', 'Monthly', 'True', '" . $_SESSION['usr_compId'] . "') ");
            if ($insert_client_queryIns0) {
                header("Location: ./extra-bed-call-option?uryyToeSS4=$clientId");
            }
        }
    } else if ($clickDisplayCustom) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        $myCheck = "SELECT * FROM tbl_clienttime_calls WHERE (uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        $myCheckres = mysqli_query($conn, $myCheck);
        $countRes = mysqli_num_rows($myCheckres);

        if ($countRes != 0) {
            if ($txtDateTimeOut <= $txtDateTimeIn) {
                header("Location: ./date-time-error-page");
            } else {
                $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($sqlInsertCareCalls) {
                    $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtBedStarts', `col_endDate` = '$txtBedEnd', `col_occurence` = '$txtBedStarts', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraBedCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($sqlUpdateManageRunCareCalls) {
                        $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtEBBedStarts' AND care_calls = '$txtExtraBedCareCall') ");
                        if ($sqlUpdateScheduleRunCareCalls) {
                            header("Location: ./extra-bed-call-option?uryyToeSS4=$clientId");
                        } else {
                            header("Location: ./client-details?uryyToeSS4=$clientId");
                        }
                    } else {
                        header("Location: ./client-details?uryyToeSS4=$clientId");
                    }
                } else {
                }
            }
        } else {
            $insert_client_queryIns0 = mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, client_city, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, col_sunday, col_client_funding, col_funding_rate, col_required_carers, col_startDate, col_endDate, col_occurence, col_period_one, col_period_two, col_right_to_display, col_company_Id) 
        VALUES('" . $txtClientFullName . "', '" . $txtClientArea . "', '" . $txtClientCity . "', '" . $clientId . "', '" . $txtExtraBedCareCall . "', '" . $txtDateTimeIn . "', '" . $txtDateTimeOut . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $var_client_funding_name . "', '" . $var_client_funding_rate . "', '" . $txtRequiredCarers . "', '" . $txtBedStarts . "', '" . $txtBedEnd . "', '" . $txtBedStarts . "', '$txtPeriod', '$txtPeriodCategory', 'True', '" . $_SESSION['usr_compId'] . "') ");
            if ($insert_client_queryIns0) {
                header("Location: ./extra-bed-call-option?uryyToeSS4=$clientId");
            }
        }
    }
}
