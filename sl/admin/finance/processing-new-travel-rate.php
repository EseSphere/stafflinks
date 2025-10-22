<?php
if (isset($_POST['btnAddNewTravelRate'])) {

    $txtName = mysqli_real_escape_string($conn, $_REQUEST['txtName']);
    $txtHourlyRate = mysqli_real_escape_string($conn, $_REQUEST['txtHourlyRate']);
    $txtMileageRate = mysqli_real_escape_string($conn, $_REQUEST['txtMileageRate']);
    $txtBreak = mysqli_real_escape_string($conn, $_REQUEST['txtBreak']);
    $txtPayWaitingTime = mysqli_real_escape_string($conn, $_REQUEST['txtPayWaitingTime']);

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
        $sql_get_payer_Id = mysqli_query($conn, "SELECT * FROM tbl_travel_rate ORDER BY userId DESC LIMIT 1");
        $row_get_payer_Id = mysqli_fetch_array($sql_get_payer_Id);
        $varSpecialId = $row_get_payer_Id['col_special_Id'];
        if ($row_get_payer_Id == 0) {
            $myRateId = 1021;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_travel_rate (col_name, col_hourly_rate, col_mileage_rate, col_break, col_pay_waiting_time, col_special_Id, col_company_Id, col_date) 
            VALUES('" . $txtName . "', '" . $txtHourlyRate . "', '" . $txtMileageRate . "', '" . $txtBreak . "', '" . $txtPayWaitingTime . "', '" . $myRateId . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");
            if ($queryIns) {
                header("Location: ./new-travel-rate");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        } else {
            $myRateId = $varSpecialId + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_travel_rate (col_name, col_hourly_rate, col_mileage_rate, col_break, col_pay_waiting_time, col_special_Id, col_company_Id, col_date)
            VALUES('" . $txtName . "', '" . $txtHourlyRate . "', '" . $txtMileageRate . "', '" . $txtBreak . "', '" . $txtPayWaitingTime . "', '" . $myRateId . "', '" . $myCompanyId . "', '" . $txtCurrentDate . "') ");
            if ($queryIns) {
                header("Location: ./new-travel-rate");
            } else {
                echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
            }
        }
    }
}
