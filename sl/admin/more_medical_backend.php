<?php
include('client-header-contents.php');
$uryyToeSS4 = $_GET['uryyToeSS4'] ?? null;
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ? 
AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = $row['client_first_name'] . ' ' . $row['client_last_name'] ?? null;
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_client_medical WHERE uryyToeSS4 = ? 
AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (isset($_POST['btnSaveClientMdForm'])) {
    $txtNhsNumber = mysqli_real_escape_string($conn, $_REQUEST['txtNhsNumber']);
    $txtMedicalsupport = mysqli_real_escape_string($conn, $_REQUEST['txtMedicalsupport']);
    $txtAllergiesInfo = mysqli_real_escape_string($conn, $_REQUEST['txtAllergiesInfo']);
    $txtGPsname = mysqli_real_escape_string($conn, $_REQUEST['txtGPsname']);
    $txtPhoneNumber = mysqli_real_escape_string($conn, $_REQUEST['txtPhoneNumber']);
    $txtEmailAddress = mysqli_real_escape_string($conn, $_REQUEST['txtEmailAddress']);
    $txtAddress = mysqli_real_escape_string($conn, $_REQUEST['txtAddress']);
    $txtPharmacyname = mysqli_real_escape_string($conn, $_REQUEST['txtPharmacyname']);
    $txtPharmacyPhone = mysqli_real_escape_string($conn, $_REQUEST['txtPharmacyPhone']);
    $txtPharmacyAddress = mysqli_real_escape_string($conn, $_REQUEST['txtPharmacyAddress']);
    $txtClientId = mysqli_real_escape_string($conn, $_REQUEST['txtClientId']);
    // Handle file upload if a file is selected
    $file = '';
    if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file = mysqli_real_escape_string($conn, $_FILES['file']['name']);
        $target = "./DNAR/" . basename($file);
        if (!copy($_FILES['file']['tmp_name'], $target)) {
            echo "File upload failed, but continuing form submission...";
        }
    }
    // Insert into database
    $queryIns = mysqli_query($conn, "
        INSERT INTO tbl_client_medical (
            col_nhs_number, col_medical_support, col_dnar, col_allergies, col_gp_name, 
            col_phone_number, gp_email_address, gp_address, col_pharmancy_name, pharmacy_phone, 
            col_pharmancy_address, uryyToeSS4, col_company_Id
        ) VALUES (
            '$txtNhsNumber', '$txtMedicalsupport', '$file', '$txtAllergiesInfo', '$txtGPsname',
            '$txtPhoneNumber', '$txtEmailAddress', '$txtAddress', '$txtPharmacyname', '$txtPharmacyPhone',
            '$txtPharmacyAddress', '$txtClientId', '{$_SESSION['usr_compId']}'
        )
    ");
    if ($queryIns) {
        header("Location: ./medical-details?uryyToeSS4=$txtClientId");
        exit;
    } else {
        echo "Database insert failed.";
    }
}
?>

<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }

    .upload-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .upload-button:hover {
        background-color: #45a049;
    }
</style>