
<?php

if (isset($_POST['fname'])) {
    include('dbconnect.php');
    $txtCurrentDate = mysqli_real_escape_string($myConnection, $_POST['txtCurrentDate']);
    $post = mysqli_real_escape_string($myConnection, $_POST['fname']);

    $expire = time() + 60 * 60 * 24 * 30;
    setcookie("companyCity", $post, $expire);
    header("Location: ./index?txtDate=$txtCurrentDate"); //notice the redirect?
}

if (isset($_POST['Runfname'])) {
    include('dbconnect.php');
    $txtCurrentDate = mysqli_real_escape_string($myConnection, $_POST['txtCurrentDate']);
    $post = mysqli_real_escape_string($myConnection, $_POST['Runfname']);

    $expire = time() + 60 * 60 * 24 * 30;
    setcookie("companyCity", $post, $expire);
    header("Location: ./schedule-visits?txtDate=$txtCurrentDate"); //notice the redirect?
}
