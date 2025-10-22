<?php
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

$host     = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$dbname   = getenv('DB_NAME') ?: 'stafflinks';

try {
    $conn = new mysqli($host, $username, $password, $dbname);
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

try {
    $randomPart = bin2hex(random_bytes(4));
} catch (Exception $e) {
    $randomPart = bin2hex(openssl_random_pseudo_bytes(4));
}

$encrypted = 'USR-' . strtoupper($randomPart);
$encrypt = uniqid('', true);
$crackEncryptedbinary = $encrypted . '-' . $encrypt;
