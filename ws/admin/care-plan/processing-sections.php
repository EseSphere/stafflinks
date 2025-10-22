<?php
include 'dbconnections.php';

function generateSpecialId($length = 8)
{
    return strtoupper(bin2hex(random_bytes($length / 2)));
}
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

$specialId = $id . '-' . $baseId . '-' . $randomNumber;

// Collect hidden fields
$assessmentId   = $_POST['txtAssessmentId'] ?? '';
$assessmentName = $_POST['txtAssessmentName'] ?? '';
$assessmentSlug = $_POST['txtAssessmentSlug'] ?? '';
$userName       = $_POST['txtUserName'] ?? '';
$userSpecId     = $_POST['txtUserSpecId'] ?? '';
$clientId       = $_POST['txtClientId'] ?? '';
$companyId      = $_POST['txtCompanyId'] ?? '';

// Collect headers (items[])
$headers = $_POST['items'] ?? [];

// Prepare SQL insert statement
$stmt = $conn->prepare("INSERT INTO tbl_care_plan_section 
    (assessm_name, sectionTitle, slug, assessm_Id, created_by, uryyTteamoeSS4, company_Id) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");

if ($stmt) {
    foreach ($headers as $header) {
        $header = trim($header);
        if (!empty($header)) {
            $stmt->bind_param(
                "sssssss",
                $assessmentName,
                $header,        // ✅ fixed: single item, not array
                $assessmentSlug,
                $specialId,     // ✅ same for all rows
                $userName,
                $userSpecId,
                $companyId
            );
            $stmt->execute();
        }
    }
    $stmt->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$conn->close();
