<?php
// get_schedule.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Include DB connection
require_once 'db_connection.php'; // <- must create $pdo (PDO) connection

function timeToDecimal($timeStr)
{
    if (!$timeStr) return 0;
    list($hours, $minutes) = explode(':', $timeStr);
    return intval($hours) + intval($minutes) / 60;
}

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

try {
    $result = [];

    // Fetch all staff
    $staffStmt = $pdo->query("SELECT * FROM tbl_general_team_form ORDER BY team_first_name");
    $staffs = $staffStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch events for the specific date, but exclude blocked clients
    $eventStmt = $pdo->prepare("
    SELECT sc.*
    FROM tbl_schedule_calls sc
    WHERE sc.Clientshift_Date = ? AND sc.call_status != 'Cancelled'
      AND NOT EXISTS (
          SELECT 1
          FROM tbl_client_status_records csr
          WHERE csr.col_client_Id = sc.uryyToeSS4
            AND (
                -- Case 1: Clientshift_Date is between start_date and end_date
                (sc.Clientshift_Date BETWEEN csr.col_start_date AND csr.col_end_date)
                OR
                -- Case 2: start_date <= Clientshift_Date AND end_date = 'TFN'
                (csr.col_start_date <= sc.Clientshift_Date AND csr.col_end_date = 'TFN')
            )
            -- New condition: hide visit if dateTime_in >= col_time (unless Active)
            AND NOT (
                sc.dateTime_in < STR_TO_DATE(csr.col_time, '%H:%i:%s')
                OR csr.col_end_date = 'Active'
            )
      )
");

    $eventStmt->execute([$date]);
    $events = $eventStmt->fetchAll(PDO::FETCH_ASSOC);

    // Group events by staff_id
    $groupedEvents = [];
    foreach ($events as $event) {
        $groupedEvents[$event['first_carer_Id']][] = [
            'id' => '' . $event['id'],
            'start' => timeToDecimal($event['dateTime_in']),
            'end' => timeToDecimal($event['dateTime_out']),
            'type' => $event['care_calls'] ?? null,
            'group' => $event['col_area_city'] ?? null,
            'title' => $event['client_name'],
            'description' => $event['call_status'] ?? null,
            'run' => $event['col_run_name'] ?? null,
            'timeline_colour' => $event['timeline_colour'] ?? '#ccc'
        ];
    }

    // Combine staff with their events
    foreach ($staffs as $staff) {
        $staffId = $staff['uryyTteamoeSS4'];
        $eventsForStaff = $groupedEvents[$staffId] ?? [];
        $result[] = [
            'id' => 'staff-' . $staffId,
            'name' => $staff['team_first_name'] . ' ' . $staff['team_last_name'],
            'group' => $eventsForStaff[0]['group'] ?? null,
            'department' => $staff['transportation'],
            'photoUrl' => $staff['transportation'],
            'color' => $eventsForStaff[0]['timeline_colour'] ?? '#ccc',
            'events' => $eventsForStaff,
        ];
    }

    echo json_encode($result);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB query error: ' . $e->getMessage()]);
}
