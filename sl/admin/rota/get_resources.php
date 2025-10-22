<?php
header('Content-Type: application/json');

$sel_dist_att = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls 
                WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "' AND col_area_city = '" . $_COOKIE["companyCity"] . "') 
                GROUP BY first_carer ");
while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
    $db_worker_name = $att_rw['first_carer'];
    echo "
                    {
                        id: '" . $att_rw["team_resource"] . "',
                        name: '" . $att_rw['first_carer'] . "'
                    },
                ";
}

echo json_encode($resources);
