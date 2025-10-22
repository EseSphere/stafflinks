<?php
if (isset($_POST['btnScheduleRuns'])) {
    include('dbconnections.php');
    $txtCarerName = mysqli_real_escape_string($conn, $_REQUEST['txtCarerName']);
    $txtNewCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtNewCarerId']);
    $txtShiftDate = mysqli_real_escape_string($conn, $_REQUEST['txtSelectedDate']);
    $txtCurrentCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtCurrentCarerId']);
    $txtCareCalls = mysqli_real_escape_string($conn, $_REQUEST['txtCareCalls']);
    $txtRunName = mysqli_real_escape_string($conn, $_REQUEST['txtRunName']);
    $txtClientSpecId = mysqli_real_escape_string($conn, $_REQUEST['txtClientSpecId']);

    $db_firstCarerWorkRes = 'Null';
    $firstAttempId = 'First attempt';
    $timelineColour = "#34495e";
    $txtVisitColorCode = "rgba(255, 255, 255,1.0)";
    $righttoDisplay = "True";
    $status = "Scheduled";
    $bgChange = 'rgba(44, 62, 80,.5)';

    $txtPayCarer = "True";
    $txtInvoice = "True";
    $weekoneId = 'Week one';
    $weektwoId = 'Week two';
    $txtClientGroup = mysqli_real_escape_string($conn, $_REQUEST['txtClientGroup']);
    $todayDay = date('l');


    $sqlCheck = "SELECT * FROM tbl_schedule_calls WHERE Clientshift_Date = '$txtShiftDate' 
    AND care_calls = '$txtCareCalls' AND uryyToeSS4 = '$txtClientSpecId' AND first_carer_Id = '$txtCurrentCarerId' ";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        $sql = "UPDATE tbl_schedule_calls SET first_carer = '$txtCarerName', first_carer_Id = '$txtNewCarerId' 
        WHERE (Clientshift_Date = '$txtShiftDate' AND first_carer_Id = '$txtCurrentCarerId' AND care_calls = '$txtCareCalls' 
        AND col_run_name = '$txtRunName' AND uryyToeSS4 = '$txtClientSpecId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ./roster/schedule-visits?txtDate=$txtShiftDate");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        //if next and next two week checkbox is not checked then insert a new care call
        $CopyClient_timeDetail = mysqli_query($conn, "INSERT INTO tbl_schedule_calls (client_name, client_area, col_area_city, col_area_Id, uryyToeSS4, 
    first_carer, first_carer_Id, care_calls, dateTime_in, dateTime_out, col_run_name, col_required_carers, Clientshift_Date, team_resource, 
    timeline_colour, col_visitColor_code, rightTo_display, call_status, bgChange, col_period_one, col_period_two, col_pay_status, col_invoice_status, 
    col_company_Id, col_weekly_routine) SELECT client_name, client_area, col_client_city, run_area_nameId, uryyToeSS4, '$txtCarerName', '$txtNewCarerId', 
    care_calls, dateTime_in, dateTime_out, col_run_name, col_required_carers, '$txtShiftDate', '$db_firstCarerWorkRes', '$timelineColour', '$txtVisitColorCode', 
    '$righttoDisplay', '$status', '$bgChange', col_period_one, col_period_two, '$txtPayCarer', '$txtInvoice', col_company_Id, '$firstAttempId' FROM tbl_manage_runs 
    WHERE (userId = '$txtClientGroup') ");
        if ($CopyClient_timeDetail) {
            header("Location: ./roster/schedule-visits?txtDate=$txtShiftDate");
        }
    }
}
