<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnshareAccessCode'])) {
    require_once 'dbconnections.php';

    if (!isset($conn)) {
        http_response_code(500);
        exit('Database connection is not established.');
    }

    // Sanitize and validate inputs
    $recipientEmailsRaw = trim($_POST['txtRecipient_Email'] ?? '');
    $shareCode = trim($_POST['txtSharCode'] ?? '');
    $inviteeEmail = trim($_POST['txtInviteeEmail'] ?? '');
    $shareUrl = trim($_POST['txtShareUrl'] ?? '');
    $companySpecialId = trim($_POST['txtCompanySpecialId'] ?? '');

    // Basic validation
    if (empty($recipientEmailsRaw) || empty($shareCode) || empty($inviteeEmail) || empty($shareUrl) || empty($companySpecialId)) {
        http_response_code(400);
        exit('All fields are required.');
    }

    // Validate share URL
    if (!filter_var($shareUrl, FILTER_VALIDATE_URL)) {
        http_response_code(400);
        exit('Invalid Share URL.');
    }

    // Process recipient emails: explode by comma, trim, validate each
    $recipientEmails = array_filter(array_map('trim', explode(',', $recipientEmailsRaw)), function ($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    });

    if (empty($recipientEmails)) {
        http_response_code(400);
        exit('No valid recipient email addresses provided.');
    }

    // Prepare email headers
    $fromEmail = 'it@stafflinks.co.uk';
    $subject = 'Access activities';

    $headers = [];
    $headers[] = "From: StaffLinks <{$fromEmail}>";
    $headers[] = "Reply-To: {$fromEmail}";
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=UTF-8";
    $headersString = implode("\r\n", $headers);

    // Build polished HTML email content with inline CSS for better email client compatibility
    $currentYear = date('Y');
    $htmlMessage = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Access Care Plan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            background-color: #ffffff;
            padding: 30px 40px;
            max-width: 600px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .content h3 {
            color: #27ae60;
            margin-bottom: 15px;
        }
        .share-code {
            font-size: 20px;
            font-weight: 700;
            color: #34495e;
            margin-bottom: 10px;
        }
        .link {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 24px;
            background-color: #27ae60;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 600;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .link:hover {
            background-color: #1e8449;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
            padding: 20px;
            margin-top: 30px;
            border-top: 1px solid #ecf0f1;
        }
    </style>
</head>
<body>
    <div class="header">Access Care Calls</div>
    <div class="content">
        <h3>Access Link</h3>
        <div class="share-code">{$shareCode}</div>
        <a href="{$shareUrl}" class="link" target="_blank" rel="noopener noreferrer">View Care Details</a>
    </div>
    <div class="footer">
        Care Access &copy; {$currentYear} StaffLinks LTD. All rights reserved.
    </div>
</body>
</html>
HTML;

    $allEmailsSent = true;

    foreach ($recipientEmails as $recipient) {
        if (!mail($recipient, $subject, $htmlMessage, $headersString)) {
            $allEmailsSent = false;
            error_log("Failed to send email to: $recipient");
        }
    }

    if ($allEmailsSent) {
        header('Location: successful.php');
        exit;
    } else {
        http_response_code(500);
        echo 'Some emails could not be sent. Please try again later.';
        exit;
    }
} else {
    http_response_code(400);
    echo 'Invalid request method.';
    exit;
}
