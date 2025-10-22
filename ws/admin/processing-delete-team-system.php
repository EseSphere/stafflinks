<?php

if (isset($_POST['btnDeleteTeam'])) {

    include('dbconnections.php');

    $user_special_Id = mysqli_real_escape_string($conn, $_POST['teamSpecialId']);

    $sql = mysqli_query($conn, "DELETE FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '" . $user_special_Id . "' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");

    if ($sql) {
        header('Location: ./client-list');
    } else {
    }
}
