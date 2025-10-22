<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<?php
include 'dbconnections.php';

// 4. SQL query to select data
$sql = "SELECT first_carer, client_name, dateTime_in, dateTime_out FROM tbl_schedule_calls 
WHERE Clientshift_Date = CURDATE() AND CURTIME() > TIME(dateTime_in) AND call_status = 'Scheduled'";
$result = $conn->query($sql);

// 5. Check if rows exist and display data
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
?>
        <div style="font-size: 13px !important; max-width: 250px !important;" class="alert alert-danger p-2 flex justify-end items-end" role="alert">
            <i class="fas fa-info-circle"></i>
            <strong><?= htmlspecialchars($row['first_carer']) ?></strong> <br>
            <strong>Late for <?= htmlspecialchars($row['client_name']) ?> Call</strong><br>
            <span><?= htmlspecialchars($row['dateTime_in']) ?> &rarr; <?= htmlspecialchars($row['dateTime_out']) ?></span>
        </div>
<?php

    }
} else {
    echo "0 results found.";
}

// 6. Close connection
$conn->close();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>