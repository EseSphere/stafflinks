<?php

if (isset($_POST['btnDeleteMedication'])) {

    include('dbconnections.php');

    $MedsSpecialId = mysqli_real_escape_string($conn, $_POST['MedsSpecialId']);
    $uryyToeSS4 = mysqli_real_escape_string($conn, $_POST['myEcrypted']);

    $sql = mysqli_query($conn, "DELETE FROM tbl_clients_medication_records WHERE med_Id = '" . $MedsSpecialId . "' ");

    if ($sql) {
        header('Location: ./client-medication?uryyToeSS4=' . $uryyToeSS4 . '');
    } else {
    }
}
