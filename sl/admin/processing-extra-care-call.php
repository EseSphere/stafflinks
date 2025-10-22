<?php

if (isset($_POST['btnSubmitCaregCall'])) {
    include('dbconnections.php');

    $clientId =  mysqli_real_escape_string($conn, $_POST['clientId']);
    $txtDateTimeIn =  mysqli_real_escape_string($conn, $_POST['txtDateTimeIn']);
    $txtDateTimeOut =  mysqli_real_escape_string($conn, $_POST['txtDateTimeOut']);
    $txtRequiredCarers =  mysqli_real_escape_string($conn, $_POST['txtRequiredCarers']);
    $txtClientFunding =  mysqli_real_escape_string($conn, $_POST['txtClientFunding']);

    $txtClientFullName = mysqli_real_escape_string($conn, $_REQUEST['txtClientFullName']);
    $txtClientArea = mysqli_real_escape_string($conn, $_REQUEST['txtClientArea']);

    $txtExtraCareCall = "Extra visit";

    $txtMonday =  mysqli_real_escape_string($conn, $_POST['txtMonday']);
    $txtTuesday =  mysqli_real_escape_string($conn, $_POST['txtTuesday']);
    $txtWednesday =  mysqli_real_escape_string($conn, $_POST['txtWednesday']);
    $txtThursday =  mysqli_real_escape_string($conn, $_POST['txtThursday']);
    $txtFriday =  mysqli_real_escape_string($conn, $_POST['txtFriday']);
    $txtSaturday =  mysqli_real_escape_string($conn, $_POST['txtSaturday']);
    $txtSunday =  mysqli_real_escape_string($conn, $_POST['txtSunday']);

    $txtStartDate = mysqli_real_escape_string($conn, $_REQUEST['txtStartDate']);
    $txtEndDate = mysqli_real_escape_string($conn, $_REQUEST['txtEndDate']);

    $txtPeriod = mysqli_real_escape_string($conn, $_REQUEST['txtPeriod']);
    $txtPeriodCategory = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodCategory']);

    $clickDisplayDaily = mysqli_real_escape_string($conn, $_REQUEST['clickDisplayDaily']);
    $clickDisplayOneTime = mysqli_real_escape_string($conn, $_REQUEST['clickDisplayOneTime']);
    $clickDisplayCustom = mysqli_real_escape_string($conn, $_REQUEST['clickDisplayCustom']);


    if ($clickDisplayDaily) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        $myCheck = "SELECT * FROM tbl_clienttime_calls WHERE (uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        $myCheckres = mysqli_query($conn, $myCheck);
        $countRes = mysqli_num_rows($myCheckres);

        if ($countRes != 0) {
            if ($txtDateTimeOut <= $txtDateTimeIn) {
                header("Location: ./date-time-error-page");
            } else {
                $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtStartDate', `col_endDate` = '$txtEndDate', `col_occurence` = '$txtStartDate', `col_period_two` = 'Daily' WHERE (uryyToeSS4 = '$clientId' AND col_startDate = '$txtStartDate' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                if ($sqlInsertCareCalls) {
                    $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtStartDate', `col_endDate` = '$txtEndDate', `col_occurence` = '$txtStartDate', `col_period_two` = 'Daily' WHERE (uryyToeSS4 = '$clientId' AND col_startDate = '$txtStartDate' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                    if ($sqlUpdateManageRunCareCalls) {
                        $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_period_two` = 'Daily' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtStartDate' AND care_calls = '$txtExtraCareCall') ");
                        if ($sqlUpdateScheduleRunCareCalls) {
                            header("Location: ./client-tasks?uryyToeSS4=$clientId");
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
            $insert_client_queryIns0 = mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, col_sunday, col_client_funding, col_funding_rate, col_required_carers, col_startDate, col_endDate, col_occurence, col_period_two, col_right_to_display, col_company_Id) 
            VALUES('" . $txtClientFullName . "', '" . $txtClientArea . "', '" . $clientId . "', '" . $txtExtraCareCall . "', '" . $txtDateTimeIn . "', '" . $txtDateTimeOut . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $var_client_funding_name . "', '" . $var_client_funding_rate . "', '" . $txtRequiredCarers . "', '" . $txtStartDate . "', '" . $txtEndDate . "', '" . $txtStartDate . "', 'Daily', 'True', '" . $_SESSION['usr_compId'] . "') ");
            if ($insert_client_queryIns0) {
                header("Location: ./client-tasks?uryyToeSS4=$clientId");
            }
        }
    } else if ($clickDisplayOneTime) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        $myCheck = "SELECT * FROM tbl_clienttime_calls WHERE (uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        $myCheckres = mysqli_query($conn, $myCheck);
        $countRes = mysqli_num_rows($myCheckres);

        if ($countRes != 0) {
            if ($txtDateTimeOut <= $txtDateTimeIn) {
                header("Location: ./date-time-error-page");
            } else {
                $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtStartDate', `col_endDate` = '$txtEndDate', `col_occurence` = '$txtStartDate', `col_period_two` = 'Monthly' WHERE (uryyToeSS4 = '$clientId' AND col_startDate = '$txtStartDate' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                if ($sqlInsertCareCalls) {
                    $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtStartDate', `col_endDate` = '$txtEndDate', `col_occurence` = '$txtStartDate', `col_period_two` = 'Monthly' WHERE (uryyToeSS4 = '$clientId' AND col_startDate = '$txtStartDate' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                    if ($sqlUpdateManageRunCareCalls) {
                        $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_period_two` = 'Monthly' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtStartDate' AND care_calls = '$txtExtraCareCall') ");
                        if ($sqlUpdateScheduleRunCareCalls) {
                            header("Location: ./client-tasks?uryyToeSS4=$clientId");
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
            $insert_client_queryIns0 = mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, col_sunday, col_client_funding, col_funding_rate, col_required_carers, col_startDate, col_endDate, col_occurence, col_period_two, col_right_to_display, col_company_Id) 
        VALUES('" . $txtClientFullName . "', '" . $txtClientArea . "', '" . $clientId . "', '" . $txtExtraCareCall . "', '" . $txtDateTimeIn . "', '" . $txtDateTimeOut . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $var_client_funding_name . "', '" . $var_client_funding_rate . "', '" . $txtRequiredCarers . "', '" . $txtStartDate . "', '" . $txtEndDate . "', '" . $txtStartDate . "', 'Monthly', 'True', '" . $_SESSION['usr_compId'] . "') ");
            if ($insert_client_queryIns0) {
                header("Location: ./client-tasks?uryyToeSS4=$clientId");
            }
        }
    } else if ($clickDisplayCustom) {
        $sel_client_funding_info = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_special_Id = '$txtClientFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        $row_get_client_funding_info = mysqli_fetch_array($sel_client_funding_info, MYSQLI_ASSOC);
        $var_client_funding_name = $row_get_client_funding_info['col_name'];
        $var_client_funding_rate = $row_get_client_funding_info['col_rates'];

        $myCheck = "SELECT * FROM tbl_clienttime_calls WHERE (uryyToeSS4 = '$clientId' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        $myCheckres = mysqli_query($conn, $myCheck);
        $countRes = mysqli_num_rows($myCheckres);

        if ($countRes != 0) {
            if ($txtDateTimeOut <= $txtDateTimeIn) {
                header("Location: ./date-time-error-page");
            } else {
                $sqlInsertCareCalls = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtStartDate', `col_endDate` = '$txtEndDate', `col_occurence` = '$txtStartDate', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE (uryyToeSS4 = '$clientId' AND col_startDate = '$txtStartDate' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                if ($sqlInsertCareCalls) {
                    $sqlUpdateManageRunCareCalls = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_monday` = '$txtMonday', `col_tuesday` = '$txtTuesday', `col_wednesday` = '$txtWednesday', `col_thursday` = '$txtThursday', `col_friday` = '$txtFriday', `col_saturday` = '$txtSaturday', `col_sunday` = '$txtSunday', `col_client_funding` = '$var_client_funding_name', `col_funding_rate` = '$var_client_funding_rate', `col_required_carers` = '$txtRequiredCarers', `col_startDate` = '$txtStartDate', `col_endDate` = '$txtEndDate', `col_occurence` = '$txtStartDate', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE (uryyToeSS4 = '$clientId' AND col_startDate = '$txtStartDate' AND care_calls = '$txtExtraCareCall' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                    if ($sqlUpdateManageRunCareCalls) {
                        $sqlUpdateScheduleRunCareCalls = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `dateTime_in` = '$txtDateTimeIn', `dateTime_out` = '$txtDateTimeOut', `col_period_one` = '$txtPeriod', `col_period_two` = '$txtPeriodCategory' WHERE (uryyToeSS4 = '$clientId' AND Clientshift_Date >= '$txtStartDate' AND care_calls = '$txtExtraCareCall') ");
                        if ($sqlUpdateScheduleRunCareCalls) {
                            header("Location: ./client-tasks?uryyToeSS4=$clientId");
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
            $insert_client_queryIns0 = mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_monday, col_tuesday, col_wednesday, col_thursday, col_friday, col_saturday, col_sunday, col_client_funding, col_funding_rate, col_required_carers, col_startDate, col_endDate, col_occurence, col_period_one, col_period_two, col_right_to_display, col_company_Id) 
        VALUES('" . $txtClientFullName . "', '" . $txtClientArea . "', '" . $clientId . "', '" . $txtExtraCareCall . "', '" . $txtDateTimeIn . "', '" . $txtDateTimeOut . "', '" . $txtMonday . "', '" . $txtTuesday . "', '" . $txtWednesday . "', '" . $txtThursday . "', '" . $txtFriday . "', '" . $txtSaturday . "', '" . $txtSunday . "', '" . $var_client_funding_name . "', '" . $var_client_funding_rate . "', '" . $txtRequiredCarers . "', '" . $txtStartDate . "', '" . $txtEndDate . "', '" . $txtStartDate . "', '$txtPeriod', '$txtPeriodCategory', 'True', '" . $_SESSION['usr_compId'] . "') ");
            if ($insert_client_queryIns0) {
                header("Location: ./client-tasks?uryyToeSS4=$clientId");
            }
        }
    }
}
