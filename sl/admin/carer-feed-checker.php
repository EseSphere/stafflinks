<?php
include('team-header-contents.php');

if (isset($_GET['uryyTteamoeSS4'])) {
    $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];

    $myCheck = "SELECT * FROM tbl_schedule_calls WHERE first_carer_Id = '$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
    $myCheckres = mysqli_query($conn, $myCheck);
    while ($rows = mysqli_fetch_array($myCheckres)) {
        $holdFirstCarerId = $rows['first_carer_Id'];
        $holdSecondCarerId = $rows['second_carer_Id'];

        if ($holdFirstCarerId != 0) {
            header("Location: ./carer-feeds?first_carer_Id=$uryyTteamoeSS4");
        } else if ($holdSecondCarerId != 0) {
            header("Location: ./carer-feeds?second_carer_Id=$uryyTteamoeSS4");
        } else if ($holdFirstCarerId = ' ') {
            header("Location: ./carer-feed-empty?first_carer_Id=$uryyTteamoeSS4");
        } else if ($holdSecondCarerId = ' ') {
            header("Location: ./carer-feed-empty?second_carer_Id=$uryyTteamoeSS4");
        }
    }
}


include('footer-contents.php');
