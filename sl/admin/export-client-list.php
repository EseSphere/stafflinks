<?php
//export.php 
if (isset($_POST["export"])) {
    include('dbconnections.php');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('First Name', 'Last Name', 'Type of Service', 'Group', 'City', 'Post Code', 'Gender', 'Date Start'));

    foreach ($_POST["txtSelectedId"] as $selectedbox) {
        $query = "SELECT client_first_name, client_last_name, client_service, client_area, client_city, client_poster_code, client_sexuality, clientStart_date from tbl_general_client_form WHERE userId = '$selectedbox' ORDER BY userId ";
        $result = mysqli_query($conn, $query);
        $display = mysqli_fetch_assoc($result);
        fputcsv($output, $display);
    }
}
fclose($output);
