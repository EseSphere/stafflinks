<?php
if (isset($_POST['btnDeleteClient'])) {

    include('dbconnections.php');

    $user_special_Id = mysqli_real_escape_string($conn, $_POST['clientSpecialId']);

    $sql = mysqli_query($conn, "DELETE FROM tbl_general_client_form WHERE uryyToeSS4 = '" . $user_special_Id . "' ");

    if ($sql) {
        header('Location: ./client-list');
    } else {
    }
}
