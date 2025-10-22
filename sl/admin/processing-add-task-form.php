<?php


if (isset($_POST['btnSubmitTask'])) {

    include('dbconnections.php');

    $txtTaskTitle = mysqli_real_escape_string($conn, $_REQUEST['txtTaskTitle']);
    $txtTaskCategories = mysqli_real_escape_string($conn, $_REQUEST['txtTaskCategories']);

    $myCheck = "SELECT * FROM tbl_task_list WHERE task_title = '" . $txtTaskTitle . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";

        unset($txtTaskTitle);
        unset($txtTaskCategories);
    } else {

        $queryIns = mysqli_query($conn, "INSERT INTO tbl_task_list (task_title, task_category) VALUES('" . $txtTaskTitle . "', '" . $txtTaskCategories . "') ");

        if ($queryIns) {
            header("Location: ./auth-client-task");
        } else {
            echo "ERROR: Could not able to execute $con. " . mysqli_error($conn);
        }
    }
}
