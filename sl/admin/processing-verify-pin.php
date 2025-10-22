<?php
include('db-connect.php');
session_start();

if (isset($_POST['btnVerifyPin'])) {
    $pin = trim($_POST['resetPin']);
    $pin = mysqli_real_escape_string($conn, $pin);

    if (!isset($_SESSION['usr_email'])) {
        header("Location: auth-reset-password.php");
        exit;
    }

    $email = $_SESSION['usr_email'];
    $query = "SELECT reset_pin FROM tbl_goesoft_users WHERE user_email_address = '$email' LIMIT 1";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);

    if ($row && $row['reset_pin'] === $pin) {
        mysqli_query($conn, "UPDATE tbl_goesoft_users SET reset_pin = NULL WHERE user_email_address = '$email'");
        header("Location: change-admin-password.php");
        // $_SESSION['usr_email'] = $email;
        // $_SESSION['usr_email'] = $email;
        exit;
    } else {
        echo "
        <script type='text/javascript'>
            $(document).ready(function() {
                $('#popupAlert').show();
            });
        </script>";
    }
}
