<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ? 
AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = $row['client_first_name'] . ' ' . $row['client_last_name'] ?? null;
$stmt->close();
$_SESSION['nav_session'] = $uryyToeSS4;
if (isset($_POST['btnSaveNoK'])) {
    $uploadDir = "lpa_documents/";
    $fileName = basename($_FILES['file']['name']);
    $targetPath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

    $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
    $fileSizeLimit = 5 * 1024 * 1024; // 5MB

    $txtFirstName = mysqli_real_escape_string($conn, $_POST['txtFirstName']);
    $txtLastName = mysqli_real_escape_string($conn, $_POST['txtLastName']);
    $txtRelationship = mysqli_real_escape_string($conn, $_POST['txtRelationship']);
    $txtPhonenumber = mysqli_real_escape_string($conn, $_POST['txtPhonenumber']);
    $txtTypeofcontact = mysqli_real_escape_string($conn, $_POST['txtTypeofcontact']);
    $txtEmailAddress = mysqli_real_escape_string($conn, $_POST['txtEamilAddress']); // Typo fixed here
    $txtStatement = mysqli_real_escape_string($conn, $_POST['txtStatement']);
    $txtClientId = mysqli_real_escape_string($conn, $_POST['txtClientId']);

    $lpa_file = mysqli_real_escape_string($conn, $fileName);
    $companyId = $_SESSION['usr_compId'];

    if (!empty($fileName)) {
        if (!in_array($fileType, $allowedTypes)) {
            die("Invalid file type.");
        }

        if ($_FILES['file']['size'] > $fileSizeLimit) {
            die("File size exceeds 5MB.");
        }

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            die("Failed to upload file.");
        }
    }
    // Insert query
    $stmt = $conn->prepare("INSERT INTO tbl_client_nok (col_first_name, col_last_name, col_relationship, col_phone_number, 
    col_type_ofContact,nok_emailaddress, col_client_statement, lpa_documents, uryyToeSS4, col_company_Id) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssssss",
        $txtFirstName,
        $txtLastName,
        $txtRelationship,
        $txtPhonenumber,
        $txtTypeofcontact,
        $txtEmailAddress,
        $txtStatement,
        $lpa_file,
        $txtClientId,
        $companyId
    );

    if ($stmt->execute()) {
        header("Location: ../client-details?uryyToeSS4=$txtClientId");
        exit;
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
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
</style>