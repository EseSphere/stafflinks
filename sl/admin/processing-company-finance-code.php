<?php
include('dbconnections.php');

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['btnshareAccessCode'])) {

    $txtRecipient_Email = mysqli_real_escape_string($conn, $_REQUEST['txtRecipient_Email']);
    $txtRecipient_Email = strip_tags($txtRecipient_Email);
    $txtRecipient_Email = htmlspecialchars($txtRecipient_Email);

    $txtShareCode = mysqli_real_escape_string($conn, $_REQUEST['txtShareCode']);
    $txtShareCode = strip_tags($txtShareCode);
    $txtShareCode = htmlspecialchars($txtShareCode);

    $txtInviteeEmail = mysqli_real_escape_string($conn, $_REQUEST['txtInviteeEmail']);
    $txtInviteeEmail = strip_tags($txtInviteeEmail);
    $txtInviteeEmail = htmlspecialchars($txtInviteeEmail);

    $txtShareUrl = mysqli_real_escape_string($conn, $_REQUEST['txtShareUrl']);
    $txtShareUrl = strip_tags($txtShareUrl);
    $txtShareUrl = htmlspecialchars($txtShareUrl);

    $email_to = "" . $txtRecipient_Email;
    $subject = "Share Access";
    $headers = "From: " . $txtInviteeEmail;
    $headers = "MIME-Version: 1.0\r\n";
    $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "

      <html>
      <body>
        <div style='width: 100%; height: auto;>
            <div style='width: 700px; height: 200px; text-align:center; color:white; padding: 23px; background-color:#c0392b; font-size:20px;'>
                " . $txtShareCode . "
                <br>
                " . $txtShareUrl . "
            </div>
        </div>
    
       
      </body>
      </html>

";

    mail($email_to, $subject, $message, $headers);
    header("Location: ./dashboard");
} else {
}
