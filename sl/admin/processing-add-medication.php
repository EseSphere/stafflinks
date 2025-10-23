<?php
include('dbconnections.php');

if (isset($_POST['btnSubmitNewMed'])) {

    $txtMedName = mysqli_real_escape_string($conn, $_REQUEST['txtMedName']);
    $txtMedDosage = mysqli_real_escape_string($conn, $_REQUEST['txtMedDosage']);
    $txtMedType = mysqli_real_escape_string($conn, $_REQUEST['txtMedType']);

    $myCheck = "SELECT * FROM tbl_task_list WHERE task_title = '" . $txtMedName . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);
    if ($countRes != 0) {
        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";
        unset($txtMedName);
        unset($txtMedDosage);
        unset($txtMedType);
    } else {

        $queryIns = mysqli_query($conn, "INSERT INTO tbl_medication_list (med_name, med_dosage, med_type) VALUES('" . $txtMedName . "', '" . $txtMedDosage . "', '" . $txtMedType . "') ");

        if ($queryIns) {
            header("Location: ./auth-new-medication");
        } else {
            echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
        }
    }
}
