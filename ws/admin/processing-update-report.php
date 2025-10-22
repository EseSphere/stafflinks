<?php

if (isset($_POST['btnSubmitReply'])) {

    include('dbconnections.php');

    $aboutMe =  mysqli_real_escape_string($conn, $_POST['aboutMe']);
    $sql = mysqli_query($conn, "UPDATE `blogusers` SET `image` = '$mass_file', `biography` = '$aboutMe' WHERE email = '" . $_SESSION['usr_email'] . "' ");

    if (is_uploaded_file($_FILES['file']['tmp_name']) and copy($_FILES['file']['tmp_name'], $target)) {

        header("Location: auth-reports.php");
    } else {
    }
}
