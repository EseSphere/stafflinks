<?php

$host     = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$dbname   = getenv('DB_NAME') ?: 'worksphere';

$conn = @new mysqli($host, $username, $password, $dbname);

if ($conn->connect_errno) {
    error_log("Database connection failed: " . $conn->connect_error);
    exit("Sorry, we are experiencing technical difficulties. Please try again later.");
}

if (!$conn->set_charset("utf8mb4")) {
    error_log("Error setting charset: " . $conn->error);
}

$encrypted = 'USR-' . strtoupper(bin2hex(random_bytes(4)));
$encrypt = uniqid('', true);
$crackEncryptedbinary = $encrypted . '-' . $encrypt;
