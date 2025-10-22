<?php

if (isset($_POST['btnScheduleRuns'])) {

    include('dbconnections.php');

    $txtFirstCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtFirstCarer']);
    $txtSecondCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtSecondCarer']);
    $txtClientGroup = mysqli_real_escape_string($conn, $_REQUEST['txtClientGroup']);

    $txtHalfDay = mysqli_real_escape_string($conn, $_REQUEST['txtHalfDay']);
    $txtLateCalls = mysqli_real_escape_string($conn, $_REQUEST['txtLateCalls']);
    $txtSupportCalls = mysqli_real_escape_string($conn, $_REQUEST['txtSupportCalls']);
    $txtAllDay = mysqli_real_escape_string($conn, $_REQUEST['txtAllDay']);

    $txtShiftDate = mysqli_real_escape_string($conn, $_REQUEST['txtShiftDate']);

    $clientResource = mysqli_real_escape_string($conn, $_REQUEST['clientResource']);
    $carecalls_Id = mysqli_real_escape_string($conn, $_REQUEST['carecallID']);
    $timelineColour = "#34495e";
    $righttoDisplay = "True";
    $status = "Action needed";
    $bgChange = 'white';


    $sel_firstcarer_Name = mysqli_query($conn, "SELECT * FROM tbl_goesoft_carers_account WHERE user_special_Id = '$txtFirstCarerId' ");
    while ($row = mysqli_fetch_array($sel_firstcarer_Name)) {
        $db_workerNames = $row['user_fullname'];
    }


    $sel_secondcarer_Name = mysqli_query($conn, "SELECT * FROM tbl_goesoft_carers_account WHERE user_special_Id = '$txtSecondCarerId' ");
    while ($row = mysqli_fetch_array($sel_secondcarer_Name)) {
        $db_workerNames2 = $row['user_fullname'];
    }


    $myCheck = "SELECT * FROM tbl_schedule_calls WHERE client_area = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        if ($txtHalfDay) {
            $updateMysqlTable = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' ");
            if ($updateMysqlTable) {

                $updatelunchColumn = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' ");
                if ($updatelunchColumn) {
                    header("Location: ./success-page");
                }
            } else {
                header("Location: ./not-successful-page");
            }
        } else if ($txtLateCalls) {
            $updateMysqlTable2 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' ");
            if ($updateMysqlTable2) {

                $updatelunchColumn2 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' ");
                if ($updatelunchColumn2) {
                    header("Location: ./success-page");
                }
            } else {
                header("Location: ./not-successful-page");
            }
        } else if ($txtSupportCalls) {
            $updateMysqlTable0 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' ");
            if ($updateMysqlTable0) {
                header("Location: ./success-page");
            } else {
                header("Location: ./not-successful-page");
            }
        } else if ($txtAllDay) {
            $updateMysqlTable3 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' ");
            if ($updateMysqlTable3) {
                header("Location: ./success-page");
            } else {
                header("Location: ./not-successful-page");
            }
        }
    } else {

        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, care_calls, dateTime_in, dateTime_out) 
        SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, care_calls, dateTime_in, dateTime_out FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");

        if ($CopyClient_timeDetailssql) {
            if ($txtHalfDay) {
                $updateMysqlTable4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' ");
                if ($updateMysqlTable4) {

                    $updatelunchColumn4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `call_status` = '$status', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' ");
                    if ($updatelunchColumn4) {
                        header("Location: ./success-page");
                    }
                } else {
                    header("Location: ./not-successful-page");
                }
            } else if ($txtLateCalls) {
                $updateMysqlTable5 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' ");
                if ($updateMysqlTable5) {

                    $updatelunchColumn5 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' ");
                    if ($updatelunchColumn5) {
                        header("Location: ./success-page");
                    }
                } else {
                    header("Location: ./not-successful-page");
                }
            } else if ($txtSupportCalls) {
                $updateMysqlTable0 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Support-work' AND `col_area_Id` = '$txtClientGroup' ");
                if ($updateMysqlTable0) {
                    header("Location: ./success-page");
                } else {
                    header("Location: ./not-successful-page");
                }
            } else if ($txtAllDay) {
                $updateMysqlTable6 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer`= '$db_workerNames', `second_carer`= '$db_workerNames2', `first_carer_Id`= '$txtFirstCarerId', `second_carer_Id`= '$txtSecondCarerId', `Clientshift_Date`= '$txtShiftDate', `client_resource`= '$clientResource', `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' ");
                if ($updateMysqlTable6) {
                    header("Location: ./success-page");
                } else {
                    header("Location: ./not-successful-page");
                }
            }
        }
    }
}
