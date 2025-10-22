<?php
ob_start();
session_start();

date_default_timezone_set("Europe/London");

$dbHost = getenv('DB_HOST') ?: '192.168.0.29';
$dbUser = getenv('DB_USER') ?: 'remote_user';
$dbPass = getenv('DB_PASS') ?: 'Geosoft@!12';
$dbName = getenv('DB_NAME') ?: 'geosoft';

$conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_errno) {
    error_log("Database connection failed: " . $conn->connect_error);
    exit("Sorry, we are experiencing technical difficulties. Please try again later.");
}

if (!$conn->set_charset("utf8mb4")) {
    error_log("Error setting charset: " . $conn->error);
}

$sTime = date("H:i");
$CompanyName = 'Geosoft Care | For home and community care';

$today = date("Y-m-d");
$tomorrow = (new DateTime('tomorrow'))->format('Y-m-d');
$currentDate = date('F j, Y');

$d = mktime(11, 14, 54, 8, 12, 2014);

$visitCookieDate = isset($_COOKIE['VisitDate']) ? $_COOKIE['VisitDate'] : null;

$encrypted = 'USR-' . strtoupper(bin2hex(random_bytes(4)));
$encrypt = uniqid('', true);
$crackEncryptedbinary = $encrypted . '-' . $encrypt;
