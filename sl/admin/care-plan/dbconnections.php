<?php

ob_start();
session_start();

if ((empty($_SESSION['usr_email']))) {

    header("Location: https://admin.geosoftcare.co.uk/54655-476564-99iu955-4h4657/");
}


// this will avoid mysql_connect() deprecation error.
error_reporting(~E_DEPRECATED & ~E_NOTICE);
// but I strongly suggest you to use PDO or MySQLi.

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'worksphere');


$conn = mysqli_connect(DBHOST, DBUSER, DBPASS);
$dbcon = mysqli_select_db($conn, DBNAME);

if (!$conn) {
    die("Connection failed : " . mysqli_error());
}

if (!$dbcon) {
    die("Database Connection failed : " . mysqli_error());
}


$CompanyName = 'Geosoft | For home and community care';

$today = date("Y-m-d");

date_default_timezone_set("Europe/London");
$currentDate = date('F j, Y');

$d = mktime(11, 14, 54, 8, 12, 2014);
