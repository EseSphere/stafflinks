<?php

if (isset($_POST['removeExtraCareCall'])) {

    include('dbconnections.php');

    $RemoveclientId = mysqli_real_escape_string($conn, $_POST['RemoveclientId']);

    $sql_delete_extra = mysqli_query($conn, "DELETE FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '" . $user_special_Id . "' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");

    if ($sql) {
        header('Location: ./client-list');
    } else {
    }
}
