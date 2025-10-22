<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Function to generate a unique specialId
function generateSpecialId($length = 8)
{
    return strtoupper(bin2hex(random_bytes($length / 2)));
}

if (isset($_POST['btnRegister'])) {
    // Handle form submission

    $fullName = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $baseId = generateSpecialId();
    $randomNumber = rand(100000, 999999);

    function generateFormattedId()
    {
        $prefix = 'GC';
        $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 3);
        $randomNum = rand(100, 999);
        return $prefix . '-' . $randomChars . $randomNum . '-' . uniqid();
    }

    $id = generateFormattedId();
    $specialId = $id . '-' . $baseId;

    $stmt = $conn->prepare("SELECT `email` FROM `tbl_users` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Email already exists. Please try again!";
    } else {
        $stmt = $conn->prepare("SELECT userId FROM `tbl_users` WHERE uYtey9U8 = ?");
        $stmt->bind_param("s", $specialId);
        $stmt->execute();
        $stmt->store_result();

        while ($stmt->num_rows > 0) {
            $specialId = generateSpecialId();
            $stmt->bind_param("s", $specialId);
            $stmt->execute();
            $stmt->store_result();
        }
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO `tbl_users` (`fullName`, `email`, `password`, `verific_code`, `uYtey9U8`) 
        VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $fullName, $email, $password, $randomNumber, $specialId);

        if ($stmt->execute()) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'premium156.web-hosting.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'it@geosoftcare.co.uk';
                $mail->Password = 'Geosoftcare!@121!';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                $mail->setFrom('it@geosoftcare.co.uk', 'Phare-X');
                $mail->addAddress($email);
                $mail->addReplyTo('it@geosoftcare.co.uk');

                $mail->addCustomHeader('Precedence', 'bulk');
                $mail->addCustomHeader('X-Mailer', 'PHPMailer');
                $mail->addCustomHeader('List-Unsubscribe', '<mailto:unsubscribe@geosoftcare.co.uk>');

                $mail->Subject = 'Your Verification Code';
                $mail->isHTML(true);
                $mail->Body = "
                    <html>
                    <body>
                        <p>Dear User,</p>
                        <p>Your verification code is: <strong>$randomNumber</strong></p>
                        <p>Please enter this code to complete your registration.</p>
                        <p>If you did not request this code, please ignore this message.</p>
                        <br><br>
                        <p>Best regards,</p>
                        <p>Geosoft Care</p>
                    </body>
                    </html>";
                $mail->AltBody = "Your verification code is: $randomNumber";

                if ($mail->send()) {
                    header("Location: ./verify-account");
                    exit();
                }
            } catch (Exception $e) {
                error_log("Mail Error: " . $mail->ErrorInfo);
            }
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
