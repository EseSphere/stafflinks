<?php
include_once('dbconnections.php');
$uryyToeSS4 = trim($_POST['txtclientId']);

if (!isset($_POST['btnDisableQRCode']) && !isset($_POST['btnActivateQRCode'])) {
    die("Invalid request.");
}

// Set qrcode to 'Active' and geolocation to 'Inactive'
$qrcodeStatus = 'Active';
$geoStatus = 'Inactive';

$stmt = $conn->prepare("UPDATE tbl_general_client_form SET qrcode = ?, geolocation = ? 
WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("ssss", $qrcodeStatus, $geoStatus, $uryyToeSS4, $_SESSION['usr_compId']);

if ($stmt->execute()) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
