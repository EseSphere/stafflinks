<?php

include('dbconnections.php');

$SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE user_email_address = '" . $_SESSION['usr_email'] . "' ");
while ($rowSelect_now = mysqli_fetch_array($SelectQuery)) {
    $getDatafromTable = $rowSelect_now['finance_access2'];

    if ($getDatafromTable == 'Granted') {
        header('Location: ./configuration-452888-994884-0542353-45662g6');
    } else {
        header('Location: ./access-restricted');
    }
}
