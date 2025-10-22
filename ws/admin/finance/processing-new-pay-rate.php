<?php

if (isset($_POST['btnAddData'])) {
    $txtName = mysqli_real_escape_string($conn, $_REQUEST['txtName']);
    $txtdayType = mysqli_real_escape_string($conn, $_REQUEST['txtdayType']);
    $txtWWTA = mysqli_real_escape_string($conn, $_REQUEST['txtWWTA']);
    $txtRateType = mysqli_real_escape_string($conn, $_REQUEST['txtRateType']);
    $txtHourlyRate = mysqli_real_escape_string($conn, $_REQUEST['txtHourlyRate']);
    $txtSelectservicetype = mysqli_real_escape_string($conn, $_REQUEST['txtSelectservicetype']);

    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myCheck = "SELECT * FROM tbl_pay_rate WHERE col_name = '" . $txtName . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";
    } else {
        $sql_get_payer_Id = mysqli_query($conn, "SELECT * FROM tbl_pay_rate ORDER BY userId DESC LIMIT 1");
        $row_get_payer_Id = mysqli_fetch_array($sql_get_payer_Id);
        $varSpecialId = $row_get_payer_Id['col_special_Id'];
        if ($row_get_payer_Id == 0) {
            $myRateId = 1021;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_pay_rate (col_name, col_days, col_applies, col_type, col_rates, col_service_type, col_special_Id, col_date, col_company_Id) 
            VALUES('" . $txtName . "', '" . $txtdayType . "', '" . $txtWWTA . "', '" . $txtRateType . "', '" . $txtHourlyRate . "', '" . $txtSelectservicetype . "', '" . $myRateId . "', '" . $txtCurrentDate . "', '" . $myCompanyId . "') ");
            if ($queryIns) {
                header("Location: ./new-pay-rates");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        } else {
            $myRateId = $varSpecialId + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_pay_rate (col_name, col_days, col_applies, col_type, col_rates, col_service_type, col_special_Id, col_date, col_company_Id) 
            VALUES('" . $txtName . "', '" . $txtdayType . "', '" . $txtWWTA . "', '" . $txtRateType . "', '" . $txtHourlyRate . "', '" . $txtSelectservicetype . "', '" . $myRateId . "', '" . $txtCurrentDate . "', '" . $myCompanyId . "') ");
            if ($queryIns) {
                header("Location: ./new-pay-rates");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        }
    }
}
