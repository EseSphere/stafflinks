<?php
// Fetch client name
$sql_client_name = mysqli_query($conn, "SELECT `client_first_name`,`client_last_name` 
    FROM `tbl_general_client_form` 
    WHERE uryyToeSS4 = '$uryyToeSS4' 
      AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "' ");
$row_client_name = mysqli_fetch_array($sql_client_name, MYSQLI_ASSOC);
$varClientFirstName = $row_client_name['client_first_name'];
$varClientLastName  = $row_client_name['client_last_name'];
$clientFullName     = $varClientFirstName . ' ' . $varClientLastName;

// Fetch latest funding for this client every time page loads
$stmt = $conn->prepare("SELECT * FROM tbl_funding WHERE uryyToeSS4 = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("s", $uryyToeSS4);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $la_funding      = $row['la_funding'];
    $private_funding = $row['private_funding'];
    $nhs_funding     = $row['nhs_funding'];
    $order_funding   = $row['order_funding'];
    $varLocalAuth    = $row['local_authority_id'];
} else {
    $la_funding = $private_funding = $nhs_funding = $order_funding = $varLocalAuth = '';
}

// Handle form submission
if (isset($_POST['btnSaveClientFunding'])) {
    $clientId       = $_POST['txtClientId'];
    $companyId      = $_POST['txtCompanyId'];
    $laFunding      = isset($_POST['txtLAFunding']) ? $_POST['txtLAFunding'] : '';
    $privateFunding = isset($_POST['txtPrivateFunding']) ? $_POST['txtPrivateFunding'] : '';
    $nhsFunding     = isset($_POST['txtNHSFunding']) ? $_POST['txtNHSFunding'] : '';
    $orderFunding   = isset($_POST['txtOrderFunding']) ? $_POST['txtOrderFunding'] : '';
    $localAuthority = $_POST['txtLocalAuthority'];

    // Insert into database safely
    $stmtInsert = $conn->prepare("INSERT INTO tbl_funding 
        (uryyToeSS4, company_id, client_name, la_funding, private_funding, nhs_funding, order_funding, local_authority_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtInsert->bind_param("ssssssss", $clientId, $companyId, $clientFullName, $laFunding, $privateFunding, $nhsFunding, $orderFunding, $localAuthority);

    if ($stmtInsert->execute()) {
        $successMsg = "Funding information saved successfully!";
        // Update variables to reflect the latest submission immediately
        $la_funding = $laFunding;
        $private_funding = $privateFunding;
        $nhs_funding = $nhsFunding;
        $order_funding = $orderFunding;
        $varLocalAuth = $localAuthority;
    } else {
        $errorMsg = "Error saving funding information: " . $stmtInsert->error;
    }

    $stmtInsert->close();
}
