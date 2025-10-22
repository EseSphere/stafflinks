<?php

if (isset($_POST['btnClientStatus'])) {
    include('dbconnections.php');

    $clientSpecialId = mysqli_real_escape_string($conn, $_POST['clientSpecialId']);
    $txtClientCondition = mysqli_real_escape_string($conn, $_POST['txtClientCondition']);
    /**
     * Defines the color for the 'Need care' client status.
     */
    $txtNeedcare = 'rgba(39, 174, 96,1.0)';
    /**
     * Defines the color for the 'Hospitalized' client status.
     */
    $txtHospitalized = 'rgba(231, 76, 60,1.0)';
    /**
     * Defines the color for the 'On a trip' client status.
     */
    $txtOnatrip = 'rgba(142, 68, 173,1.0)';
    /**
     * Defines the color for the 'With family' client status.
     */
    $txtWithfamily = 'rgba(52, 31, 151,1.0)';
    /**
     * Defines the color for the 'Inactive' client status.
     */
    $txtInactive = 'rgba(243, 156, 18,1.0)';
    /**
     * Defines the color for the 'Other' client status.
     */
    $txtothers = 'rgba(211, 84, 0,1.0)';

    if ($txtClientCondition == 'Active') {
        $update_status_sql = mysqli_query($conn, "UPDATE `tbl_general_client_form` SET `client_status` = '$txtClientCondition', `ClientStatuscolors` = '$txtNeedcare' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        if ($update_status_sql) {
            $update_care_call_status1 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `rightTo_display` = 'True' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($update_care_call_status1) {
                $update_care_call_status2 = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `col_right_to_display` = 'True' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($update_care_call_status2) {
                    $update_care_call_status3 = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `col_right_to_display` = 'True' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($update_care_call_status3) {
                        header("Location: ./client-list");
                    }
                }
            }
        }
    } else if ($txtClientCondition == 'Hospitalized') {
        $update_status_sql = mysqli_query($conn, "UPDATE `tbl_general_client_form` SET `client_status` = '$txtClientCondition', `ClientStatuscolors` = '$txtHospitalized' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        if ($update_status_sql) {
            $update_care_call_status1 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `rightTo_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($update_care_call_status1) {
                $update_care_call_status2 = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($update_care_call_status2) {
                    $update_care_call_status3 = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($update_care_call_status3) {
                        header("Location: ./client-list");
                    }
                }
            }
        }
    } else if ($txtClientCondition == 'On a trip') {
        $update_status_sql = mysqli_query($conn, "UPDATE `tbl_general_client_form` SET `client_status` = '$txtClientCondition', `ClientStatuscolors` = '$txtOnatrip' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        if ($update_status_sql) {
            $update_care_call_status1 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `rightTo_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($update_care_call_status1) {
                $update_care_call_status2 = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($update_care_call_status2) {
                    $update_care_call_status3 = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($update_care_call_status3) {
                        header("Location: ./client-list");
                    }
                }
            }
        }
    } else if ($txtClientCondition == 'With family') {
        $update_status_sql = mysqli_query($conn, "UPDATE `tbl_general_client_form` SET `client_status` = '$txtClientCondition', `ClientStatuscolors` = '$txtWithfamily' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        if ($update_status_sql) {
            $update_care_call_status1 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `rightTo_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($update_care_call_status1) {
                $update_care_call_status2 = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($update_care_call_status2) {
                    $update_care_call_status3 = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($update_care_call_status3) {
                        header("Location: ./client-list");
                    }
                }
            }
        }
    } else if ($txtClientCondition == 'Inactive') {
        $update_status_sql = mysqli_query($conn, "UPDATE `tbl_general_client_form` SET `client_status` = '$txtClientCondition', `ClientStatuscolors` = '$txtInactive' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        if ($update_status_sql) {
            $update_care_call_status1 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `rightTo_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($update_care_call_status1) {
                $update_care_call_status2 = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($update_care_call_status2) {
                    $update_care_call_status3 = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($update_care_call_status3) {
                        header("Location: ./client-list");
                    }
                }
            }
        }
    } else if ($txtClientCondition == 'Other') {
        $update_status_sql = mysqli_query($conn, "UPDATE `tbl_general_client_form` SET `client_status` = '$txtClientCondition', `ClientStatuscolors` = '$txtothers' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
        if ($update_status_sql) {
            $update_care_call_status1 = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `rightTo_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            if ($update_care_call_status1) {
                $update_care_call_status2 = mysqli_query($conn, "UPDATE `tbl_manage_runs` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                if ($update_care_call_status2) {
                    $update_care_call_status3 = mysqli_query($conn, "UPDATE `tbl_clienttime_calls` SET `col_right_to_display` = 'False' WHERE uryyToeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    if ($update_care_call_status3) {
                        header("Location: ./client-list");
                    }
                }
            }
        }
    }
}
