<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}

$uniqueId = uniqid();

require 'phpqrcode/qrlib.php';
$qrFolder = 'qrcodes';
if (!is_dir($qrFolder)) {
    mkdir($qrFolder, 0777, true);
}
$fileName = $uniqueId . '.png';
$filePath = $qrFolder . '/' . $fileName;
QRcode::png($uniqueId, $filePath);

$sql = "UPDATE `tbl_general_client_form` SET `col_qrcode_path` = '$fileName' 
WHERE uryyToeSS4 = '$uryyToeSS4' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "'";
if ($conn->query($sql) === TRUE) {
    header('Location: ./qr-code?uryyToeSS4=' . $uryyToeSS4);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
