<?php
include('db-connect.php');

if (isset($_POST['btnSubmitVerifyform'])) {

    $verificationTXT = mysqli_real_escape_string($conn, $_POST['verificationTXT']);

    $myCheck = "SELECT * FROM tbl_admin WHERE verification_code = '" . $verificationTXT . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        $UpdateVerisql = mysqli_query($conn, "UPDATE `tbl_admin` SET `status` = 'Verified' WHERE verification_code = '$verificationTXT' ");
        if ($UpdateVerisql) {
            header("Location: ./index");
        }
    } else {
        echo "
    <script type='text/javascript'>
		$(document).ready(function() {
			$('#popupAlert').show();
		});
	</script>";
    }
}
