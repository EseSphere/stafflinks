<?php
include('db-connect.php');

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['btnSubmitform'])) {

  $fullName = mysqli_real_escape_string($conn, $_REQUEST['fullName']);
  $fullName = strip_tags($fullName);
  $fullName = htmlspecialchars($fullName);

  $email = mysqli_real_escape_string($conn, $_REQUEST['myEmail']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $CompanyName = mysqli_real_escape_string($conn, $_REQUEST['txtSelectCompany']);
  $CompanyName = strip_tags($CompanyName);
  $CompanyName = htmlspecialchars($CompanyName);

  $pass = mysqli_real_escape_string($conn, $_REQUEST['myPassword']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  $currentDate = mysqli_real_escape_string($conn, $_REQUEST['currentDate']);
  $currentTime = mysqli_real_escape_string($conn, $_REQUEST['currentTime']);
  $myId = mysqli_real_escape_string($conn, $_REQUEST['mysocialId']);
  $verifcationCode = 'Not Verified';
  $btnDeactivate = '0';
  $btnActivate = 'disabled';

  $myPass = hash('sha256', $pass);
  $myIdentity = hash('sha256', $myId);

  $txtmyCity = mysqli_real_escape_string($conn, $_REQUEST['txtmyCity']);
  $txtIpAddress = mysqli_real_escape_string($conn, $_REQUEST['txtIpAddress']);
  $txtmyCountry = mysqli_real_escape_string($conn, $_REQUEST['txtmyCountry']);

  $txtFinanceStatus = 'Restricted';
  $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

  $myCheck = "SELECT * FROM tbl_goesoft_users WHERE user_email_address = '" . $email . "'";
  $myCheckres = mysqli_query($conn, $myCheck);
  $countRes = mysqli_num_rows($myCheckres);

  if ($countRes != 0) {
    echo "
    <script type='text/javascript'>
		$(document).ready(function() {
			$('#popupAlert').show();
		});
	</script>";
  } else {
    //name can contain only alpha characters and space
    $queryIns = mysqli_query($conn, "INSERT INTO tbl_goesoft_users (user_fullname,user_email_address,company_name,user_password,date_registered,time_registered,
    user_special_Id,verification_code,VNumber,status1,status2,myviewArea,client_view,team_view,my_city,my_ip,my_country,finance_access,col_company_Id) 
    VALUES('" . $fullName . "', '" . $email . "', '" . $CompanyName . "', '" . $myPass . "', '" . $currentDate . "', '" . $currentTime . "', '" . $myIdentity . "', 
    '" . $verifcationCode . "', '" . $myId . "', '" . $btnDeactivate . "', '" . $btnActivate . "', 'General', '" . $txtmyCity . "', '" . $txtmyCity . "', 
    '" . $txtmyCity . "', '" . $txtIpAddress . "', '" . $txtmyCountry . "', '" . $txtFinanceStatus . "', '" . $txtCompanyId . "')");

    if ($queryIns) {

      $email_to = "" . $email;
      $subject = "Verify your email";

      $headers = "From: it@stafflinks.co.uk";
      $headers = "MIME-Version: 1.0\r\n";
      $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $message = "

      <html>
      <body>
        <div style='width: 100%; height: auto;>
        <div style='width: 700px; height: 200px; text-align:center; color:white; padding: 23px; background-color:#c0392b; font-size:20px;'>
            <h2>Thank you for joining us.</h2>
            <br>
            <span style='font-size:20px;'>We work to give you a more better service. Kindly enter the verification code given below to verify your email.</span>
        </div>
          <div style='width:100%; height:auto; padding:22px; font-size: 20px;'>
            <h1>" . $myId . "</h1>
            https://admin.stafflinks.co.uk/verify-your-email
          </div>
        </div>
    
       
      </body>
      </html>

";

      mail($email_to, $subject, $message, $headers);
      header("Location: ./verify-your-email");
    } else {
      echo "ERROR: Could not able to execute. " . mysqli_error($con);
    }
  }
}
