<?php
include('client-header-contents.php');
$result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
$_SESSION['uryyToeSS4'] = $uryyToeSS4;
$row = mysqli_fetch_array($result);
$clientFullName = $row['client_first_name'] . " " . $row['client_last_name'];

$select_client_carecalls = mysqli_query($conn, "SELECT * FROM tbl_clienttime_calls 
WHERE uryyToeSS4='$uryyToeSS4' AND col_startDate <= '$today' AND (col_endDate >= '$today' 
OR col_endDate = '') AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");

$callMap = [
    'EM morning call' => ['name' => 'txtEM', 'label' => 'EM'],
    'EL lunch call'    => ['name' => 'txtEL', 'label' => 'EL'],
    'ET tea call'      => ['name' => 'txtET', 'label' => 'ET'],
    'EB bed call'      => ['name' => 'txtEB', 'label' => 'EB'],
    'Extra visit'      => ['name' => 'txtExtraVisit', 'label' => 'Extra'],
];
