<?php


if (isset($_POST['btnUpdateHolidayRate'])) {
    include('dbconnections.php');

    $txtone = mysqli_real_escape_string($conn, $_REQUEST['txtone']);
    $txttwo = mysqli_real_escape_string($conn, $_REQUEST['txttwo']);
    $txtthree = mysqli_real_escape_string($conn, $_REQUEST['txtthree']);
    $txtfour = mysqli_real_escape_string($conn, $_REQUEST['txtfour']);
    $myCompanyId = mysqli_real_escape_string($conn, $_REQUEST['myCompanyId']);
    $txtHolidayId = mysqli_real_escape_string($conn, $_REQUEST['txtHolidayId']);

    $sql_update_holiday_rate = mysqli_query($conn, "UPDATE tbl_holiday SET `col_description`='" . $txtone . "', `col_holiday_date`='" . $txttwo . "', `col_pay_multiplier`='" . $txtthree . "', `col_charge_multiplier`='" . $txtfour . "' 
    WHERE (`col_special_Id`='" . $txtHolidayId . "' AND `col_company_id`='" . $myCompanyId . "')");
    if ($sql_update_holiday_rate) {
        header("Location: ./holiday-rate");
    } else {
        echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
    }
}
