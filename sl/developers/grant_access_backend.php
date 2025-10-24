<?php
include('dbconnections.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$error = false;
if (isset($_POST['btnAccessurlform'])) {
  $email = mysqli_real_escape_string($conn, $_REQUEST['myEmail']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  $fullName = mysqli_real_escape_string($conn, $_REQUEST['fullName']);
  $fullName = strip_tags($fullName);
  $fullName = htmlspecialchars($fullName);
  $pass = mysqli_real_escape_string($conn, $_REQUEST['myPassword']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  $myPass = hash('sha256', $pass);
  $txtFinanceAccess = 'Granted';
  $txtAdminAccess = 'Granted';

  function generateFormattedId()
  {
    $randomNumber = rand(100000, 999999);
    $prefix = 'GE' . $randomNumber;
    $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 3);
    $randomNum = rand(10000, 99009);
    return $prefix . '-' . $randomChars . $randomNum . '-' . uniqid();
  }
  $varCompanyId = generateFormattedId();

  // Generate unique IDs
  function generateUUIDv4()
  {
    $data = random_bytes(16);
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
    return strtoupper(bin2hex(substr($data, 0, 4)) . '-' .
      bin2hex(substr($data, 4, 2)) . '-' .
      bin2hex(substr($data, 6, 2)) . '-' .
      bin2hex(substr($data, 8, 2)) . '-' .
      bin2hex(substr($data, 10, 6)));
  }

  $url = 'xL4-' . generateUUIDv4();

  $myCheck = "SELECT * FROM tbl_admin WHERE user_email_address = '" . $email . "'";
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
    $queryIns = mysqli_query($conn, "INSERT INTO tbl_admin (user_email_address,company_name,user_password,finance_access,admin_access,col_company_Id) 
      VALUES('" . $email . "', '" . $fullName . "', '" . $myPass . "', '" . $txtFinanceAccess . "', '" . $txtAdminAccess . "', '" . $varCompanyId . "')");
    if ($queryIns) {
      $mail = new PHPMailer(true);
      try {
        $mail->isSMTP();
        $mail->Host = 'premium156.web-hosting.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'it@stafflinks.co.uk';
        $mail->Password = 'StaffLinks@121!';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('it@stafflinks.co.uk', 'StaffLinks');
        $mail->addAddress($email);
        $mail->addReplyTo('it@stafflinks.co.uk');

        $mail->addCustomHeader('Precedence', 'bulk');
        $mail->addCustomHeader('X-Mailer', 'PHPMailer');
        $mail->addCustomHeader('List-Unsubscribe', '<mailto:unsubscribe@stafflinks.co.uk>');

        $mail->Subject = 'StaffLinks Verification Code';
        $mail->isHTML(true);
        $mail->Body = "
                <!DOCTYPE html>
                <html>
                <head>
                  <meta charset='UTF-8'>
                  <title>Welcome Email</title>
                  <style>
                    body {
                      font-family: Arial, sans-serif;
                      background-color: #f9f9f9;
                      color: #333333;
                      padding: 20px;
                      text-align: left;
                    }
                    .container {
                      max-width: 600px;
                      margin: auto;
                      background-color: #ffffff;
                      border-radius: 8px;
                      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                      padding: 30px;
                      text-align: left;
                    }
                    .button {
                      display: inline-block;
                      padding: 12px 20px;
                      margin-top: 20px;
                      background-color: #007BFF;
                      color: white;
                      text-decoration: none;
                      border-radius: 5px;
                    }
                    .footer {
                      margin-top: 30px;
                      font-size: 12px;
                      color: #777777;
                    }
                  </style>
                </head>
                <body>
                  <div class='container'>
                    <h2>Welcome to the Team!</h2>
                    <p>Dear User,</p>
                    <p>Thank you for registering with us. We’re excited to have you on board and look forward to supporting your operations with smooth and efficient service.</p>
                    <p><a href='https://admin.stafflinks.co.uk/signup?email=$email&url=$url' class='button'>Login to Control Panel</a></p>
                    <p>If you did not request this link or registration, please disregard this message.</p>              
                    <p class='footer'>Best regards,<br>StaffLinks Team</p>
                  </div>
                </body>
                </html>
                ";
        $mail->AltBody = "StaffLinks Limited";
        if ($mail->send()) {
          header("Location: ./index");
          exit();
        }
      } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
      }
    } else {
      echo "ERROR: Could not able to execute. " . mysqli_error($conn);
    }
  }
}
