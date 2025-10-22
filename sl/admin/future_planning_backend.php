<?php
include('client-header-contents.php');
$uryyToeSS4 = $_GET['uryyToeSS4'] ?? null;
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ? 
AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = $row['client_first_name'] . ' ' . $row['client_last_name'] ?? null;
$stmt->close();

if (isset($_POST['btnSaveDetails'])) {
    $firstBox = $_POST['txtFirstBox']; //Does he/she have capacity to make decisions related to their health and wellbeing?
    $secondBox = $_POST['txtSecondBox']; //Health and Welfare LPA
    $thirdBox = $_POST['txtThiredBox']; //Property and Financial Affairs LPA
    $fourthBox = $_POST['txtFourthBox']; //Do Not Attempt Cardiopulmonary Resuscitation (DNACPR)
    $fifthBox = $_POST['txtFifthBox']; //Advance Decision to Refuse Treatment (ADRT / Living Will)
    $sixthBox = $_POST['txtSixthBox']; //Recommended Summary Plan for Emergency Care and Treatment (ReSPECT)
    $seventhBox = $_POST['txtSeventhBox']; //Where is it kept?

    $stmt = $conn->prepare("INSERT INTO tbl_future_planning (col_first_box, col_second_box, col_third_box, col_fourt_box, col_fift_box, col_sixth_box, col_seventh_box, uryyToeSS4, col_company_Id) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $firstBox, $secondBox, $thirdBox, $fourthBox, $fifthBox, $sixthBox, $seventhBox, $uryyToeSS4, $_SESSION['usr_compId']);
    $stmt->execute();
    $stmt->close();
}
?>

<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }
</style>