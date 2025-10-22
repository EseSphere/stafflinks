<?php
if (isset($_POST['btnTeamStatus'])) {
    include('dbconnections.php');

    $teamSpecialId = mysqli_real_escape_string($conn, $_POST['teamSpecialId']);
    $txtFullname = mysqli_real_escape_string($conn, $_POST['txtFullname']);
    $txtTeamResource = mysqli_real_escape_string($conn, $_POST['txtTeamResource']);

    $txtStartDate = mysqli_real_escape_string($conn, $_POST['txtStartDate']);
    $txtFurtherNotice = mysqli_real_escape_string($conn, $_POST['txtFurtherNotice']);
    $txtEndDate = mysqli_real_escape_string($conn, $_POST['txtEndDate']);
    $txtTeamStatus = mysqli_real_escape_string($conn, $_POST['txtTeamStatus']);
    $txtNote = mysqli_real_escape_string($conn, $_POST['txtNote']);
    $txtApproveStatus = 'Approved';
    $txtTeamActive = 'Active';
    $txtIsRead = 'True';
    $txtAvailability = 'Null';
    $statusColor = '#27ae60';

    if ($txtTeamStatus == 'Active') {
        $MyInsertQuery = mysqli_query($conn, "UPDATE tbl_team_status SET col_startDate = '$txtStartDate', col_endDate = '$txtEndDate', 
        col_team_condition = '$txtTeamStatus' WHERE uryyTteamoeSS4 = '$teamSpecialId' ORDER BY userId DESC LIMIT 1");
        if ($MyInsertQuery) {
            $sql_update_rota = mysqli_query($conn, "UPDATE tbl_schedule_calls SET first_carer = '$txtFullname', first_carer_Id = '$teamSpecialId', 
            rightTo_display = '$txtIsRead' WHERE (team_resource = '$txtTeamResource' AND Clientshift_Date >= '$txtStartDate')");
            if ($sql_update_rota) {
                header("Location: ./team-details?uryyTteamoeSS4=$teamSpecialId");
            }
        }
    } else if ($txtFurtherNotice == 'TFN') {
        $MyInsertQuery = mysqli_query($conn, "INSERT INTO tbl_team_status (`col_full_name`, `col_startDate`, `col_endDate`, 
        `col_team_condition`, `col_note`, `col_approval`, `col_is_read`, `col_color_code`, `uryyTteamoeSS4`, `col_company_Id`) 
        VALUES('" . $txtFullname . "', '" . $txtStartDate . "', 'TFN', '" . $txtTeamStatus . "', '" . $txtNote . "', 
        '" . $txtApproveStatus . "', '" . $txtIsRead . "', '" . $statusColor . "', '" . $teamSpecialId . "', '" . $_SESSION['usr_compId'] . "')");
        if ($MyInsertQuery) {
            $sql_update_rota = mysqli_query($conn, "UPDATE tbl_schedule_calls SET first_carer = '$txtAvailability', first_carer_Id = '$txtAvailability', 
            rightTo_display = '$txtAvailability' WHERE team_resource = '$txtTeamResource' AND Clientshift_Date >= '$txtStartDate'");
            if ($sql_update_rota) {
                header("Location: ./team-details?uryyTteamoeSS4=$teamSpecialId");
            }
        }
    } else {
        $MyInsertQuery = mysqli_query($conn, "INSERT INTO tbl_team_status (`col_full_name`, `col_startDate`, `col_endDate`, 
        `col_team_condition`, `col_note`, `col_approval`, `col_is_read`, `col_color_code`, `uryyTteamoeSS4`, `col_company_Id`) 
        VALUES('" . $txtFullname . "', '" . $txtStartDate . "', '" . $txtEndDate . "', '" . $txtTeamStatus . "', '" . $txtNote . "', 
        '" . $txtApproveStatus . "', '" . $txtIsRead . "', '" . $statusColor . "', '" . $teamSpecialId . "', '" . $_SESSION['usr_compId'] . "')");
        if ($MyInsertQuery) {
            $sql_update_rota = mysqli_query($conn, "UPDATE tbl_schedule_calls SET first_carer = '$txtAvailability', first_carer_Id = '$txtAvailability', 
            rightTo_display = '$txtAvailability' WHERE team_resource = '$txtTeamResource' AND (Clientshift_Date BETWEEN '$txtStartDate' AND '$txtEndDate')");
            if ($sql_update_rota) {
                header("Location: ./team-details?uryyTteamoeSS4=$teamSpecialId");
            }
        }
    }
}
