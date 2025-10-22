<?php
include_once('db_connect.php');

// Get grouped counts by name
$query = "SELECT `name`, COUNT(*) as count FROM `schedule` GROUP BY `name` ORDER BY count DESC";

$result = $conn->query($query);

// Get total count for percentage calculation
$totalQuery = "SELECT COUNT(*) as total FROM `schedule`";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$total = $totalRow['total'];

$records = [];

while ($row = $result->fetch_assoc()) {
    $name = htmlspecialchars($row['name']);
    $count = (int)$row['count'];
    $percent = $total > 0 ? round(($count / $total) * 100, 1) : 0;
    $volume = $count;

    $records[] = "
        <div class='d-flex justify-content-between border-bottom py-2'>
            <strong>{$name}</strong>
            <span>{$count} • {$percent}% • " . number_format($volume) . "</span>
        </div>
    ";
}

$conn->close();

// Break records into chunks of 10
$columns = array_chunk($records, 10);
