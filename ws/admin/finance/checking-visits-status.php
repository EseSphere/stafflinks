<?php

include('dbconnections.php');
$sql_select_company_data = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
$row_select_company_data = mysqli_fetch_array($sql_select_company_data, MYSQLI_ASSOC);
$var_comapanyId = $row_select_company_data['col_company_Id'];

$SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE (user_email_address = '" . $_SESSION['usr_email'] . "') ");
$rowSelect_now = mysqli_fetch_array($SelectQuery, MYSQLI_ASSOC);
$varFinanceAccess = $rowSelect_now['finance_access'];
$varCompanyIds = $rowSelect_now['col_company_Id'];

if ($varFinanceAccess == 'Granted' and $varCompanyIds == $var_comapanyId) {
    header('Location: ./set-dashboard-cookie');
} else {
    header('Location: ./visits-not-found');
}
