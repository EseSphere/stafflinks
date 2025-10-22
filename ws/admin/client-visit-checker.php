
<?php

include('client-header-contents.php');

if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];

    $myCheck = "SELECT * FROM tbl_schedule_calls WHERE uryyToeSS4 = '" . $uryyToeSS4 . "'";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        header("Location: ./client-visit?uryyToeSS4=$uryyToeSS4 ");
    } else {

        header("Location: ./client-visit-empty?uryyToeSS4=$uryyToeSS4 ");
    }
}

include('footer-contents.php');
