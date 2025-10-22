<?php
header('Content-Type: application/json');
include_once('db_connect.php');

$input = json_decode(file_get_contents("php://input"), true);
$response = ['labels' => [], 'counts' => []];

// Use $conn instead of $mysqli
$stmt = $conn->prepare("SELECT COUNT(*) FROM `tbl_report_issues` WHERE `dateTime` BETWEEN ? AND ?");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to prepare statement.']);
    exit;
}

foreach ($input['ranges'] as $range) {
    $start = $range['start'];
    $end = $range['end'];

    $stmt->bind_param("ss", $start, $end);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    $response['labels'][] = $range['label'];
    $response['counts'][] = (int)$count;
}

$stmt->close();
$conn->close();

echo json_encode($response);
