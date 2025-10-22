<?php
include 'dbconnections.php'; // your DB connection file

if (isset($_POST['uniqueId'])) {
    $uniqueId = $_POST['uniqueId'];
    $clientId = $_POST['clientId'];

    $stmt = $conn->prepare("DELETE FROM tbl_assessment_entries WHERE uniqueId = ? AND uryyToeSS4 = ?");
    $stmt->bind_param("ss", $uniqueId, $clientId);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['HTTP_REFERER']); // redirect back to the table page
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
