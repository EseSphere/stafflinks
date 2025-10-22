<?php

if (isset($_POST["btnExportPayDash"])) {
    // Load the database configuration file 
    include_once 'dbconnections.php';

    $txtPeriodStart = mysqli_real_escape_string($conn, $_POST["txtPeriodStart"]);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST["txtPeriodEnd"]);
    $txtCaregiver = mysqli_real_escape_string($conn, $_POST["txtCaregiver"]);
    // Fetch records from database 
    //$sql_get_carerIds = $conn->query("SELECT * FROM tbl_daily_shift_records WHERE ((shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd') AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') GROUP by col_carer_Id");
    $query = $conn->query("SELECT * FROM tbl_daily_shift_records WHERE ((shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd') AND (col_carer_Id = '$txtCareGiver' OR shift_status = '$txtCareGiver') AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') GROUP by col_carer_Id");

    if ($query->num_rows > 0) {
        $delimiter = ",";
        $filename = "Pay_dashboard_" . date('Y-m-d') . ".csv";

        // Create a file pointer 
        $f = fopen('php://memory', 'w');

        // Set column headers 
        $fields = array('CARE GIVER', 'START DATE', 'END DATE', 'CARE DELIVERY(Hours)', 'CARE DELIVERY(Amount)', 'WAITING', 'MILES', 'MILEAGE', 'EXPENSES', 'TOTAL');
        fputcsv($f, $fields, $delimiter);

        // Output each row of the data, format line as csv and write to file pointer 
        while ($row = $query->fetch_assoc()) {
            $varExpenses = '0.00';
            $varWaitingRate = '0.00';
            $varCarerIds = $row['col_carer_Id'];
            $varCareCallRate = number_format((float)$row['col_carecall_rate'], 2, '.', '');

            $sql_total_balance = mysqli_query($conn, "SELECT SUM(`col_carecall_rate`) AS total_payment FROM `tbl_daily_shift_records` WHERE ((col_carer_Id = '$varCarerIds') AND shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
            $row_total_balance = mysqli_fetch_array($sql_total_balance, MYSQLI_ASSOC);
            $total_carerPayment = number_format((float)$row_total_balance['total_payment'], 2, '.', '');

            $sql_total_miles = mysqli_query($conn, "SELECT SUM(`col_miles`) AS total_miles FROM `tbl_daily_shift_records` WHERE ((col_carer_Id = '$varCarerIds') AND shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
            $row_total_miles = mysqli_fetch_array($sql_total_miles, MYSQLI_ASSOC);
            $total_total_miles = number_format((float)$row_total_miles['total_miles'], 2, '.', '');

            $sql_total_mileage_fee = mysqli_query($conn, "SELECT SUM(`col_mileage`) AS total_MF FROM `tbl_daily_shift_records` WHERE ((col_carer_Id = '$varCarerIds') AND shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
            $row_total_mileage_fee = mysqli_fetch_array($sql_total_mileage_fee, MYSQLI_ASSOC);
            $varMileageRate = number_format((float)$row_total_mileage_fee['total_MF'], 2, '.', '');

            $sql_total_hour = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) AS total_worked_hours FROM `tbl_daily_shift_records` WHERE ((col_carer_Id = '$varCarerIds') AND shift_date >= '$txtPeriodStart' AND shift_date <= '$txtPeriodEnd' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
            $row_total_hour = mysqli_fetch_array($sql_total_hour, MYSQLI_ASSOC);
            $total_hours = $row_total_hour['total_worked_hours'];
            // Split the time into hours, minutes, and seconds
            list($hours, $minutes, $seconds) = explode(':', $total_hours);
            // Convert the time into seconds
            $total_seconds = $hours * 3600 + $minutes * 60 + $seconds; // Outputs: 9045

            $hours = floor($total_seconds / 3600);
            $minutes = floor(($total_seconds % 3600) / 60);
            $seconds = $total_seconds % 60;

            $formatted_Carertime = sprintf('%02d:%02d', $hours, $minutes, $seconds);

            $carerPayment = $total_carerPayment + $varMileageRate;
            $varTotalRate = number_format((float)$carerPayment, 2, '.', '');


            //Export selected data from database in excel format
            $lineData = array("" . $row['carer_Name'] . "", "" . $txtPeriodStart . "", "" . $txtPeriodEnd . "", "" . $formatted_Carertime . "", "" . $total_carerPayment . "", "" . $varWaitingRate . "", "" . $total_total_miles . "", "" . $varMileageRate . "", "" . $varExpenses . "", "" . $varTotalRate . "");
            fputcsv($f, $lineData, $delimiter);
        }

        // Move back to beginning of file 
        fseek($f, 0);

        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer 
        fpassthru($f);
    }
    exit;
    echo "<script>
                window.history.go(-1);
            </script>";
}
