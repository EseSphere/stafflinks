<?php

if (isset($_POST['btnScheduleRuns'])) {

    include('dbconnections.php');

    $txtFirstCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtFirstCarer']);
    $itemid = mysqli_real_escape_string($conn, $_REQUEST['itemid']);
    $txtSecondCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtSecondCarer']);
    $txtClientGroup = mysqli_real_escape_string($conn, $_REQUEST['txtClientGroup']);

    $txtHalfDay = mysqli_real_escape_string($conn, $_REQUEST['txtHalfDay']);
    $txtLateCalls = mysqli_real_escape_string($conn, $_REQUEST['txtLateCalls']);
    $txtSupportCalls = mysqli_real_escape_string($conn, $_REQUEST['txtSupportCalls']);
    $txtAllDay = mysqli_real_escape_string($conn, $_REQUEST['txtAllDay']);

    $txtShiftDate = mysqli_real_escape_string($conn, $_REQUEST['txtShiftDate']);

    $carecalls_Id = mysqli_real_escape_string($conn, $_REQUEST['carecallID']);

    $attemptone = mysqli_real_escape_string($conn, $_REQUEST['firstAttempId']);
    $attempttwo = mysqli_real_escape_string($conn, $_REQUEST['weekoneId']);
    $attemptthree = mysqli_real_escape_string($conn, $_REQUEST['weektwoId']);

    $firstAttempId = hash('sha256', $attemptone);
    $weekoneId = hash('sha256', $attempttwo);
    $weektwoId = hash('sha256', $attemptthree);

    $timelineColour = "#34495e";
    $righttoDisplay = "True";
    $status = "Scheduled";
    $bgChange = 'rgba(44, 62, 80,.5)';

    $txtNextWeeksTrue = mysqli_real_escape_string($conn, $_REQUEST['txtNextWeeksTrue']);
    $txtNexttwoWeeksTrue = mysqli_real_escape_string($conn, $_REQUEST['txtNexttwoWeeksTrue']);

    $oneWeekInterval = date("Y-m-d", strtotime($txtShiftDate . "+7 day"));
    $twoWeekInterval = date("Y-m-d", strtotime($txtShiftDate . "+14 day"));

    $sel_firstcarer_Name = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$txtFirstCarerId' ");
    while ($row = mysqli_fetch_array($sel_firstcarer_Name)) {
        $db_workerNames = $row['team_first_name'] . " " . $row['team_last_name'];
        $db_firstCarerWorkRes = $row['col_team_resource'];
    }

    $sel_secondcarer_Name = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$txtSecondCarerId' ");
    while ($row = mysqli_fetch_array($sel_secondcarer_Name)) {
        $db_workerNames2 = $row['team_first_name'] . " " . $row['team_last_name'];
        $db_secondCarerWorkRes = $row['col_team_resource'];
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Write your code here
    if ($itemid) {
        //Check if double call is selected
        if ($txtNextWeeksTrue) {
            //Check if it's one week if that's is true then get all the one week information and add it up
            if ($txtHalfDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert two carers into database, repeat the call next week and the care call should be for morning and lunch only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                        //Insert data for next week (repeat routine)
                        if ($CopyClient_timeDetailssql) {
                            $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                            if ($firstCarer_nextWeek) {
                                //Start General insertion line of code here
                                $secondCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                                if ($secondCarer_nextWeek) {
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            } else if ($txtLateCalls) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert two carers into database, repeat the call next week and the care call should be for tea and bed only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        //Insert data for extra carecalls for first carer
                        if ($CopyClient_timeDetail) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Start General extra insertion line of code here for second carer
                                $CopyClient_extra_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                //Insert data for extra carecalls for first carer
                                if ($CopyClient_extra_timeDetailssql) {


                                    $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                    if ($firstCarer_nextWeek) {
                                        //Start General insertion line of code here
                                        $secondCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                        if ($secondCarer_nextWeek) {
                                            //Start General insertion line of code for extra care call first carer here
                                            $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                            if ($firstCarer_extra_nextWeek) {
                                                //Start General insertion line of code for extra care call second carer here
                                                $secondCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                                if ($secondCarer_extra_nextWeek) {
                                                    header("Location: ./success-page");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else if ($txtAllDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert two carers into database, repeat the call next week and the care call should be for all day.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch', 'Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        //Insert data for next week (repeat routine)
                        if ($CopyClient_timeDetail) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Start General extra insertion line of code here for second carer
                                $CopyClient_extra_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                //Insert data for extra carecalls for first carer
                                if ($CopyClient_extra_timeDetailssql) {
                                    $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                    if ($firstCarer_nextWeek) {
                                        //Start General insertion line of code here
                                        $secondCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                        if ($secondCarer_nextWeek) {
                                            //Start General insertion line of code for extra care call first carer here
                                            $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                            if ($firstCarer_extra_nextWeek) {
                                                //Start General insertion line of code for extra care call second carer here
                                                $secondCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                                if ($secondCarer_extra_nextWeek) {
                                                    header("Location: ./success-page");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else if ($txtNexttwoWeeksTrue) {
            //Check if it's one week if that's is true then get all the one week information and add it up
            if ($txtHalfDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for morning and lunch only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                        //Insert data for next week (repeat routine)
                        if ($CopyClient_timeDetailssql) {
                            $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                            if ($firstCarer_nextWeek) {
                                //Start General insertion line of code here
                                $secondCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                                if ($secondCarer_nextWeek) {
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            } else if ($txtLateCalls) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for tea and bed only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        //Insert data for next week (repeat routine)
                        if ($CopyClient_timeDetail) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Start General extra insertion line of code here for second carer
                                $CopyClient_extra_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                //Insert data for extra carecalls for first carer
                                if ($CopyClient_extra_timeDetailssql) {
                                    $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                    if ($firstCarer_nextWeek) {
                                        //Start General insertion line of code here
                                        $secondCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                        if ($secondCarer_nextWeek) {
                                            //Start General insertion line of code for extra care call first carer here
                                            $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                            if ($firstCarer_extra_nextWeek) {
                                                //Start General insertion line of code for extra care call second carer here
                                                $secondCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                                if ($secondCarer_extra_nextWeek) {
                                                    header("Location: ./success-page");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else if ($txtAllDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for all day.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch', 'Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        //Insert data for next week (repeat routine)
                        if ($CopyClient_timeDetail) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Start General extra insertion line of code here for second carer
                                $CopyClient_extra_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                //Insert data for extra carecalls for first carer
                                if ($CopyClient_extra_timeDetailssql) {
                                    $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                    if ($firstCarer_nextWeek) {
                                        //Start General insertion line of code here
                                        $secondCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                                        if ($secondCarer_nextWeek) {
                                            //Start General insertion line of code for extra care call first carer here
                                            $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                            if ($firstCarer_extra_nextWeek) {
                                                //Start General insertion line of code for extra care call second carer here
                                                $secondCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                                if ($secondCarer_extra_nextWeek) {
                                                    header("Location: ./success-page");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //If one week or two week is not selected under double call then insert call data into database.
            if ($txtHalfDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for morning and lunch only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                        if ($CopyClient_timeDetailssql) {
                            header("Location: ./success-page");
                        }
                    }
                }
            } else if ($txtLateCalls) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for tea and bed only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        if ($CopyClient_timeDetail) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Start General extra insertion line of code here for second carer
                                $CopyClient_extra_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                //Insert data for extra carecalls for first carer
                                if ($CopyClient_extra_timeDetailssql) {
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            } else if ($txtAllDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for all day.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch', 'Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Start General insertion line of code here
                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        if ($CopyClient_timeDetail) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Start General extra insertion line of code here for second carer
                                $CopyClient_extra_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_secondCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                //Insert data for extra carecalls for first carer
                                if ($CopyClient_extra_timeDetailssql) {
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Check if single call is selected!
        if ($txtNextWeeksTrue) {
            //Check if it's one week if that's is true then get all the one week information and add it up
            if ($txtHalfDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert two carers into database, repeat the call next week and the care call should be for morning and lunch only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Insert data for next week (repeat routine)
                        $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                        if ($firstCarer_nextWeek) {
                            header("Location: ./success-page");
                        }
                    }
                }
            } else if ($txtLateCalls) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert two carers into database, repeat the call next week and the care call should be for tea and bed only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Insert data for next week (repeat routine)
                        $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        if ($firstCarer_nextWeek) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Insert data for next week (repeat routine)
                                $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                if ($CopyClient_extra_timeDetail) {
                                    //Start General extra insertion line of code here for first carer
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            } else if ($txtAllDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert two carers into database, repeat the call next week and the care call should be for all day.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch', 'Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Insert data for next week (repeat routine)
                        $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        if ($firstCarer_nextWeek) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Insert data for next week (repeat routine)
                                $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$oneWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                if ($CopyClient_extra_timeDetail) {
                                    //Start General extra insertion line of code here for first carer
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            }
        } else if ($txtNexttwoWeeksTrue) {
            //Check if it's one week if that's is true then get all the one week information and add it up
            if ($txtHalfDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for morning and lunch only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch', 'Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Insert data for next week (repeat routine)
                        $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                        if ($firstCarer_nextWeek) {
                            header("Location: ./success-page");
                        }
                    }
                }
            } else if ($txtLateCalls) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for tea and bed only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Insert data for next week (repeat routine)
                        $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        if ($firstCarer_nextWeek) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_timeDetail) {
                                //Insert data for next week (repeat routine)
                                $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                if ($CopyClient_extra_timeDetail) {
                                    //Start General extra insertion line of code here for first carer
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            } else if ($txtAllDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for all day.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch', 'Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch','Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        //Insert data for next week (repeat routine)
                        $firstCarer_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch','Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                        if ($firstCarer_nextWeek) {
                            //Start General extra insertion line of code here for first carer
                            $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                            if ($CopyClient_extra_timeDetail) {
                                //Insert data for next week (repeat routine)
                                $firstCarer_extra_nextWeek = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$twoWeekInterval', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                                if ($CopyClient_extra_timeDetail) {
                                    //Start General extra insertion line of code here for first carer
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    }
                }
            }
        } else {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //If one week or two week is not selected under single call then insert call data into database.
            if ($txtHalfDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for morning and lunch only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        header("Location: ./success-page");
                    }
                }
            } else if ($txtLateCalls) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for tea and bed only.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                        if ($CopyClient_extra_timeDetail) {
                            header("Location: ./success-page");
                        }
                    }
                }
            } else if ($txtAllDay) {
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Insert one carers into database, repeat the call next week and the care call should be for all day.
                //Insert the first row
                $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' AND care_calls IN('Morning', 'Lunch', 'Tea', 'Bed')";
                $myCheckres = mysqli_query($conn, $myCheck);
                $countRes = mysqli_num_rows($myCheckres);

                if ($countRes != 0) {
                    header('Location: ./already-exist');
                } else {
                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Morning', 'Lunch', 'Tea', 'Bed') AND run_area_nameId = '$txtClientGroup' ");
                    if ($CopyClient_timeDetail) {
                        $CopyClient_extra_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, dateTime_in, dateTime_out, Clientshift_Date, team_resource, timeline_colour, rightTo_display, call_status, bgChange, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, dateTime_in, dateTime_out, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$righttoDisplay', '$status', '$bgChange', col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE care_calls IN('Extra') AND run_area_nameId = '$txtClientGroup' ");
                        if ($CopyClient_extra_timeDetail) {
                            header("Location: ./success-page");
                        }
                    }
                }
            }
        }
    }
}
