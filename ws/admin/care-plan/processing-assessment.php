<?php
include 'dbconnections.php';
function generateSpecialId($length = 8)
{
    return strtoupper(bin2hex(random_bytes($length / 2)));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baseId = generateSpecialId();
    $randomNumber = rand(100000, 999999);

    function generateFormattedId()
    {
        $prefix = 'C59046P';
        $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 3);
        $randomNum = rand(100, 999);
        return $prefix . '-' . $randomChars . $randomNum . '-' . uniqid();
    }

    $id = generateFormattedId();

    $txtAsmName = $_POST['txtAsmName'];
    $txtAsmHeader = $_POST['txtAsmHeader'];
    $specialId = $id . '-' . $baseId . '-' . $randomNumber;
    $txtUserName = $_POST['txtUserName'];
    $txtUserSpecId = $_POST['txtUserSpecId'];
    $txtClientId = $_POST['txtClientId'];
    $txtCompanyId = $_POST['txtCompanyId'];

    $slugs = strtolower(str_replace(' ', '-', $txtAsmName));
    $slug = preg_replace('/[^a-z0-9-]/', '', $slugs); // Remove special characters   

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO tbl_care_plan (asm_name, asm_header, slug, assessm_Id, created_by, uryyTteamoeSS4, company_Id) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssssss", $txtAsmName, $txtAsmHeader, $slug, $specialId, $txtUserName, $txtUserSpecId, $txtCompanyId);
        if ($stmt->execute()) {
            header("Location: ./index?uryyToeSS4=" . $txtClientId . "");
            exit();
        } else {
            echo "Execute failed: " . $stmt->error;
        }
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}
