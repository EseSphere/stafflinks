<?php
include 'dbconnections.php'; // your DB connection file

if (isset($_POST['delSectionData'])) {
    $txtSlug = $_POST['txtSlug'];
    $txtClientId = $_POST['txtClientId'];
    $txtCompany = $_POST['txtCompany'];

    $stmt = $conn->prepare("DELETE FROM tbl_assessment_entries WHERE slug = ? AND company_Id = ?");
    $stmt->bind_param("ss", $txtSlug, $txtCompany);
    if ($stmt->execute()) {
        $stmt2 = $conn->prepare("DELETE FROM tbl_care_plan_section WHERE slug = ? AND company_Id = ?");
        $stmt2->bind_param("ss", $txtSlug, $txtCompany);
        if ($stmt2->execute()) {
            header("Location: ./begin-assessment?slug=$txtSlug&uryyToeSS4=$txtClientId"); // redirect back to the table page
            exit;
        } else {
            header("Location: ./begin-assessment?slug=$txtSlug&uryyToeSS4=$txtClientId"); // redirect back to the table page
            exit;
        }
    } else {
        header("Location: ./begin-assessment?slug=$txtSlug&uryyToeSS4=$txtClientId"); // redirect back to the table page
        exit;
    }
}
