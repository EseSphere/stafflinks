<?php
include('db-connect.php');

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['btnResetPassword'])) {

    $email = mysqli_real_escape_string($conn, $_REQUEST['myEmail']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $res = mysqli_query($conn, "SELECT user_email_address FROM tbl_admin WHERE user_email_address='$email' ");
    $row = mysqli_fetch_array($res);
    $count = mysqli_num_rows($res);

    if ($count == 1 && $row['user_email_address'] == $email) {
        $_SESSION['usr_email'] = $row['user_email_address'];
        header("Location: ./change-admin-password");
    } else {
        echo "
            <script type='text/javascript'>
                $(document).ready(function() {
                    $('#popupAlert').show();
                });
            </script>";
        unset($email);
    }
}
