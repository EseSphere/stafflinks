<?php
include_once('db_connect.php');

// Get grouped counts by name
$query = "
    SELECT name, COUNT(*) as count
    FROM schedule
    GROUP BY name
    ORDER BY count DESC
";

$result = $conn->query($query);

// Get total count for percentage calculation
$totalQuery = "SELECT COUNT(*) as total FROM schedule";
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Schedule Grouped Columns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f0f2b;
            color: white;
        }

        .card-dark {
            background-color: #1e1e3f;
            border: none;
            color: white;
        }

        .card-dark h5 {
            border-bottom: 1px solid #444;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <?php foreach ($columns as $col): ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-dark p-3">
                        <h5>by medium</h5>
                        <?= implode("", $col) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>