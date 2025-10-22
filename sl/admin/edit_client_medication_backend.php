<?php
include('client-header-contents.php');
if (isset($_GET['med_Id'])) {
    $medId = $_GET['med_Id'];
}
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();
$clientFullName = $row['client_first_name'] . " " . $row['client_last_name'];

$select_client_carecalls = mysqli_query($conn, "SELECT * FROM tbl_clienttime_calls 
WHERE uryyToeSS4='" . mysqli_real_escape_string($conn, $_SESSION['uryyToeSS4']) . "' 
AND col_company_Id='" . mysqli_real_escape_string($conn, $_SESSION['usr_compId']) . "'");

$call_map = [
    'EM morning call' => 'EM',
    'EL lunch call' => 'EL',
    'ET tea call' => 'ET',
    'EB bed call' => 'EB'
];

$sql = "SELECT * FROM tbl_clients_medication_records 
WHERE med_Id = ? AND col_company_Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $medId, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $med_name = $row['med_name'];
    $med_dosage = $row['med_dosage'];
    $med_type = $row['med_type'];
    $med_support_required = $row['med_support_required'];
    $med_package = $row['med_package'];
    $med_details = $row['med_details'];
    $care_call1 = $row['care_call1'];
    $care_call2 = $row['care_call2'];
    $care_call3 = $row['care_call3'];
    $care_call4 = $row['care_call4'];
    $client_startMed = $row['client_startMed'];
    $client_endMed = $row['client_endMed'];
    // Now all fields are in variables
} else {
    echo "No record found.";
}
