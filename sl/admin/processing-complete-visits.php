<?php
if (isset($_POST['btnCompleteVisit'])) {
    include('dbconnections.php');

    $shiftStatus = "Checked in";
    $txtDateOfVisit = mysqli_real_escape_string($conn, $_POST['txtDateOfVisit']);
    $txtTimeIn = mysqli_real_escape_string($conn, $_POST['txtTimeIn']);
    $txtTimeOut = mysqli_real_escape_string($conn, $_POST['txtTimeOut']);
    $txtActTimeIn = mysqli_real_escape_string($conn, $_POST['txtTimeIn']);
    $txtActTimeOut = mysqli_real_escape_string($conn, $_POST['txtTimeOut']);
    $txtClientName = mysqli_real_escape_string($conn, $_POST['txtClientName']);
    $txtClientId = mysqli_real_escape_string($conn, $_POST['txtClientId']);
    $txtClientCareCall = mysqli_real_escape_string($conn, $_POST['txtClientCareCall']);
    $txtClientArea = mysqli_real_escape_string($conn, $_POST['txtClientArea']);
    $txtCarerName = mysqli_real_escape_string($conn, $_POST['txtCarerName']);
    $clientSpecialId = mysqli_real_escape_string($conn, $_POST['clientSpecialId']);
    $txtGeneralObservation = mysqli_real_escape_string($conn, $_POST['txtGeneralObservation']);
    $txtCarerId = mysqli_real_escape_string($conn, $_POST['txtCarerId']);
    $txtAreaId = mysqli_real_escape_string($conn, $_POST['txtAreaId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_POST['txtCompanyId']);
    $txtCompleted = mysqli_real_escape_string($conn, $_POST['txtCompleted']);
    $txtTrue = mysqli_real_escape_string($conn, $_POST['txtTrue']);
    $txtUnconfirmed = mysqli_real_escape_string($conn, $_POST['txtUnconfirmed']);
    $txtUserId = mysqli_real_escape_string($conn, $_POST['txtUserId']);
    $postcode = mysqli_real_escape_string($conn, $_POST['txtPostalCode']);
    $txtPayRate = mysqli_real_escape_string($conn, $_POST['txtPayRate']);
    $txtCarerPC = "WV1 4DJ";

    $varVisitComplete = "Completed";

    $apiKey = "AIzaSyD6PMtd0Xclj8iUbXOzQFoSjYSFYLyiVyM";
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //This is to get the client funding, calculate the total hours worked and the total funding
    $sql_get_visit_funding = mysqli_query($conn, "SELECT * FROM `tbl_manage_runs` 
    WHERE (uryyToeSS4 = '$txtClientId' AND care_calls = '$txtClientCareCall' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ORDER BY userId DESC LIMIT 1 ");
    $row_get_visit_funding = mysqli_fetch_array($sql_get_visit_funding, MYSQLI_ASSOC);
    $varFundingName = $row_get_visit_funding['col_client_funding'];
    $varFundingRate = $row_get_visit_funding['col_funding_rate'];

    $result = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`dateTime_out`, `dateTime_in`)))) AS total_worked_hours FROM `tbl_schedule_calls` 
    WHERE (userId = '$txtUserId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "')");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $total_hours = $row['total_worked_hours'];
    $timehour = explode('.', $total_hours)[0];
    $formatted = date("H:i", strtotime($timehour));

    $time = strtotime($total_hours);
    $round = 60;
    $rounded = round($time / $round) * $round;
    $displayCurHour = date("H", $rounded);
    $displayCurMint = date("i", $rounded);
    function calculatePay($hours, $minutes, $hourlyRate)
    {
        $totalHours = $hours + ($minutes / 60);
        return $totalHours * $hourlyRate;
    }
    $hoursWorked = $displayCurHour; // Total hours worked
    $minutesWorked = $displayCurMint; // Total minutes worked
    $hourlyRate = $varFundingRate; // Hourly rate in currency units

    $totalPay = calculatePay($hoursWorked, $minutesWorked, $hourlyRate);
    $varClientWorkedRate = number_format((float)$totalPay, 2, '.', '');
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Get the most recent visit postcode
    $sql_get_recent_visit_pc = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records 
    WHERE shift_date = '$txtDateOfVisit' AND col_carer_Id = '$txtCarerId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' 
    ORDER BY userId DESC LIMIT 1");

    $row_get_recent_visit_pc = mysqli_fetch_array($sql_get_recent_visit_pc, MYSQLI_ASSOC);
    $count_get_recent_visit_pc = mysqli_num_rows($sql_get_recent_visit_pc);
    function getDistance($origin, $destination, $apiKey)
    {
        $origin = urlencode($origin);
        $destination = urlencode($destination);
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&key=$apiKey";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if ($data['status'] === 'OK') {
            return $data['rows'][0]['elements'][0]['distance']['text'];
        } else {
            return "Error: " . $data['status'];
        }
    }

    $originPC = ($count_get_recent_visit_pc != 0) ? $row_get_recent_visit_pc['col_postcode'] : $txtCarerPC;
    $distanceMiles = getDistance($originPC, $postcode, $apiKey);
    $milesRate = $distanceMiles * 0.30;

    $sql = "SELECT * FROM tbl_daily_shift_records WHERE (shift_date = '$txtDateOfVisit' AND uryyToeSS4 = '$txtClientId' AND col_care_call = '$txtClientCareCall' AND col_carer_Id = '$txtCarerId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script type='text/javascript'>alert('This visit has already been completed!');</script>";
        echo "<script>window.location.href='./roster/';</script>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tbl_daily_shift_records (shift_status, shift_date, planned_timeIn, planned_timeOut, shift_start_time, shift_end_time, client_name, uryyToeSS4, col_care_call, client_group, carer_Name, task_note, col_carer_Id, timesheet_date, col_area_Id, col_company_Id, col_call_status, col_carecall_rate, col_miles, col_mileage, col_worked_time, col_client_rate, col_client_payer, col_visit_status, col_visit_confirmation, col_care_call_Id, col_postcode) 
        VALUES ('$shiftStatus', '$txtDateOfVisit', '$txtTimeIn', '$txtTimeOut', '$txtActTimeIn', '$txtActTimeOut', '$txtClientName', '$txtClientId', '$txtClientCareCall', '$txtClientArea', '$txtCarerName', '$txtGeneralObservation', '$txtCarerId', '$txtDateOfVisit', '$txtAreaId', '$txtCompanyId', '$txtCompleted', '$txtPayRate', '$milesRate', '$distanceMiles', '$formatted', '$varClientWorkedRate', '$varFundingName', '$txtTrue', '$txtUnconfirmed', '$txtUserId', '$postcode')");
        if ($insert) {
            $update = "UPDATE tbl_schedule_calls SET call_status = '$varVisitComplete' WHERE userId = '$txtUserId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
            if (mysqli_query($conn, $update)) {
                echo "<script>window.location.href='./roster/';</script>";
            }
        }
    }
}
