<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verifyicNumber = $conn->real_escape_string($_POST['verifyicNumber']);

    // Prepare SQL query using MySQLi
    $stmt = $conn->prepare("SELECT verific_code FROM `users` WHERE verific_code = ?");
    $stmt->bind_param('s', $verifyicNumber);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and password matches
    if ($user == true) {
        header("Location: ./verification-success");
        exit();
    } else {
        $error = "Invalid or expired verification code";
    }
}
