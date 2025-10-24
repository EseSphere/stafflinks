<?php
include_once('dbconnections.php');
session_start();

$uryyToeSS4 = trim($_POST['txtclientId']);

if (!isset($_POST['btnDisableGeoLoc']) && !isset($_POST['btnActivateGeoLoc'])) {
    die("Invalid request.");
}

if (!isset($_SESSION['usr_compId'])) {
    die("Company ID not set.");
}

$geoStatus = 'Active';
$qrcodeStatus = 'Inactive';
$checkInStatus = 'geolocation';

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("UPDATE tbl_general_client_form SET geolocation = ?, qrcode = ? 
        WHERE uryyToeSS4 = ? AND col_company_Id = ?");
    $stmt->bind_param("ssss", $geoStatus, $qrcodeStatus, $uryyToeSS4, $_SESSION['usr_compId']);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE tbl_manage_runs SET checkin_type = ? 
        WHERE uryyToeSS4 = ? AND col_company_Id = ?");
    $stmt->bind_param("sss", $checkInStatus, $uryyToeSS4, $_SESSION['usr_compId']);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE tbl_schedule_calls SET checkin_type = ? 
        WHERE uryyToeSS4 = ? AND col_company_Id = ?");
    $stmt->bind_param("sss", $checkInStatus, $uryyToeSS4, $_SESSION['usr_compId']);
    $stmt->execute();

    $conn->commit();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} catch (Exception $e) {
    $conn->rollback();
    echo "Error updating records: " . $e->getMessage();
    exit;
}
