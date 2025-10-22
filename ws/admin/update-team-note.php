<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateTeamNote'])) {
    require_once 'dbconnections.php';

    $requiredFields = ['textNoteId', 'textTeamName', 'txtteamSpecialId', 'txtteamNote'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Missing required field: $field");
        }
    }

    $NoteId    = (int) $_POST['textNoteId'];          // note id (primary key)
    $TeamName  = trim($_POST['textTeamName']);        // team name
    $teamId    = trim($_POST['txtteamSpecialId']);    // team special id (uryyTteamoeSS4)
    $noteText  = trim($_POST['txtteamNote']);         // note text

    // ✅ Corrected UPDATE query
    $sql = "UPDATE tbl_team_notes 
            SET team_name = ?, team_note = ?
            WHERE userId = ? AND col_company_Id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // ✅ Correct bind types (ssii)
    $stmt->bind_param("ssis", $TeamName, $noteText, $NoteId, $_SESSION['usr_compId']);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ./team-note?uryyTteamoeSS4=" . urlencode($teamId));
        exit;
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        die("Error updating note: " . $error);
    }
}
