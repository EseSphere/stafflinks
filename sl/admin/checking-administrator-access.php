<?php
ob_start();
session_start();
include('dbconnections.php');
$SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users 
WHERE user_email_address = '" . $_SESSION['usr_email'] . "' 
AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
while ($rowSelect_now = mysqli_fetch_array($SelectQuery)) {
    $getDatafromTable = $rowSelect_now['admin_access'];
    if ($getDatafromTable == 'Granted') {
        header('Location: ./administrators');
    } else {
        header('Location: ./access-restricted');
    }
}
