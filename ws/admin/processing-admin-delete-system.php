<?php

if (isset($_POST['btnDeleteAdmin'])) {

    include('dbconnections.php');

    $user_special_Id = mysqli_real_escape_string($conn, $_POST['adminSpecialId']);

    $sql = mysqli_query($conn, "DELETE FROM tbl_goesoft_users WHERE user_special_Id = '" . $user_special_Id . "' ");

    if ($sql) {
        header('Location: ./administrator-list');
    } else {
    }
}
