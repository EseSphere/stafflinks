<?php
if (isset($_POST['btnAddNewHolidayData'])) {

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);

    $mySpecialId = mysqli_real_escape_string($conn, $_REQUEST['mySpecialId']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtCurrentDate = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentDate']);

    $myRateId = hash('sha256', $mySpecialId);

    $myCheck = "SELECT * FROM tbl_holiday WHERE col_description = '" . $txtone . "' ";
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
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_holiday (col_description, col_holiday_date, col_pay_multiplier, col_charge_multiplier, col_special_Id, col_date, col_company_Id) 
            VALUES('" . $txtone . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtfour . "', '" . $myRateId . "', '" . $txtCurrentDate . "', '" . $myCompanyId . "') ");
            if ($queryIns) {
                header("Location: ./new-holiday");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        } else {
            $myRateId = $varSpecialId + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_holiday (col_description, col_holiday_date, col_pay_multiplier, col_charge_multiplier, col_special_Id, col_date, col_company_Id)
            VALUES('" . $txtone . "', '" . $txttwo . "', '" . $txtthree . "', '" . $txtfour . "', '" . $myRateId . "', '" . $txtCurrentDate . "', '" . $myCompanyId . "') ");
            if ($queryIns) {
                header("Location: ./new-holiday");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        }
    }
}
