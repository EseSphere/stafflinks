<?php
$sql_get_funding_details = mysqli_query($conn, "SELECT * FROM `tbl_funding` WHERE (uryyToeSS4 = '$uryyToeSS4' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
$row_get_funding_details = mysqli_fetch_array($sql_get_funding_details, MYSQLI_ASSOC);
$varGetFundingType = $row_get_funding_details['col_invoice_format'];

if ($varGetFundingType == 'Local Authority') {
    echo $varGetFundingType = 'Local Authority';
} elseif ($varGetFundingType == 'Private') {
    echo  $varGetFundingType = 'Private';
} elseif ($varGetFundingType == 'NHS') {
    echo  $varGetFundingType = 'Private';
} elseif ($varGetFundingType == 'Private') {
    echo  $varGetFundingType = 'Private';
}
