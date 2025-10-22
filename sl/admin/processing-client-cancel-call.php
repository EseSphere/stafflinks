<?php

if (isset($_POST['btnCancelCareCall'])) {
    include('dbconnections.php');

    $clientSpecialId = mysqli_real_escape_string($conn, $_POST['clientSpecialId']);
    $txtClientCondition = mysqli_real_escape_string($conn, $_POST['txtClientCondition']);
    $careCallStatus = 'Cancelled';
    $careCallStatusColor = 'rgba(189, 195, 199,1.0)';

    $usuryIYTj = hash('SHA256', $clientSpecialId);

    $update_care_call_status = mysqli_query($conn, "UPDATE `tbl_schedule_calls` SET `first_carer` = '$careCallStatus', `first_carer_Id` = '$careCallStatus', `team_resource` = '$careCallStatus', `timeline_colour` = '$careCallStatusColor', `call_status` = '$careCallStatus', `bgChange` = '$careCallStatusColor' 
    WHERE userId = '$clientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
    if ($update_care_call_status) {
        header("Location: ./care-call-details?userId=$clientSpecialId");
    }
}
