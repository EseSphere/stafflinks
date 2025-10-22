<?php
include('dbconnections.php');
//This code is to check if finance access is granted
$SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE (user_email_address = '" . $_SESSION['usr_email'] . "') ");
$rowSelect_now = mysqli_fetch_array($SelectQuery, MYSQLI_ASSOC);
$varFinanceAccess = $rowSelect_now['finance_access'];
if ($varFinanceAccess == 'Granted') {
    header('Location: ./checking-visits-status');
} else {
    header('Location: ../access-restricted');
}
