<?php
include_once('dbconnections.php');
$uryyToeSS4 = trim($_POST['txtclientId']);

if (!isset($_POST['btnDisableGeoLoc']) && !isset($_POST['btnActivateGeoLoc'])) {
    die("Invalid request.");
}

// Set geolocation to 'Active' and qrcode to 'Inactive'
$geoStatus = 'Active';
$qrcodeStatus = 'Inactive';

$stmt = $conn->prepare("UPDATE tbl_general_client_form SET geolocation = ?, qrcode = ? 
WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("ssss", $geoStatus, $qrcodeStatus, $uryyToeSS4, $_SESSION['usr_compId']);

if ($stmt->execute()) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
