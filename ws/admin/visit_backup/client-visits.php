
<?php
include('dbconnections.php');

if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];

    $myCheck = "SELECT * FROM tbl_schedule_calls WHERE (uryyToeSS4 = '$uryyToeSS4' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $_SESSION['newDate'] = $today;
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        header("Location: ./client-visit?uryyToeSS4=$uryyToeSS4 ");
    } else {
        header("Location: ./client-visit-empty?uryyToeSS4=$uryyToeSS4 ");
    }
}
include('footer-contents.php');
