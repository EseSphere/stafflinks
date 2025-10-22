<?php
// Database connection
include('dbconnections.php');
// Process form submission
if (isset($_POST['btnSaveClientFunding'])) {
    $clientName   = $_POST['txtClientFullName'] ?? '';
    $clientId     = $_POST['txtClientId'] ?? '';
    $companyId    = $_POST['txtCompanyId'] ?? '';
    $laFunding    = isset($_POST['txtLAFunding']) ? $_POST['txtLAFunding'] : null;
    $privateFunding = isset($_POST['txtPrivateFunding']) ? $_POST['txtPrivateFunding'] : null;
    $nhsFunding   = isset($_POST['txtNHSFunding']) ? $_POST['txtNHSFunding'] : null;
    $orderFunding = isset($_POST['txtOrderFunding']) ? $_POST['txtOrderFunding'] : null;
    $localAuthorityId = $_POST['txtLocalAuthority'] ?? '';

    // Check if the record already exists for this client
    $checkSql = "SELECT userId FROM tbl_funding WHERE uryyToeSS4 = ? AND company_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ss", $clientId, $companyId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // UPDATE existing record
        $updateSql = "UPDATE tbl_funding SET client_name = ?, la_funding = ?, private_funding = ?, 
        nhs_funding = ?, order_funding = ?, local_authority_id = ? WHERE uryyToeSS4 = ? AND company_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param(
            "ssssssss",
            $clientName,
            $laFunding,
            $privateFunding,
            $nhsFunding,
            $orderFunding,
            $localAuthorityId,
            $clientId,
            $companyId
        );
        $updateStmt->execute();
        $updateStmt->close();
        header("Location: ./client-funding?uryyToeSS4=" . urlencode($clientId));
        exit;
    } else {
        // INSERT new record
        $insertSql = "INSERT INTO tbl_funding (uryyToeSS4, company_id, client_name, la_funding, private_funding, nhs_funding, order_funding, local_authority_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param(
            "ssssssss",
            $clientId,
            $companyId,
            $clientName,
            $laFunding,
            $privateFunding,
            $nhsFunding,
            $orderFunding,
            $localAuthorityId
        );
        $insertStmt->execute();
        $insertStmt->close();
        header("Location: ./client-funding?uryyToeSS4=" . urlencode($clientId));
    }
    $stmt->close();
}
$conn->close();
