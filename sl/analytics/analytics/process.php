<?php
header('Content-Type: application/json');

$pdo = new PDO("mysql:host=localhost;dbname=barchart", "root", "");
$input = json_decode(file_get_contents("php://input"), true);

$response = ['labels' => [], 'counts' => []];

foreach ($input['ranges'] as $range) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `schedule` WHERE start_date BETWEEN :start AND :end");
    $stmt->execute([
        ':start' => $range['start'],
        ':end' => $range['end']
    ]);
    $count = $stmt->fetchColumn();

    $response['labels'][] = $range['label'];
    $response['counts'][] = (int)$count;
}

echo json_encode($response);
