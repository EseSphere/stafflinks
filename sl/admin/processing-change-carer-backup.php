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

    $clientResource = mysqli_real_escape_string($conn, $_REQUEST['clientResource']);
    $clientResource02 = mysqli_real_escape_string($conn, $_REQUEST['clientResource02']);
    $carecalls_Id = mysqli_real_escape_string($conn, $_REQUEST['carecallID']);

    $attemptone = mysqli_real_escape_string($conn, $_REQUEST['firstAttempId']);
    $attempttwo = mysqli_real_escape_string($conn, $_REQUEST['weekoneId']);
    $attemptthree = mysqli_real_escape_string($conn, $_REQUEST['weektwoId']);

    $firstAttempId = hash('sha256', $attemptone);
    $weekoneId = hash('sha256', $attempttwo);
    $weektwoId = hash('sha256', $attemptthree);

    $timelineColour = "#34495e";
    $righttoDisplay = "True";
    $status = "Action needed";
    $bgChange = 'rgba(44, 62, 80,.5)';

    $txtNextWeeksTrue = mysqli_real_escape_string($conn, $_REQUEST['txtNextWeeksTrue']);
    $txtNexttwoWeeksTrue = mysqli_real_escape_string($conn, $_REQUEST['txtNexttwoWeeksTrue']);

    $oneWeekInterval = date("Y-m-d", strtotime($txtShiftDate . "+7 day"));
    $twoWeekInterval = date("Y-m-d", strtotime($txtShiftDate . "+14 day"));

    $sel_firstcarer_Name = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$txtFirstCarerId' ");
    while ($row = mysqli_fetch_array($sel_firstcarer_Name)) {
        $db_workerNames = $row['team_first_name'] . " " . $row['team_last_name'];
    }

    $sel_secondcarer_Name = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$txtSecondCarerId' ");
    while ($row = mysqli_fetch_array($sel_secondcarer_Name)) {
        $db_workerNames2 = $row['team_first_name'] . " " . $row['team_last_name'];
    }


    //Generally check if this selected area and current selected shift date already exist in database then tell the coordinator this area
    //is already assigned to a carer(of which one area can not be assigned twice in the same day).
    $myCheck = "SELECT * FROM tbl_schedule_calls WHERE col_area_Id = '$txtClientGroup' AND `Clientshift_Date` = '$txtShiftDate' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        echo "Area and data already assigned(dublicate)";
    } else {

        $myCheckResult = "SELECT * FROM tbl_schedule_calls WHERE first_carer_Id = '$txtFirstCarerId' OR `second_carer_Id` = '$txtSecondCarerId' ";
        $myCheckresQuery = mysqli_query($conn, $myCheckResult);
        $countResQuery = mysqli_num_rows($myCheckresQuery);

if ($countResQuery != 0) {
    //Execute query insertion into database using the current user client resource
    if ($itemid) {

        //Get Second carer user Id and keep the resource Id for use. The code is quite uncertain but this was how it could work
        //This code holds the first carer ID which was also reversed
        $getThisUserId2 = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE first_carer_Id = '$txtFirstCarerId' OR second_carer_Id = '$txtSecondCarerId' ORDER BY userId DESC LIMIT 1 ");
        while ($myResource2 = mysqli_fetch_array($getThisUserId2)) {
            $getThisUserResourceNumb = $myResource2['client_resource'];
        }

        //Get first carer user Id and keep the resource Id for use. The code is quite uncertain but this was how it could work
        //This code holds the sceond carer ID which was reversed
        $getThisUserId = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE first_carer_Id = '$txtFirstCarerId' OR second_carer_Id = '$txtFirstCarerId' ORDER BY userId DESC LIMIT 1 ");
        while ($myResource = mysqli_fetch_array($getThisUserId)) {
            $getThisUserResourceNumb2 = $myResource['client_resource'];
        }

        //Start General insertion line of code here
        $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$txtShiftDate', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
        //End general insertion line of code here

        if ($CopyClient_timeDetail) {

            //Start General insertion line of code here
            $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, '$txtShiftDate', '$getThisUserResourceNumb2', dateTime_in, dateTime_out, col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
            //End general insertion line of code here

            if ($CopyClient_timeDetailssql) {
                if ($txtHalfDay) { //if half day checkbox checked is true then do this
                    $updateMysqlTable4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                    if ($updateMysqlTable4) {
                        $updateMyRoasterView = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                        if ($updateMyRoasterView) {
                            $updatelunchColumn4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                            if ($updatelunchColumn4) {

                                if ($txtNextWeeksTrue) { //if one weeek check box checked is true then insert double

                                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                    //End general insertion line of code here

                                    if ($CopyClient_timeDetail) {

                                        //Start General insertion line of code here
                                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb2', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                        //End general insertion line of code here

                                        if ($CopyClient_timeDetailssql) {
                                            $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                            if ($updateMysqlTable40) {
                                                $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                                if ($updateMyRoasterView0) {
                                                    $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                                    if ($updatelunchColumn40) {
                                                        header("Location: ./success-page");
                                                    }
                                                }
                                            } else {
                                                header("Location: ./not-successful-page");
                                            }
                                        }
                                    }
                                } else if ($txtNexttwoWeeksTrue) { //if halfday checkbox checked is true then do this

                                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                    //End general insertion line of code here

                                    if ($CopyClient_timeDetail) {

                                        //Start General insertion line of code here
                                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb2', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                        //End general insertion line of code here

                                        if ($CopyClient_timeDetailssql) {

                                            $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                            if ($updateMysqlTable40) {
                                                $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                                if ($updateMyRoasterView0) {
                                                    $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                                    if ($updatelunchColumn40) {
                                                        header("Location: ./success-page");
                                                    }
                                                }
                                            } else {
                                                header("Location: ./not-successful-page");
                                            }
                                        }
                                    }
                                } else { //if halfday checkbox checked is true then do this
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    } else {
                        header("Location: ./not-successful-page");
                    } //if late call checkbox checked is true then do this
                } else if ($txtLateCalls) { //if latecall checkbox checked is true then do this
                    $updateMysqlTable4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                    if ($updateMysqlTable4) {
                        $updateMyRoasterView = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                        if ($updateMyRoasterView) {
                            $updatelunchColumn4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                            if ($updatelunchColumn4) {

                                if ($txtNextWeeksTrue) { //if one weeek check box checked is true then insert double

                                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                    //End general insertion line of code here

                                    if ($CopyClient_timeDetail) {

                                        //Start General insertion line of code here
                                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb2', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                        //End general insertion line of code here

                                        if ($CopyClient_timeDetailssql) {
                                            $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                            if ($updateMysqlTable40) {
                                                $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                                if ($updateMyRoasterView0) {
                                                    $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                                    if ($updatelunchColumn40) {
                                                        header("Location: ./success-page");
                                                    }
                                                }
                                            } else {
                                                header("Location: ./not-successful-page");
                                            }
                                        }
                                    }
                                } else if ($txtNexttwoWeeksTrue) { //if halfday checkbox checked is true then do this

                                    $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                    //End general insertion line of code here

                                    if ($CopyClient_timeDetail) {

                                        //Start General insertion line of code here
                                        $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb2', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                        //End general insertion line of code here

                                        if ($CopyClient_timeDetailssql) {

                                            $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                            if ($updateMysqlTable40) {
                                                $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                                if ($updateMyRoasterView0) {
                                                    $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                                    if ($updatelunchColumn40) {
                                                        header("Location: ./success-page");
                                                    }
                                                }
                                            } else {
                                                header("Location: ./not-successful-page");
                                            }
                                        }
                                    }
                                } else {
                                    header("Location: ./success-page");
                                }
                            }
                        }
                    } else {
                        header("Location: ./not-successful-page");
                    }
                } else if ($txtAllDay) {
                    $updateMysqlTable6 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' ");
                    if ($updateMysqlTable6) {
                        $updateMyRoasterView = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                        if ($updateMyRoasterView) {
                            if ($txtNextWeeksTrue) { //if one weeek check box checked is true then insert double

                                $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                //End general insertion line of code here

                                if ($CopyClient_timeDetail) {

                                    //Start General insertion line of code here
                                    $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb2', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                    //End general insertion line of code here

                                    if ($CopyClient_timeDetailssql) {
                                        $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                        if ($updateMysqlTable40) {
                                            $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                            if ($updateMyRoasterView0) {
                                                header("Location: ./success-page");
                                            }
                                        } else {
                                            header("Location: ./not-successful-page");
                                        }
                                    }
                                }
                            } else if ($txtNexttwoWeeksTrue) { //if halfday checkbox checked is true then do this

                                $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                //End general insertion line of code here

                                if ($CopyClient_timeDetail) {

                                    //Start General insertion line of code here
                                    $CopyClient_timeDetailssql = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames2', '$db_workerNames', '$txtSecondCarerId', '$txtFirstCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb2', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
                                    //End general insertion line of code here

                                    if ($CopyClient_timeDetailssql) {

                                        $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                        if ($updateMysqlTable40) {
                                            $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                            if ($updateMyRoasterView0) {
                                                header("Location: ./success-page");
                                            }
                                        } else {
                                            header("Location: ./not-successful-page");
                                        }
                                    }
                                }
                            } else { //if halfday checkbox checked is true then do this
                                header("Location: ./success-page");
                            }
                        }
                    } else {
                        header("Location: ./not-successful-page");
                    }
                }
            }
        }
    } else {

        //Get Second carer user Id and keep the resource Id for use. The code is quite uncertain but this was how it could work
        //This code holds the first carer ID which was also reversed
        $getThisUserId2 = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE first_carer_Id = '$txtFirstCarerId' OR second_carer_Id = '$txtSecondCarerId' ORDER BY userId DESC LIMIT 1 ");
        while ($myResource2 = mysqli_fetch_array($getThisUserId2)) {
            $getThisUserResourceNumb = $myResource2['client_resource'];
        }
        echo $getThisUserResourceNumb;

        $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$txtShiftDate', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$firstAttempId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");
        //End general insertion line of code here
        if ($CopyClient_timeDetail) {

            if ($txtHalfDay) { //if half day checkbox checked is true then do this
                $updateMysqlTable4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                if ($updateMysqlTable4) {
                    $updateMyRoasterView = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                    if ($updateMyRoasterView) {
                        $updatelunchColumn4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                        if ($updatelunchColumn4) {

                            if ($txtNextWeeksTrue) { //if one weeek check box checked is true then insert double

                                $insertOneWeekSQL = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");

                                if ($insertOneWeekSQL) {
                                    $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                    if ($updateMysqlTable40) {
                                        $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                        if ($updateMyRoasterView0) {
                                            $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                            if ($updatelunchColumn40) {
                                                header("Location: ./success-page");
                                            }
                                        }
                                    } else {
                                        header("Location: ./not-successful-page");
                                    }
                                }
                            } else if ($txtNexttwoWeeksTrue) { //if halfday checkbox checked is true then do this

                                $insertOneWeekSQL = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");

                                if ($insertOneWeekSQL) {
                                    $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Morning' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                    if ($updateMysqlTable40) {
                                        $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                        if ($updateMyRoasterView0) {
                                            $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Lunch' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                            if ($updatelunchColumn40) {
                                                header("Location: ./success-page");
                                            }
                                        }
                                    } else {
                                        header("Location: ./not-successful-page");
                                    }
                                }
                            } else { //if halfday checkbox checked is true then do this
                                header("Location: ./success-page");
                            }
                        }
                    }
                } else {
                    header("Location: ./not-successful-page");
                } //if late call checkbox checked is true then do this
            } else if ($txtLateCalls) { //if latecall checkbox checked is true then do this
                $updateMysqlTable4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                if ($updateMysqlTable4) {
                    $updateMyRoasterView = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                    if ($updateMyRoasterView) {
                        $updatelunchColumn4 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$firstAttempId' ");
                        if ($updatelunchColumn4) {

                            if ($txtNextWeeksTrue) { //if one weeek check box checked is true then insert double

                                $insertOneWeekSQL = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");

                                if ($insertOneWeekSQL) {
                                    $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                    if ($updateMysqlTable40) {
                                        $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                        if ($updateMyRoasterView0) {
                                            $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                            if ($updatelunchColumn40) {
                                                header("Location: ./success-page");
                                            }
                                        }
                                    } else {
                                        header("Location: ./not-successful-page");
                                    }
                                }
                            } else if ($txtNexttwoWeeksTrue) { //if halfday checkbox checked is true then do this

                                $insertOneWeekSQL = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");

                                if ($insertOneWeekSQL) {
                                    $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Tea' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                    if ($updateMysqlTable40) {
                                        $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                        if ($updateMyRoasterView0) {
                                            $updatelunchColumn40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE care_calls = 'Bed' AND `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                            if ($updatelunchColumn40) {
                                                header("Location: ./success-page");
                                            }
                                        }
                                    } else {
                                        header("Location: ./not-successful-page");
                                    }
                                }
                            } else {
                                header("Location: ./success-page");
                            }
                        }
                    }
                } else {
                    header("Location: ./not-successful-page");
                }
            } else if ($txtAllDay) {
                $updateMysqlTable6 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' ");
                if ($updateMysqlTable6) {
                    $updateMyRoasterView = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                    if ($updateMyRoasterView) {
                        if ($txtNextWeeksTrue) { //if one weeek check box checked is true then insert double

                            $insertOneWeekSQL = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$oneWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weekoneId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");

                            if ($insertOneWeekSQL) {
                                $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weekoneId' ");
                                if ($updateMysqlTable40) {
                                    $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                    if ($updateMyRoasterView0) {
                                        header("Location: ./success-page");
                                    }
                                } else {
                                    header("Location: ./not-successful-page");
                                }
                            }
                        } else if ($txtNexttwoWeeksTrue) { //if halfday checkbox checked is true then do this

                            $insertOneWeekSQL = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, first_carer, second_carer, first_carer_Id, second_carer_Id, care_calls, Clientshift_Date, client_resource, dateTime_in, dateTime_out, col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$db_workerNames', '$db_workerNames2', '$txtFirstCarerId', '$txtSecondCarerId', care_calls, '$twoWeekInterval', '$getThisUserResourceNumb', dateTime_in, dateTime_out, col_company_Id, '$weektwoId' FROM tbl_manage_runs WHERE run_area_nameId = '$txtClientGroup' ");

                            if ($insertOneWeekSQL) {
                                $updateMysqlTable40 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `timeline_colour`= '$timelineColour', `rightTo_display`= '$righttoDisplay', `bgChange` = '$bgChange', `call_status` = 'Action needed' WHERE `col_area_Id` = '$txtClientGroup' AND `col_weekly_routine` = '$weektwoId' ");
                                if ($updateMysqlTable40) {
                                    $updateMyRoasterView0 = mysqli_query($conn, "UPDATE `tbl_goesoft_users` SET `myviewArea`= 'General' WHERE `user_email_address` = '" . $_SESSION['usr_email'] . "' ");
                                    if ($updateMyRoasterView0) {
                                        header("Location: ./success-page");
                                    }
                                } else {
                                    header("Location: ./not-successful-page");
                                }
                            }
                        } else { //if halfday checkbox checked is true then do this
                            header("Location: ./success-page");
                        }
                    }
                } else {
                    header("Location: ./not-successful-page");
                }
            }
        }
    }
}