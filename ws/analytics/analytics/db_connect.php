<?php
$host = getenv('DB_HOST') ?: '192.168.0.29';
$user = getenv('DB_USER') ?: 'remote_user';
$password = getenv('DB_PASSWORD') ?: 'Geosoft@!12';
$database = getenv('DB_NAME') ?: 'geosoft';
$port = getenv('DB_PORT') ?: 3306;

$conn = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed.']));
} else {
    //echo "Connection successful";
}
