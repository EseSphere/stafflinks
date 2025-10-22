<?php
if (isset($_POST['btnReScheduleRuns'])) {

    include('dbconnections.php');

    $txtNewCarer =  mysqli_real_escape_string($conn, $_POST['txtNewCarer']);
    $txtCurrentCarer =  mysqli_real_escape_string($conn, $_POST['txtCurrentCarer']);
    $txtShiftDate =  mysqli_real_escape_string($conn, $_POST['txtShiftDate']);
    $txtClientSpecialId =  mysqli_real_escape_string($conn, $_POST['txtClientSpecialId']);

    $sel_carer_Id = mysqli_query($conn, "SELECT col_team_resource,team_first_name,team_last_name FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$txtNewCarer' ");
    while ($row_carerId = mysqli_fetch_array($sel_carer_Id)) {
        $db_CarerWorkRes = $row_carerId['col_team_resource'];
        $db_carerName = $row_carerId['team_first_name'] . ' ' . $row_carerId['team_last_name'];

        $sel_carer_Name = mysqli_query($conn, "SELECT first_carer, userId FROM tbl_schedule_calls WHERE uryyToeSS4 = '$txtClientSpecialId' AND Clientshift_Date = '$txtShiftDate' AND first_carer_Id = '$txtCurrentCarer'");
        while ($row = mysqli_fetch_array($sel_carer_Name)) {
            $db_userId = $row['userId'];

            $sel_carer_Name2 = mysqli_query($conn, "SELECT userId FROM tbl_schedule_calls WHERE userId = '$db_userId' AND care_calls = 'Tea'");
            while ($row2 = mysqli_fetch_array($sel_carer_Name2)) {
                $db_userI2d = $row2['userId'];

                $sqlEditCareCall = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer` = '$db_carerName', `first_carer_Id` = '$txtNewCarer', `team_resource` = '$db_CarerWorkRes' WHERE userId = '$db_userI2d' ");
                if ($sqlEditCareCall) {
                    header("Location: ./edit-morning-call?uryyToeSS4=$txtClientSpecialId");
                } else {
                }
            }
        }
    }
}
