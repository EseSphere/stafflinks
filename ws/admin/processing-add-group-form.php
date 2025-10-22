<?php


if (isset($_POST['btnSubmitGroup'])) {

    include('dbconnections.php');

    $txtGroupArea = mysqli_real_escape_string($conn, $_REQUEST['txtGroupArea']);
    $txtGroupCity = mysqli_real_escape_string($conn, $_REQUEST['txtGroupCity']);

    $myCheck = "SELECT * FROM tbl_task_list WHERE task_title = '" . $txtGroupArea . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";

        unset($txtGroupArea);
        unset($txtGroupCity);
    } else {

        $queryIns = mysqli_query($conn, "INSERT INTO tbl_group_list (group_area, group_city) VALUES('" . $txtGroupArea . "', '" . $txtGroupCity . "') ");

        if ($queryIns) {
            header("Location: ./auth-client-group");
        } else {
            echo "ERROR: Could not able to execute $con. " . mysqli_error($conn);
        }
    }
}
