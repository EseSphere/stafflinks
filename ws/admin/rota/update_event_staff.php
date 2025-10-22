<?php
header('Content-Type: application/json');

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['events'])) {
    echo json_encode(['success' => false, 'message' => 'No event data received']);
    exit;
}

$events = $input['events'];

// PDO connection settings - update with your credentials
$dsn = 'mysql:host=host;dbname=database;charset=utf8mb4';
$user = 'user';
$pass = 'pass';

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'DB connection failed']);
    exit;
}

// Prepare update statement
$sql = "UPDATE tbl_schedule_calls SET first_carer_Id = :newStaffId WHERE uryyToeSS4 = :eventUniqueId";
$stmt = $pdo->prepare($sql);

$allUpdated = true;

foreach ($events as $event) {
    $newStaffId = $event['newStaffId'] ?? null;
    $eventUniqueId = $event['eventUniqueId'] ?? null;

    if (!$eventUniqueId) {
        $allUpdated = false;
        continue;
    }

    try {
        $stmt->execute([
            ':newStaffId' => $newStaffId,
            ':eventUniqueId' => $eventUniqueId
        ]);
    } catch (PDOException $e) {
        $allUpdated = false;
    }
}

echo json_encode(['success' => $allUpdated]);
