<?php
ob_start();
session_start();
if (!isset($_SESSION['usr_email'])) {
    header('Location: https://admin.stafflinks.co.uk/');
    exit();
}

define('INACTIVITY_LIMIT', 900); // 15 minutes
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > INACTIVITY_LIMIT)) {
    session_unset();
    session_destroy();
    header("Location: https://admin.stafflinks.co.uk/");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

date_default_timezone_set("Europe/London");

$CompanyName = 'StaffLinks | Simplify. Organize. Thrive.';
$today = date("Y-m-d");
$tomorrow = (new DateTime('tomorrow'))->format('Y-m-d');
$currentDate = date('F j, Y');

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$database = getenv('DB_NAME') ?: 'stafflinks';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("We’re experiencing technical difficulties. Please try again later.");
}

$companyId = isset($_SESSION['company_id']) ? intval($_SESSION['company_id']) : 0;
$stmt = $conn->prepare("SELECT shift_date FROM tbl_daily_shift_records WHERE col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("i", $companyId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$varRecentDate = $row['shift_date'] ?? date("Y-m-d");
$first_day_this_month = date("Y-m-01", strtotime($varRecentDate));
$last_day_this_month = date("Y-m-t", strtotime($varRecentDate));

$txtAllCarer = $txtCarerRecipient = $txtContract = 'Checked in';

$txtStartDate = $_COOKIE['StartDate'] ?? '';
$txtEndDate = $_COOKIE['EndDate'] ?? '';
$txtCareGiver = $_COOKIE['CareGiver'] ?? '';
$txtClientContract = $_COOKIE['Contract'] ?? '';
$txtCareRecipient = $_COOKIE['CareRecipient'] ?? '';
$txtCompanyId = $_COOKIE['CompanyId'] ?? '';
$txtContract = $_COOKIE['Contract'] ?? '';
