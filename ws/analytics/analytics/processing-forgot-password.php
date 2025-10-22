<?php
if (isset($_SESSION['user_id'])) {
    header("Location: ./dashboard");
    exit();
}

if (isset($_POST['btnForgotPass'])) {
    $email = $conn->real_escape_string($_POST['email']);

    // Prepare SQL query using MySQLi
    $stmt = $conn->prepare("SELECT * FROM `tbl_users` WHERE email = ?");
    $stmt->bind_param('s', $email);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and password matches
    if ($user == true) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: ./reset-password");
        exit();
    } else {
        $error = "Email is not recognized. Please try again!";
    }
}
