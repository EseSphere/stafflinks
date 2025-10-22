<?php
session_start();
ob_start();

if (isset($_POST['btnTeamPayRate'])) {
    include('dbconnections.php');

    $txtteamFunding =  mysqli_real_escape_string($conn, $_POST['txtTeamFunding']);
    $txtTeamMileage =  mysqli_real_escape_string($conn, $_POST['txtTeamMileage']);
    $clientSpecialId =  mysqli_real_escape_string($conn, $_POST['clientSpecialId']);

    $sel_team_funding_info = mysqli_query($conn, "SELECT * FROM tbl_pay_rate WHERE col_special_Id = '$txtteamFunding' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
    $row_get_team_funding_info = mysqli_fetch_array($sel_team_funding_info, MYSQLI_ASSOC);
    $var_team_funding_rate = $row_get_team_funding_info['col_rates'];
    $var_team_funding_name = $row_get_team_funding_info['col_name'];

    $sql = mysqli_query($conn, "UPDATE `tbl_general_team_form` SET `col_pay_rate` = '$var_team_funding_rate', `col_rate_type` = '$var_team_funding_name', `col_mileage` = '$txtTeamMileage' WHERE (uryyTteamoeSS4 = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    if ($sql) {
        header("Location: ./team-details?uryyTteamoeSS4=$clientSpecialId");
    } else {
    }
}
