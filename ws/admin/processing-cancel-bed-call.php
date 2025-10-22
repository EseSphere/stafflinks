<?php
if (isset($_POST['btnCancelCall'])) {

    include('dbconnections.php');

    $txtFirstCarer =  mysqli_real_escape_string($conn, $_POST['txtFirstCarer']);
    $txtShiftDate =  mysqli_real_escape_string($conn, $_POST['txtShiftDate']);
    $txtClientSpecialId =  mysqli_real_escape_string($conn, $_POST['txtClientSpecialId']);
    $txtReason =  mysqli_real_escape_string($conn, $_POST['txtReason']);
    $mySpecialId =  mysqli_real_escape_string($conn, $_POST['mySpecialId']);
    $myCompanyId =  mysqli_real_escape_string($conn, $_POST['myCompanyId']);
    $txtCurrentDate =  mysqli_real_escape_string($conn, $_POST['txtCurrentDate']);

    $myIdentity = hash('sha256', $mySpecialId);

    $sel_carer_Id = mysqli_query($conn, "SELECT col_team_resource,team_first_name,team_last_name FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$txtFirstCarer' ");
    while ($row_carerId = mysqli_fetch_array($sel_carer_Id)) {
        $db_CarerWorkRes = $row_carerId['col_team_resource'];
        $db_carerName = $row_carerId['team_first_name'] . ' ' . $row_carerId['team_last_name'];

        $sel_carer_Name = mysqli_query($conn, "SELECT first_carer, userId FROM tbl_schedule_calls WHERE uryyToeSS4 = '$txtClientSpecialId' AND Clientshift_Date = '$txtShiftDate' AND first_carer_Id = '$txtFirstCarer'");
        while ($row = mysqli_fetch_array($sel_carer_Name)) {
            $db_userId = $row['userId'];

            $sel_carer_Name2 = mysqli_query($conn, "SELECT userId,client_name,first_carer,second_carer FROM tbl_schedule_calls WHERE userId = '$db_userId' AND care_calls = 'Bed'");
            while ($row2 = mysqli_fetch_array($sel_carer_Name2)) {
                $db_userI2d = $row2['userId'];
                $db_ClientName = $row2['client_name'];
                $db_firstCarer = $row2['first_carer'];
                $db_SecondCarer = $row2['second_carer'];

                echo $db_userI2d;

                $sqlEditCareCall = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `rightTo_display` = 'False', `dateTime_in` = ' ', `dateTime_out` = ' ', `first_carer_Id` = 'Null', `second_carer_Id` = 'Null' WHERE userId = '$db_userI2d' ");
                if ($sqlEditCareCall) {

                    $queryIns = mysqli_query($conn, "INSERT INTO tbl_cancelled_call (col_client_name, col_first_carer, col_second_carer, col_reason, col_paid_option, col_client_Id, col_special_Id, col_company_Id, col_date) 
                    VALUES('" . $db_ClientName . "', '" . $db_firstCarer . "', '" . $db_SecondCarer . "', '" . $txtReason . "', 'Null', '" . $txtFirstCarer . "', '" . $myIdentity . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "' ) ");

                    if ($queryIns) {
                        header("Location: ./edit-bed-call?uryyToeSS4=$txtClientSpecialId");
                    }
                } else {
                }
            }
        }
    }
}
