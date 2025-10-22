<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Collect POST data
$emailsInput = $_POST['emails'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if (!$emailsInput || !$subject || !$message) {
    echo "Emails, subject, and message are required!";
    exit;
}

// Split and validate emails
$emailsArray = preg_split('/[\s,]+/', $emailsInput);
$emailsArray = array_filter(array_unique($emailsArray));

$validEmails = [];
foreach ($emailsArray as $email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validEmails[] = $email;
    }
}

if (empty($validEmails)) {
    echo "No valid email addresses found!";
    exit;
}

// HTML email template
$htmlMessage = "
<html>
<head>
<meta charset='UTF-8'>
<title>" . htmlspecialchars($subject) . "</title>
</head>
<body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
<div style='max-width:600px;margin:auto;background:#fff;padding:20px;border-radius:8px;'>
<h2 style='color:#007bff;'>" . htmlspecialchars($subject) . "</h2>
<p>" . nl2br(htmlspecialchars($message)) . "</p>
<hr>
<p style='font-size:12px;color:#555;'>&copy; " . date('Y') . " GeoSoft Care</p>
</div>
</body>
</html>
";

// Plain text fallback
$plainMessage = strip_tags($message);

// SMTP configuration
$smtpHost = 'premium231.web-hosting.com';
$smtpUsername = 'it@geosoftcare.co.uk';
$smtpPassword = 'GeosoftIt@121!';
$smtpPort = 587; // TLS
$smtpSecure = 'tls';

$success = 0;

foreach ($validEmails as $email) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port = $smtpPort;

        // Important headers for inbox delivery
        $mail->setFrom($smtpUsername, 'GeoSoft Care');
        $mail->addReplyTo($smtpUsername, 'GeoSoft Care');
        $mail->Sender = $smtpUsername; // Return-path

        // Recipient
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $htmlMessage;
        $mail->AltBody = $plainMessage;

        $mail->send();
        $success++;
    } catch (Exception $e) {
        // Optional: log the error
        echo "Mailer Error ({$email}): " . $mail->ErrorInfo . "<br>";
    }
}

// Success message
echo "Emails successfully sent to $success out of " . count($validEmails);
