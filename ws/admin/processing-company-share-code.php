<?php
// Include PHPMailer standalone files
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('dbconnections.php');

if (isset($_POST['btnshareAccessCode'])) {
  $txtRecipient_Email = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_REQUEST['txtRecipient_Email'])));
  $txtShareCode = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_REQUEST['txtShareCode'])));
  $txtShareUrl = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_REQUEST['txtShareUrl'])));
  $txtCompanySpecialId = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_REQUEST['txtCompanySpecialId'])));

  // Allow multiple emails separated by comma
  $recipient_emails = explode(',', $txtRecipient_Email);

  $subject = "Geosoft Share Access";
  $sender_email = "admin@geocareservices.co.uk"; // Original email you want visible in the email body

  // HTML message body
  $message = "
    <html>
      <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
      </head>
      <body style='margin:0; padding:0; font-family:Arial, sans-serif; background-color:#f9f9f9;'>
        <div style='width:100%; padding:20px;'>
          <div style='max-width:700px; margin:0 auto; background-color:#ffffff; border:1px solid #ddd; border-radius:6px; overflow:hidden;'>
            <div style='background-color:#2980b9; color:#ffffff; text-align:center; padding:30px 20px; font-size:22px; font-weight:bold;'>
              Access Code: $txtShareCode
            </div>
            <div style='padding:20px; font-size:16px; color:#333333; text-align:center;'>
              <p>You can access the shared resource by clicking the button below:</p>
              <a href='$txtShareUrl' style='display:inline-block; padding:12px 25px; background-color:#2980b9; color:#ffffff; text-decoration:none; font-weight:bold; border-radius:4px; margin-top:10px;'>Access Now</a>
              <p style='margin-top:30px; font-size:14px; color:#555555;'>Sent by: $sender_email</p>
            </div>
          </div>
        </div>
      </body>
    </html>
    ";

  $mail = new PHPMailer(true);
  try {
    // SMTP settings (replace with your SMTP credentials)
    $mail->isSMTP();
    $mail->Host = 'premium231.web-hosting.com'; // e.g., smtp.gmail.com
    $mail->SMTPAuth = true;
    $mail->Username = 'geosoftcare@geosoftcare.co.uk'; // SMTP account email
    $mail->Password = 'Geosoftcare@121!'; // SMTP password
    $mail->SMTPSecure = 'tls'; // or 'ssl'
    $mail->Port = 587; // 465 for SSL

    $mail->setFrom('geosoftcare@geosoftcare.co.uk', 'Geosoft Services'); // Must match SMTP
    $mail->addReplyTo($sender_email, 'Geosoft Admin'); // Replies go here
    $mail->Subject = $subject;
    $mail->isHTML(true);
    $mail->Body = $message;

    // Send to each recipient individually
    foreach ($recipient_emails as $email_to) {
      $email_to = trim($email_to);
      if (!empty($email_to) && filter_var($email_to, FILTER_VALIDATE_EMAIL)) {
        $mail->clearAddresses(); // Clear previous recipient
        $mail->addAddress($email_to);
        $mail->send();
      }
    }

    // Redirect after sending
    header("Location: ./share-access-code?col_company_Id=$txtCompanySpecialId");
    exit();
  } catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  }
}
