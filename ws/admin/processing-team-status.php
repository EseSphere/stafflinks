<?php

if (isset($_POST['btnTeamStatus'])) {

    include('dbconnections.php');

    $teamSpecialId =  mysqli_real_escape_string($conn, $_POST['teamSpecialId']);
    $txtFirstName =  mysqli_real_escape_string($conn, $_POST['txtFirstName']);
    $txtLastName =  mysqli_real_escape_string($conn, $_POST['txtLastName']);
    $txtTeamStatus =  mysqli_real_escape_string($conn, $_POST['txtTeamStatus']);

    $mysql_insert_query = mysqli_query($conn, "UPDATE `tbl_general_team_form` SET `team_status` = '$txtTeamStatus' WHERE uryyTteamoeSS4 = '$teamSpecialId' ");
    if ($mysql_insert_query) {
        $MyInsertQuery = mysqli_query($conn, "INSERT INTO tbl_team_status (`col_first_name`, `col_last_name`, `col_team_condition`, `uryyTteamoeSS4`, `col_company_Id`) VALUES('" . $txtFirstName . "', '" . $txtLastName . "', '" . $txtTeamStatus . "', '" . $teamSpecialId . "', '" . $_SESSION['usr_compId'] . "')");
        if ($MyInsertQuery) {
            header("Location: ./team-details?uryyTteamoeSS4=$teamSpecialId");
        }
    } else {
    }
}
