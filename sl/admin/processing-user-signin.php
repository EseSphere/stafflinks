<?php
session_start();
include('db-connect.php');

$error = false;
$emailError = $passError = $loginError = "";

if (isset($_POST['btnSubmitform'])) {
  $email = trim($_POST['myEmail']);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $pass = trim($_POST['myPassword']);

  if (empty($email)) {
    $error = true;
    $emailError = "Please enter your email address.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a valid email address.";
  }

  if (empty($pass)) {
    $error = true;
    $passError = "Please enter your password.";
  }

  date_default_timezone_set('Europe/London');
  $currentDateTime = date('Y-m-d H:i');

  if (!$error) {
    $password = hash('sha256', $pass);
    $status = "Verified";
    $adminAccess = "Granted";

    // First, check if the email exists
    $stmt = $conn->prepare("SELECT * FROM tbl_goesoft_users WHERE user_email_address = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
      $loginError = "Email not found!";
    } else {
      $row = $res->fetch_assoc();

      // Check if verification and admin access match
      if ($row['status'] !== $status || $row['admin_access'] !== $adminAccess) {
        $loginError = "Access not granted or account not verified.";
      } elseif ($row['user_password'] !== $password) {
        $loginError = "Incorrect password!";
      } else {
        // Successful login
        session_regenerate_id(true);
        $_SESSION['usr_compId'] = $row['col_company_Id'];
        $_SESSION['usr_userName'] = $row['user_fullname'];
        $_SESSION['usr_compName'] = $row['company_name'];
        $_SESSION['usr_email'] = $row['user_email_address'];
        $_SESSION['usr_city'] = $row['my_city'];
        $_SESSION['usr_specId'] = $row['user_special_Id'];

        // Update last login
        $updateStmt = $conn->prepare("UPDATE tbl_goesoft_users SET last_login = ? WHERE user_email_address = ?");
        $updateStmt->bind_param("ss", $currentDateTime, $email);
        $updateStmt->execute();
        $updateStmt->close();

        header("Location: ./loading-dashboard");
        exit;
      }
    }
    $stmt->close();
  }
}
