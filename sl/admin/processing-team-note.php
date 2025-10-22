<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmitteamNote'])) {
    require_once 'dbconnections.php';
    $requiredFields = ['textTeamName', 'txtteamSpecialId', 'txtDateOfNote', 'txtTimeOfNote', 'txtteamNote', 'txtCompanyId'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Missing required field: $field");
        }
    }
    $TeamName   = trim($_POST['textTeamName']);
    $teamId   = trim($_POST['txtteamSpecialId']);
    $noteDate   = trim($_POST['txtDateOfNote']);
    $noteTime   = trim($_POST['txtTimeOfNote']);
    $noteText   = trim($_POST['txtteamNote']);
    $companyId  = trim($_POST['txtCompanyId']);
    $sql = "INSERT INTO tbl_team_notes (team_name, uryyTteamoeSS4, dateof_note, timeof_note, team_note, col_company_Id) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $TeamName, $teamId, $noteDate, $noteTime, $noteText, $companyId);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ./team-note?uryyTteamoeSS4=" . urlencode($teamId));
        exit;
    } else {
        $stmt->close();
        $conn->close();
        die("Error inserting note: " . $stmt->error);
    }
}
