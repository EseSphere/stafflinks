<?php


if (isset($_POST['btnAddCerts'])) {

    $target = "Certificates/" . basename($_FILES['file']['name']);

    $txtAddNewCertName = mysqli_real_escape_string($conn, $_REQUEST['txtAddNewCertName']);
    $txtDateExpire = mysqli_real_escape_string($conn, $_REQUEST['txtDateExpire']);
    $txtDateUploaded = mysqli_real_escape_string($conn, $_REQUEST['txtDateUploaded']);
    $certfile =  mysqli_real_escape_string($conn, $_FILES['file']['name']);
    $txtCarerId = mysqli_real_escape_string($conn, $_REQUEST['txtCarerId']);


    $myCheck = "SELECT * FROM team_certificates WHERE cert_name = '" . $txtAddNewCertName . "' AND uryyTteamoeSS4 = '" . $txtCarerId . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {

        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";

        unset($txtAddNewCertName);
        unset($txtDateExpire);
        unset($certfile);
        unset($txtCarerId);
    } else {

        $queryIns = mysqli_query($conn, "INSERT INTO tbl_team_certificates (cert_name, cert_expire, dateUpload, cert_file, uryyTteamoeSS4) VALUES('" . $txtAddNewCertName . "', '" . $txtDateExpire . "', '" . $txtDateUploaded . "', '" . $certfile . "', '" . $txtCarerId . "') ");

        if (is_uploaded_file($_FILES['file']['tmp_name']) and copy($_FILES['file']['tmp_name'], $target)) {
            header("Location: ./add-carer-certificates?uryyTteamoeSS4=$txtCarerId");
        } else {
            echo "ERROR: Could not able to execute $conn. " . mysqli_error($conn);
        }
    }
}
