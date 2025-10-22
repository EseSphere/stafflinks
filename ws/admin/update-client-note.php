<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateClientNote'])) {
    require_once 'dbconnections.php';

    $requiredFields = ['textTeamName', 'txtClientNote'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Missing required field: $field");
        }
    }

    $clientId        = trim($_POST['txtClientId']);
    $TeamName        = trim($_POST['textTeamName']);
    $noteText        = trim($_POST['txtClientNote']);
    $clientSpecialId = trim($_POST['txtClientSpecialId']);

    $sql = "UPDATE tbl_client_notes 
            SET team_name = ?, client_note = ? 
            WHERE userId = ? AND col_company_Id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssis", $TeamName, $noteText, $clientId, $_SESSION['usr_compId']);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ./client-notes?uryyToeSS4=" . urlencode($clientSpecialId));
        exit;
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        die("Error updating note: " . $error);
    }
}
