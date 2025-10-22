<?php
include 'dbconnections.php';

// Select calls today that are 5+ minutes late
$sql = "SELECT first_carer, client_name, dateTime_in, dateTime_out, 
        TIMESTAMPDIFF(MINUTE, dateTime_in, NOW()) AS minutes_late
        FROM tbl_schedule_calls 
        WHERE Clientshift_Date = CURDATE() 
        AND call_status = 'Scheduled'
        HAVING minutes_late >= 5
        ORDER BY minutes_late DESC";

$result = $conn->query($sql);

$toasts = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $toasts[] = [
            'first_carer' => $row['first_carer'],
            'client_name' => $row['client_name'],
            'dateTime_in' => $row['dateTime_in'],
            'dateTime_out' => $row['dateTime_out'],
            'minutes_late' => intval($row['minutes_late'])
        ];
    }
}

$conn->close();
echo json_encode($toasts);
