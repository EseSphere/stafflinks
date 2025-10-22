<?php

if (isset($_POST['btnDeleteRotaRun'])) {

    include('dbconnections.php');
    $txtRunRotaId = mysqli_real_escape_string($conn, $_POST['txtRunRotaId']);
    $txtRunRotaCarerId = mysqli_real_escape_string($conn, $_POST['txtRunRotaCarerId']);
    $txtRotaDate = mysqli_real_escape_string($conn, $_POST['txtRotaDate']);

    $sql_delete_rota = mysqli_query($conn, "DELETE FROM tbl_schedule_calls WHERE (col_area_Id = '" . $txtRunRotaId . "' AND first_carer_Id = '" . $txtRunRotaCarerId . "') ");

    if ($sql_delete_rota) {
        header('Location: ./roster/index?txtDate=' . $txtRotaDate . '');
    } else {
    }
}
