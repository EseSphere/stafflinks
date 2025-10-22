<?php

if (isset($_POST['btnChangeCarer'])) {
    include('dbconnections.php');

    $clientSpecialId = mysqli_real_escape_string($conn, $_POST['clientSpecialId']);
    $txtCarerResource = mysqli_real_escape_string($conn, $_POST['txtCarerResource']);
    $txtFirstCarer = mysqli_real_escape_string($conn, $_POST['txtFirstCarer']);
    $txtCarerSpecialId = mysqli_real_escape_string($conn, $_POST['txtCarerSpecialId']);
    $txtTimelineColor = mysqli_real_escape_string($conn, $_POST['txtTimelineColor']);
    $txtCallStatus = mysqli_real_escape_string($conn, $_POST['txtCallStatus']);
    $txtBgColor = mysqli_real_escape_string($conn, $_POST['txtBgColor']);
    $textCareCallType = mysqli_real_escape_string($conn, $_POST['textCareCallType']);
    $textCareCallDate = mysqli_real_escape_string($conn, $_POST['textCareCallDate']);

    $usuryIYTj = hash('SHA256', $clientSpecialId);

    $myCheck = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE (first_carer_Id = '$txtCarerSpecialId' AND Clientshift_Date = '$textCareCallDate' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    $display_row_areaId = mysqli_fetch_array($myCheck, MYSQLI_ASSOC);
    $txtColAreaId = $display_row_areaId['col_area_Id'];
    $countRes = mysqli_num_rows($myCheck);
    if ($countRes != 0) {
        $update_care_call_status = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `col_area_Id` = '$txtColAreaId', `first_carer` = '$txtFirstCarer', `first_carer_Id` = '$txtCarerSpecialId', `team_resource` = '$txtCarerResource', `timeline_colour` = '$txtTimelineColor', `call_status` = '$txtCallStatus', `bgChange` = '$txtBgColor' 
        WHERE (userId = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
        if ($update_care_call_status) {
            header("Location: ./care-call-details?userId=$clientSpecialId");
        }
    } else {
        $update_care_call_status = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer` = '$txtFirstCarer', `first_carer_Id` = '$txtCarerSpecialId', `team_resource` = '$txtCarerResource', `timeline_colour` = '$txtTimelineColor', `call_status` = '$txtCallStatus', `bgChange` = '$txtBgColor' 
        WHERE (userId = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
        if ($update_care_call_status) {
            header("Location: ./care-call-details?userId=$clientSpecialId");
        }
    }
}
