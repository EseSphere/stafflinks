<?php
if (isset($_POST['btnScheduleRuns'])) {
    include('dbconnections.php');

    // Sanitize input
    $txtFirstCarer      = mysqli_real_escape_string($conn, trim($_POST['txtFirstCarer'] ?? ''));
    $txtFirstCarerId    = mysqli_real_escape_string($conn, $_POST['txtFirstCarerId'] ?? '');
    $txtClientGroup     = mysqli_real_escape_string($conn, $_POST['txtClientGroup'] ?? '');

    $txtShiftDate       = mysqli_real_escape_string($conn, $_POST['txtShiftDate'] ?? '');
    $txtRotaDateInDay   = mysqli_real_escape_string($conn, $_POST['txtRotaDateInDay'] ?? '');
    $txtRunNameArea     = mysqli_real_escape_string($conn, $_POST['txtRunNameArea'] ?? '');
    $txtRunNameCity     = mysqli_real_escape_string($conn, $_POST['txtRunNameCity'] ?? '');

    $carecalls_Id       = mysqli_real_escape_string($conn, $_POST['carecallID'] ?? '');
    $txtCurCarerId      = mysqli_real_escape_string($conn, $_POST['txtCurCarerId'] ?? '');
    $txtRunName         = mysqli_real_escape_string($conn, $_POST['txtRunName'] ?? '');
    $txtRunNameId       = mysqli_real_escape_string($conn, $_POST['txtRunNameId'] ?? '');

    $attemptone         = mysqli_real_escape_string($conn, $_POST['firstAttempId'] ?? '');
    $attempttwo         = mysqli_real_escape_string($conn, $_POST['weekoneId'] ?? '');
    $attemptthree       = mysqli_real_escape_string($conn, $_POST['weektwoId'] ?? '');

    $timelineColour     = "#34495e";
    $txtMileage         = mysqli_real_escape_string($conn, $_POST['txtMileage'] ?? '');
    $status             = "Scheduled";
    $bgChange           = 'rgba(44, 62, 80, 0.5)';

    $txtPayRate         = mysqli_real_escape_string($conn, $_POST['txtPayRate'] ?? '');
    $txtVisitColorCode  = "rgba(255, 255, 255,1.0)";

    $db_firstCarerWorkRes = "Null";
    $firstAttempId        = "Null";

    // Check if the run already has a scheduled visit for that day
    $sqlCheck = "
        SELECT * FROM tbl_schedule_calls 
        WHERE col_run_name = '$txtRunName' 
          AND Clientshift_Date = '$txtShiftDate' 
          AND col_company_Id = '" . $_SESSION['usr_compId'] . "'
    ";
    $result = mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($result) > 0) {
        $sqlUpdate = "
            UPDATE tbl_schedule_calls 
            SET first_carer = '$txtFirstCarer', first_carer_Id = '$txtFirstCarerId'
            WHERE col_run_name = '$txtRunName' 
              AND Clientshift_Date = '$txtShiftDate' 
              AND col_company_Id = '" . $_SESSION['usr_compId'] . "'
        ";
        if (mysqli_query($conn, $sqlUpdate)) {
            header("Location: ./roster/schedule-visits?txtDate=$txtShiftDate");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Select clients for the run
        $sel_dist_attr = mysqli_query($conn, "
            SELECT mr.*, cc.col_client_Id AS cancelled_client_id 
            FROM tbl_manage_runs AS mr
            LEFT JOIN tbl_cancelled_call AS cc 
                ON mr.uryyToeSS4 = cc.col_client_Id 
                AND mr.care_calls = cc.col_care_call 
                AND DATE(cc.col_date) = CURDATE()
            LEFT JOIN tbl_client_status_records AS csr 
                ON mr.uryyToeSS4 = csr.col_client_Id 
                AND mr.col_company_Id = csr.col_company_Id 
                AND (
                    (CURDATE() BETWEEN STR_TO_DATE(csr.col_start_date, '%Y-%m-%d') AND STR_TO_DATE(csr.col_end_date, '%Y-%m-%d'))
                    OR (CURDATE() >= STR_TO_DATE(csr.col_start_date, '%Y-%m-%d') AND csr.col_end_date = 'TFN')
                )
            WHERE mr.col_run_name = '$txtRunName' 
              AND mr.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
              AND cc.col_client_Id IS NULL 
              AND csr.col_client_Id IS NULL 
            ORDER BY mr.dateTime_in ASC
        ");

        if (!$sel_dist_attr) {
            die("Query Failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($sel_dist_attr) > 0) {
            while ($row = mysqli_fetch_assoc($sel_dist_attr)) {
                $uryyToeSS4 = htmlspecialchars($row['uryyToeSS4'], ENT_QUOTES, 'UTF-8');
                $care_calls = htmlspecialchars($row['care_calls'], ENT_QUOTES, 'UTF-8');

                $todayDay = date("l", strtotime($txtShiftDate));
                if ($txtRotaDateInDay == $todayDay) {
                    $CopyClient_timeDetail = mysqli_query($conn, "
    INSERT INTO tbl_schedule_calls (
        client_name, client_area, col_area_city, col_area_Id, 
        uryyToeSS4, first_carer, first_carer_Id, care_calls, dateTime_in, dateTime_out, 
        col_run_name, col_required_carers, Clientshift_Date, timeline_colour, 
        col_visitColor_code, mileage_rate, call_status, bgChange, col_period_one, col_period_two, 
        pay_rate, client_rate, checkin_type, col_company_Id
    )
    SELECT 
        client_name, 
        client_area, 
        col_client_city, 
        run_area_nameId, 
        uryyToeSS4, 
        '$txtFirstCarer' AS first_carer, 
        '$txtFirstCarerId' AS first_carer_id, 
        care_calls, 
        dateTime_in, 
        dateTime_out, 
        col_run_name, 
        col_required_carers, 
        '$txtShiftDate' AS shift_date, 
        '$timelineColour' AS timeline_colour, 
        '$txtVisitColorCode' AS visit_color_code, 
        '$txtMileage' AS mileage_rate, 
        '$status' AS status, 
        '$bgChange' AS bg_change, 
        col_period_one, 
        col_period_two, 
        '$txtPayRate' AS pay_carer, 
        col_funding_rate,
        checkin_type,
        col_company_Id
    FROM tbl_manage_runs
    WHERE col_run_name = '$txtRunName' 
      AND uryyToeSS4 = '$uryyToeSS4' 
      AND care_calls = '$care_calls' 
      AND (
            col_monday    = '$txtRotaDateInDay' OR
            col_tuesday   = '$txtRotaDateInDay' OR
            col_wednesday = '$txtRotaDateInDay' OR
            col_thursday  = '$txtRotaDateInDay' OR
            col_friday    = '$txtRotaDateInDay' OR
            col_saturday  = '$txtRotaDateInDay' OR
            col_sunday    = '$txtRotaDateInDay'
          )
");


                    if (!$CopyClient_timeDetail) {
                        echo "Error inserting record: " . mysqli_error($conn);
                    }
                }
            }
            // Redirect after loop
            header("Location: ./roster/schedule-visits?txtDate=$txtShiftDate");
            exit();
        } else {
            echo "<p>No visits found for this run today.</p>";
        }
    }
}
