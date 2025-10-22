<?php
include_once("./dbconnect.php");

$date = $_POST['date'];

$sel_dist_att = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls 
WHERE (Clientshift_Date = '$date' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' 
AND col_area_city = '" . $_COOKIE["companyCity"] . "') GROUP BY first_carer ");
$data = [];
while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
    $db_worker_Id = $att_rw['first_carer_Id'];

    $sel_corr_data = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls 
    WHERE (Clientshift_Date = '$date' AND first_carer_Id = '$db_worker_Id' AND rightTo_display = 'True' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    while ($att_cor_rw = mysqli_fetch_array($sel_corr_data)) {
        $data[] = [
            'title' => $att_cor_rw['client_name'],
            'calendar' => $att_cor_rw['Clientshift_Date'],
            'location' => $att_cor_rw['client_area'] . " " . $att_cor_rw['col_area_city'],
            'resource' => [$att_cor_rw['team_resource']],
            'color' => $att_cor_rw['timeline_colour'],
            'myUserId' => $att_cor_rw['userId'],
            'firstCarer' => $att_cor_rw['first_carer'],
            'Status' => $att_cor_rw['call_status'] . ' | ' . $att_cor_rw['care_calls'] . ' Call',
            'start' => $att_cor_rw['Clientshift_Date'] . 'T' . $att_cor_rw['dateTime_in'],
            'end' => $att_cor_rw['Clientshift_Date'] . 'T' . $att_cor_rw['dateTime_out']
        ];
    }
}

echo json_encode($data);
