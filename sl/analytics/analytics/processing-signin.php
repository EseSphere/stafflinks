<?php
if (isset($_POST['btnLogin'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Prepare SQL query using MySQLi
    $stmt = $conn->prepare("SELECT * FROM `tbl_users` WHERE email = ?");
    $stmt->bind_param('s', $email);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and password matches
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['userId'];
        $_SESSION['fullName'] = $user['fullName'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['uYtey9U8'] = $user['uYtey9U8'];
        header("Location: ./dashboard");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
