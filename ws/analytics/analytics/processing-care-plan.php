<?php
header('Content-Type: application/json');
include_once('db_connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$input = json_decode(file_get_contents("php://input"), true);
$response = ['labels' => [], 'counts' => [], 'records' => []];

try {
    // Chart data
    $stmt = $conn->prepare("SELECT COUNT(*) FROM `schedule` WHERE `start_date` BETWEEN ? AND ?");
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

    // Breakdown data (for all ranges combined)
    $rangeStart = $input['ranges'][0]['start'];
    $rangeEnd = end($input['ranges'])['end'];

    $totalQuery = $conn->prepare("SELECT COUNT(*) as total FROM `schedule` WHERE `start_date` BETWEEN ? AND ?");
    $totalQuery->bind_param("ss", $rangeStart, $rangeEnd);
    $totalQuery->execute();
    $totalResult = $totalQuery->get_result();
    $totalRow = $totalResult->fetch_assoc();
    $total = $totalRow['total'];
    $totalQuery->close();

    $recordsQuery = $conn->prepare("SELECT `name`, COUNT(*) as count FROM `schedule` WHERE `start_date` BETWEEN ? AND ? GROUP BY `name` ORDER BY count DESC");
    $recordsQuery->bind_param("ss", $rangeStart, $rangeEnd);
    $recordsQuery->execute();
    $result = $recordsQuery->get_result();

    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row['name']);
        $count = (int)$row['count'];
        $percent = $total > 0 ? round(($count / $total) * 100, 1) : 0;
        $volume = number_format($count);

        $response['records'][] = [
            'name' => $name,
            'count' => $count,
            'percent' => $percent,
            'volume' => $volume
        ];
    }

    $recordsQuery->close();
    $conn->close();

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    http_response_code(500);
}
