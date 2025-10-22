<?php

if (isset($_POST['btnAddNewRun'])) {

    include('dbconnections.php');

    $txtAddNewRun =  mysqli_real_escape_string($conn, $_POST['txtAddNewRun']);
    $txtrunTown =  mysqli_real_escape_string($conn, $_POST['txtrunTown']);
    $txtCompId =  mysqli_real_escape_string($conn, $_POST['txtCompId']);

    $sql = mysqli_query($conn, "UPDATE `tbl_client_runs` SET `run_name` = '$txtAddNewRun', `run_town` = '$txtrunTown' WHERE run_ids = '$txtCompId' ");

    if ($sql) {

        header("Location: ./manage-runs");
    } else {
    }
}
