<?php
if (isset($_POST['btnTeamStatus'])) {
    include('dbconnections.php');

    $teamSpecialId =  mysqli_real_escape_string($conn, $_POST['txtUserSpecialId']);
    $txtUserId =  mysqli_real_escape_string($conn, $_POST['txtUserId']);
    $txtStartDate =  mysqli_real_escape_string($conn, $_POST['txtStartDate']);
    $txtEndDate =  mysqli_real_escape_string($conn, $_POST['txtEndDate']);
    $txtTeamStatus =  mysqli_real_escape_string($conn, $_POST['txtTeamStatus']);

    $statusColor = '#000';
    $varActiveColor = 'rgba(33, 150, 243,1.0)';
    $txtIsRead = 'True';
    $txtColorCode = '#d1ecf1';
    $txtNote =  mysqli_real_escape_string($conn, $_POST['txtNote']);

    //$mysql_update_team_form = mysqli_query($conn, "UPDATE `tbl_general_team_form` SET `team_status` = '$txtTeamStatus', `TeamStatuscolors` = '$varActiveColor' WHERE (uryyTteamoeSS4 = '$teamSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    //if ($mysql_update_team_form) {
    $MyInsertQuery = mysqli_query($conn, "UPDATE `tbl_team_status` SET `col_approval` = '$txtTeamStatus', `col_is_read` = '$txtIsRead', `col_color_code` = '$txtColorCode' 
    WHERE (userId = '$txtUserId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    if ($MyInsertQuery) {
        $mysql_update_schedule = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer` = '$txtFullname', `first_carer_Id` = '$teamSpecialId', `team_resource` = '$txtTeamResource' 
            WHERE (first_carer_Id = '$teamSpecialId' AND Clientshift_Date >= '$txtStartDate' AND Clientshift_Date <= '$txtEndDate' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
        if ($mysql_update_schedule) {
            header("Location: ./carer-availability?uryyTteamoeSS4=$teamSpecialId");
        }
    }
    //}
}
