<?php
include('team-header-contents.php');
$stmt = $conn->prepare("
    SELECT gtf.*, th.* 
    FROM tbl_general_team_form AS gtf
    LEFT JOIN tbl_team_highlight AS th 
      ON gtf.uryyTteamoeSS4 = th.uryyTteamoeSS4 AND gtf.col_company_Id = th.col_company_Id
    WHERE gtf.uryyTteamoeSS4 = ? AND gtf.col_company_Id = ?
");
$stmt->bind_param("ss", $uryyTteamoeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$varCarerNames = $row['team_first_name'] . " " . $row['team_last_name'];


if (isset($_POST['btnUpdateHighlight'])) {
    $highlight = $conn->real_escape_string($_POST['txtHighlight']);

    $sql_query = "SELECT * FROM tbl_team_highlight WHERE uryyTteamoeSS4 = '$uryyTteamoeSS4' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
    $result = mysqli_query($conn, $sql_query);

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE tbl_team_highlight SET team_highlight = '$highlight' 
        WHERE uryyTteamoeSS4 = '$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
        if ($conn->query($sql) === TRUE) {
            header("Location: ./team-details?uryyTteamoeSS4=$uryyTteamoeSS4");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        $sql = "INSERT INTO tbl_team_highlight (team_highlight, uryyTteamoeSS4, col_company_Id) 
        VALUES ('$highlight', '$uryyTteamoeSS4', '" . $_SESSION['usr_compId'] . "')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ./team-details?uryyTteamoeSS4=$uryyTteamoeSS4");
            exit();
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }
}
