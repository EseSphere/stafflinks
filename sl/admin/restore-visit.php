<?php
include('dbconnections.php');

if (isset($_GET['uryyToeSS4'], $_GET['name'], $_GET['date'], $_GET['visit'])) {
    $clientSpecId = $_GET["uryyToeSS4"];
    $runId = $_GET['name'];
    $shiftDate = $_GET['date'];
    $visit = $_GET['visit'];
    // Perform DELETE instead of UPDATE
    $deleteRun = mysqli_query($conn, "DELETE FROM tbl_cancelled_call 
    WHERE col_client_Id = '$clientSpecId' AND col_date = '$shiftDate' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
    if ($deleteRun) {
        $query = mysqli_query($conn, "UPDATE tbl_schedule_calls SET call_status = 'Scheduled'
        WHERE uryyToeSS4 = '$clientSpecId' AND Clientshift_Date = '$shiftDate' 
        AND care_calls = '$visit' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
        if ($query) {
            header("Location: ./roster/schedule-visits");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
