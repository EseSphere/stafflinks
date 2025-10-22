<?php

if (isset($_POST['btnDeleteTask'])) {

    include('dbconnections.php');

    $TaskSpecialId = mysqli_real_escape_string($conn, $_POST['TaskSpecialId']);
    $uryyToeSS4 = mysqli_real_escape_string($conn, $_POST['myEcrypted']);

    $sql = mysqli_query($conn, "DELETE FROM tbl_clients_task_records WHERE client_Id = '" . $TaskSpecialId . "' ");

    if ($sql) {
        header('Location: ./client-task?uryyToeSS4=' . $uryyToeSS4 . '');
    } else {
    }
}
