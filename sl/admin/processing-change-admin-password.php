<?php
include('db-connect.php');
session_start();

if (isset($_POST['btnChangePassword'])) {
    $password = trim($_POST['myPassword'] ?? '');
    $confirmPassword = trim($_POST['myCPassword'] ?? '');
    $email = $_SESSION['usr_email'] ?? '';

    if (empty($email)) {
        echo "<script>alert('Session expired. Please log in again.'); window.location='./index';</script>";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "<script>$(document).ready(function(){ $('#popupAlert').show(); });</script>";
        exit;
    }

    $hashedPassword = hash('sha256', $password);
    $stmt = $conn->prepare("UPDATE tbl_goesoft_users SET user_password = ? WHERE user_email_address = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);

    if ($stmt->execute()) {
        header("Location: ./auth-normal-logout");
        exit;
    } else {
        echo "<script>$(document).ready(function(){ $('#popupAlert').show(); });</script>";
    }

    $stmt->close();
}
