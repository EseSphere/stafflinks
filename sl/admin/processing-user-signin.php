<?php
session_start();
include('db-connect.php');

$loginError = $emailError = $passError = "";

if (isset($_POST['btnLogin'])) {
  $error = false;

  $email = trim($_POST['myEmail']);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $pass = trim($_POST['myPassword']);

  // Validate email
  if (empty($email)) {
    $error = true;
    $emailError = "Please enter your email address.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a valid email address.";
  }

  // Validate password
  if (empty($pass)) {
    $error = true;
    $passError = "Please enter your password.";
  }

  if (!$error) {
    date_default_timezone_set('Europe/London');
    $currentDateTime = date('Y-m-d H:i');
    $password = hash('sha256', $pass);

    $status = "Verified";
    $adminAccess = "Granted";

    $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE user_email_address = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
      $loginError = "Incorrect email or password.";
    } else {
      $row = $res->fetch_assoc();

      if ($row['status'] !== $status || $row['admin_access'] !== $adminAccess) {
        $loginError = "Your account is not verified or access is restricted.";
      } elseif ($row['user_password'] !== $password) {
        $loginError = "Incorrect email or password.";
      } else {
        // Successful login
        session_regenerate_id(true);
        $_SESSION['usr_compId'] = $row['col_company_Id'];
        $_SESSION['usr_userName'] = $row['user_fullname'];
        $_SESSION['usr_compName'] = $row['company_name'];
        $_SESSION['usr_email'] = $row['user_email_address'];
        $_SESSION['usr_city'] = $row['my_city'];
        $_SESSION['usr_specId'] = $row['user_special_Id'];

        // Update last login timestamp
        $updateStmt = $conn->prepare("UPDATE tbl_admin SET last_login = ? WHERE user_email_address = ?");
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
