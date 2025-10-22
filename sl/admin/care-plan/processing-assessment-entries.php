<?php
require 'dbconnections.php';
session_start();

function generateUniqueId($conn, $length = 16)
{
    do {
        $uniqueId = bin2hex(random_bytes($length));
        $stmt = $conn->prepare("SELECT 1 FROM tbl_assessment_entries WHERE uniqueId = ? LIMIT 1");
        $stmt->bind_param("s", $uniqueId);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows;
        $stmt->close();
    } while ($exists > 0);
    return $uniqueId;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $assessmentId   = $_POST['assessmentId'] ?? '';
    $slug           = $_POST['slug'] ?? '';
    $assessor       = $_POST['username'] ?? '';
    $uryyTteamoeSS4 = $_POST['specId'] ?? '';
    $uryyToeSS4     = $_POST['uryyToeSS4'] ?? '';
    $companyId      = $_SESSION['usr_compId'] ?? '';
    $uniqueId       = $_POST['uniqueId'] ?? '';

    if (!$assessmentId || !$assessor || !$companyId) {
        die('Required fields missing.');
    }

    // Fetch all section titles for this assessment
    $sectionStmt = $conn->prepare("SELECT sectionTitle, userId FROM tbl_care_plan_section WHERE slug = ? AND company_Id = ?");
    $sectionStmt->bind_param('ss', $slug, $companyId);
    $sectionStmt->execute();
    $sectionResult = $sectionStmt->get_result();
    $sections = [];
    while ($row = $sectionResult->fetch_assoc()) {
        $sections[$row['userId']] = $row['sectionTitle'];
    }
    $sectionStmt->close();

    if ($uniqueId) {
        // Update existing entries
        foreach ($_POST as $key => $value) {
            if (in_array($key, ['assessment', 'assessmentId', 'slug', 'username', 'specId', 'uryyToeSS4', 'uniqueId'])) continue;

            $sectionContent = trim($value);
            $sectionTitle = str_replace('_', ' ', ucfirst($key));

            // Check if entry exists
            $checkStmt = $conn->prepare("SELECT 1 FROM tbl_assessment_entries WHERE uniqueId = ? AND sectionTitle = ? AND slug = ? AND uryyToeSS4 = ? AND company_Id = ?");
            $checkStmt->bind_param('sssss', $uniqueId, $sectionTitle, $slug, $uryyToeSS4, $companyId);
            $checkStmt->execute();
            $checkStmt->store_result();
            $exists = $checkStmt->num_rows;
            $checkStmt->close();

            if ($exists) {
                // UPDATE without updated_at
                $stmt = $conn->prepare("UPDATE tbl_assessment_entries SET sectionContent = ?, assessor = ? WHERE uniqueId = ? AND sectionTitle = ? AND slug = ? AND uryyToeSS4 = ? AND company_Id = ?");
                $stmt->bind_param('sssssss', $sectionContent, $assessor, $uniqueId, $sectionTitle, $slug, $uryyToeSS4, $companyId);
                $stmt->execute();
                $stmt->close();
            } else {
                // INSERT new section
                $stmt = $conn->prepare("INSERT INTO tbl_assessment_entries (sectionTitle, sectionContent, slug, assessor, uryyTteamoeSS4, assessm_Id, uniqueId, uryyToeSS4, company_Id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt->bind_param('sssssssss', $sectionTitle, $sectionContent, $slug, $assessor, $uryyTteamoeSS4, $assessmentId, $uniqueId, $uryyToeSS4, $companyId);
                $stmt->execute();
                $stmt->close();
            }
        }
    } else {
        // INSERT new entry
        $uniqueId = generateUniqueId($conn);

        foreach ($_POST as $key => $value) {
            if (in_array($key, ['assessment', 'assessmentId', 'slug', 'username', 'specId', 'uryyToeSS4'])) continue;

            $sectionContent = trim($value);
            $sectionTitle = str_replace('_', ' ', ucfirst($key));

            $stmt = $conn->prepare("INSERT INTO tbl_assessment_entries (sectionTitle, sectionContent, slug, assessor, uryyTteamoeSS4, assessm_Id, uniqueId, uryyToeSS4, company_Id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param('sssssssss', $sectionTitle, $sectionContent, $slug, $assessor, $uryyTteamoeSS4, $assessmentId, $uniqueId, $uryyToeSS4, $companyId);
            $stmt->execute();
            $stmt->close();
        }
    }

    $conn->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
