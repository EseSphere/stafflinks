<?php
ob_start();
session_start();

$debug = filter_var(getenv('APP_DEBUG') ?: false, FILTER_VALIDATE_BOOLEAN);

if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
    if (!ini_get('error_log')) {
        ini_set('error_log', sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-errors.log');
    }
}

if (empty($_SESSION['usr_email'])) {
    header("Location: https://stafflinks.co.uk/sl/admin/");
    exit();
}

date_default_timezone_set("Europe/London");

$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';
$dbName = getenv('DB_NAME') ?: 'stafflinks';

try {
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if (!$conn->set_charset("utf8mb4")) {
        error_log("Error setting charset: " . $conn->error);
        if ($debug) {
            throw new mysqli_sql_exception("Error setting charset: " . $conn->error);
        }
    }
} catch (mysqli_sql_exception $e) {
    if ($debug) {
        throw $e;
    }
    error_log("Database connection failed: " . $e->getMessage());
    exit("Sorry, we are experiencing technical difficulties. Please try again later.");
}

$sTime = date("H:i");
$CompanyName = 'StaffLinks | Simplify. Organize. Thrive.';

$today = date("Y-m-d");
$tomorrow = (new DateTime('tomorrow'))->format('Y-m-d');
$currentDate = date('F j, Y');

$d = mktime(11, 14, 54, 8, 12, 2014);

$visitCookieDate = isset($_COOKIE['VisitDate']) ? $_COOKIE['VisitDate'] : null;

try {
    $randomPart = bin2hex(random_bytes(4));
} catch (Exception $e) {
    $randomPart = bin2hex(openssl_random_pseudo_bytes(4));
}

$encrypted = 'USR-' . strtoupper($randomPart);
$encrypt = uniqid('', true);
$crackEncryptedbinary = $encrypted . '-' . $encrypt;
