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
if (isset($_POST['txtSecondBox'], $_POST['txtthirdBox'], $_POST['txtcompanyClientId'], $_POST['txtCompanyId'])) {
    $txtSecondBox = trim($_POST['txtSecondBox']);
    $txtThirdBox = trim($_POST['txtthirdBox']);
    $txtCompanyClientId = trim($_POST['txtcompanyClientId']);
    $txtCompanyId = trim($_POST['txtCompanyId']);

    $stmt = $conn->prepare("UPDATE tbl_general_client_form SET col_swn_number = ?, col_second_phone = ? 
    WHERE uryyToeSS4 = ? AND col_company_Id = ?");
    $stmt->bind_param("ssss", $txtSecondBox, $txtThirdBox, $txtCompanyClientId, $txtCompanyId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $stmt->close();
        header("Location: ./client-details?uryyToeSS4=" . urlencode($txtCompanyClientId));
        exit();
    } else {
        $stmt->close();
        echo "No records were updated.";
    }
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