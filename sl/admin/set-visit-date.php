<?php
if (isset($_POST['txtDate'])) {
    include_once 'dbconnections.php';
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtDate = mysqli_real_escape_string($conn, $_REQUEST['txtDate']);

    $cookie_txtDate = '' . $txtDate;
    $cookie_name = "VisitDate";
    $cookie_value = "" . $cookie_txtDate;
    $varCookieSuccess = setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    if ($varCookieSuccess) {
        echo "<script>
                window.history.go(-1);
            </script>";
    }
}
