<?php
include('client-header-contents.php');
include('processing-client-medicine.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();
$clientFullName = $row['client_first_name'] . " " . $row['client_last_name'];

$stmt = $conn->prepare("SELECT care_calls FROM tbl_clienttime_calls WHERE uryyToeSS4 = ? 
AND col_startDate <= ? AND (col_endDate >= ? OR col_endDate = '') AND col_company_Id = ?");
$stmt->bind_param("ssss", $uryyToeSS4, $today, $today, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$careCallMap = [
    'EM morning call' => ['name' => 'txtEM', 'label' => 'EM'],
    'EL lunch call'   => ['name' => 'txtEL', 'label' => 'EL'],
    'ET tea call'     => ['name' => 'txtET', 'label' => 'ET'],
    'EB bed call'     => ['name' => 'txtEB', 'label' => 'EB'],
    'Extra visit'     => ['name' => 'txtExtraVisit', 'label' => 'Extra']
];
