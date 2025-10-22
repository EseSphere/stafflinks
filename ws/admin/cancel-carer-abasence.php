<?php
require_once "dbconnections.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['txtUserId']) ? trim($_POST['txtUserId']) : '';
    $teamId = isset($_POST['txtTeamId']) ? trim($_POST['txtTeamId']) : '';

    if (!empty($userId) && !empty($teamId)) {
        $sql = "UPDATE tbl_team_status SET `col_approval` = 'Active' 
        WHERE userId = ? AND uryyTteamoeSS4 = ? AND col_company_Id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iss", $userId, $teamId, $_SESSION['usr_compId']);

            if ($stmt->execute()) {
                header("Location: ./carer-availability?uryyTteamoeSS4=$teamId");
            } else {
                header("Location: ./carer-availability?uryyTteamoeSS4=$teamId");
            }
            $stmt->close();
        } else {
            header("Location: ./carer-availability?uryyTteamoeSS4=$teamId");
        }
    } else {
        header("Location: ./carer-availability?uryyTteamoeSS4=$teamId");
    }
}

$conn->close();
