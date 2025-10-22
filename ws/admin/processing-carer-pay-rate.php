<?php

if (isset($_POST['btnAddNewPay'])) {

    include('dbconnections.php');

    $txtCarerId =  mysqli_real_escape_string($conn, $_POST['txtCarerId']);
    $txtPayRate =  mysqli_real_escape_string($conn, $_POST['txtPayRate']);
    $txtAddTravelRate =  mysqli_real_escape_string($conn, $_POST['txtAddTravelRate']);

    $sqlActionMode = mysqli_query($conn, "UPDATE `tbl_general_team_form` SET `col_pay_rate` = '$txtPayRate', `col_rate_type` = '$txtAddTravelRate' WHERE uryyTteamoeSS4 = '$txtCarerId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");

    if ($sqlActionMode) {
        header("Location: team-details?uryyTteamoeSS4=$txtCarerId");
    } else {
    }
}
