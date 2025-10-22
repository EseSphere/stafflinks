<?php
include('dbconnections.php');

if (isset($_GET['uryyToeSS4'], $_GET['run'], $_GET['date'], $_GET['carer'])) {
    $clientSpecId = $_GET["uryyToeSS4"];
    $runId = $_GET['run'];
    $shiftDate = $_GET['date'];
    $shiftCarer = $_GET['carer'];

    // Perform DELETE instead of UPDATE
    $deleteRun = mysqli_query($conn, "
        DELETE FROM tbl_schedule_calls 
        WHERE col_area_Id = '$runId' 
        AND Clientshift_Date = '$shiftDate' 
        AND col_company_Id = '" . $_SESSION['usr_compId'] . "'
    ");

    if ($deleteRun) {
        header("Location: ./roster/schedule-visits");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
