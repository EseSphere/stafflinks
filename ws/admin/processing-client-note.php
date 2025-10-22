<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmitClientNote'])) {
    require_once 'dbconnections.php';
    $requiredFields = ['textTeamName', 'txtClientSpecialId', 'txtDateOfNote', 'txtTimeOfNote', 'txtClientNote', 'txtCompanyId'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Missing required field: $field");
        }
    }
    $TeamName   = trim($_POST['textTeamName']);
    $clientId   = trim($_POST['txtClientSpecialId']);
    $noteDate   = trim($_POST['txtDateOfNote']);
    $noteTime   = trim($_POST['txtTimeOfNote']);
    $noteText   = trim($_POST['txtClientNote']);
    $companyId  = trim($_POST['txtCompanyId']);
    $sql = "INSERT INTO tbl_client_notes (team_name, uryyToeSS4, dateof_note, timeof_note, client_note, col_company_Id) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $TeamName, $clientId, $noteDate, $noteTime, $noteText, $companyId);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ./client-notes?uryyToeSS4=" . urlencode($clientId));
        exit;
    } else {
        $stmt->close();
        $conn->close();
        die("Error inserting note: " . $stmt->error);
    }
}
