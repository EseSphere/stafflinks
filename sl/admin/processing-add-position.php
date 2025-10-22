<?php


if (isset($_POST['btnSubmitPosition'])) {

    include('dbconnections.php');

    $txtPositionName = mysqli_real_escape_string($conn, $_REQUEST['txtPositionName']);
    $txtPositionDetails = mysqli_real_escape_string($conn, $_REQUEST['txtPositionDetails']);

    $myCheck = "SELECT * FROM tbl_task_list WHERE task_title = '" . $txtPositionName . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";

        unset($txtPositionName);
        unset($txtPositionDetails);
    } else {

        $queryIns = mysqli_query($conn, "INSERT INTO tbl_position (position_name, position_details) VALUES('" . $txtPositionName . "', '" . $txtPositionDetails . "') ");

        if ($queryIns) {
            header("Location: ./auth-position");
        } else {
            echo "ERROR: Could not able to execute $con. " . mysqli_error($conn);
        }
    }
}
