<?php
//export.php 
if (isset($_POST["export"])) {
    include('dbconnections.php');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('First Name', 'Last Name', 'Nationality', 'City', 'Post Code', 'Gender', 'DBS', 'NIN', 'Transportation'));

    foreach ($_POST["txtSelectedId"] as $selectedbox) {
        $query = "SELECT team_first_name, team_last_name, team_nationality, team_city, team_poster_code, client_sexuality, team_dbs, team_nin, transportation from tbl_general_team_form WHERE userId = '$selectedbox' ORDER BY userId ";
        $result = mysqli_query($conn, $query);
        $display = mysqli_fetch_assoc($result);
        fputcsv($output, $display);
    }
}
fclose($output);
