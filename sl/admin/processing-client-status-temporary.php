<?php
if (isset($_POST['btnStatusTemporary'])) {
    include('dbconnections.php');

    $txtClientName = $_POST['txtClientName'] ?? '';
    $txtClientId = $_POST['txtClientId'] ?? '';
    $txtClientCity = $_POST['txtClientCity'] ?? '';
    $txtCompanyId = $_POST['txtCompanyId'] ?? '';
    $txtReason = $_POST['txtReasonForTemporary'] ?? '';
    $txtTimeForTemporary = $_POST['txtTimeForTemporary'] ?? '';
    $txtNoteForTemporary = $_POST['txtNoteForTemporary'] ?? '';
    $txtStartDate = $_POST['txtStartDate'] ?? '';
    $txtEndDate = !empty($_POST['txtEndDate']) ? $_POST['txtEndDate'] : 'TFN';

    $statusColors = [
        'Active'        => '',
        'Hospitalized'  => 'rgba(231, 76, 60,1.0)',
        'Holiday'       => 'rgba(142, 68, 173,1.0)',
        'WithFamily'    => 'rgba(52, 31, 151,1.0)',
        'Inactive'      => 'rgba(243, 156, 18,1.0)',
        'Others'        => 'rgba(211, 84, 0,1.0)'
    ];

    $colStatusColor = $statusColors[$txtReason] ?? $statusColors['Others'];

    $operationSuccess = false;
    $conn->begin_transaction();

    try {
        // Get last status record
        $checkSql = "SELECT * FROM tbl_client_status_records WHERE col_client_Id = ? 
        AND (col_end_date >= CURDATE() OR col_end_date = 'TFN' OR col_end_date = 'Active') 
        ORDER BY userId DESC LIMIT 1";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $txtClientId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $varStartDate = $row['col_start_date'];

            if ($txtReason === 'Active') {
                // Reset last record to Active
                $updateSql = "UPDATE tbl_client_status_records SET col_end_date = 'Active' WHERE col_client_Id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("s", $txtClientId);
                $updateStmt->execute();
                $updateStmt->close();

                // Reset schedule back to Scheduled
                $scheduleSql = "UPDATE tbl_schedule_calls SET call_status = 'Scheduled' WHERE uryyToeSS4 = ? 
                AND Clientshift_Date >= ?";
                $scheduleStmt = $conn->prepare($scheduleSql);
                $scheduleStmt->bind_param("ss", $txtClientId, $txtStartDate);
                $scheduleStmt->execute();
                $scheduleStmt->close();

                $operationSuccess = true;
            } else {
                // Insert record with new reason
                if ($varStartDate == $txtStartDate) {
                    $updateSql = "UPDATE tbl_client_status_records SET col_reason = ?, col_time = ?, col_note = ?, col_status_color = ?, col_start_date = ?, col_end_date = ? WHERE userId = ?";
                    $updateStmt = $conn->prepare($updateSql);
                    $updateStmt->bind_param("ssssssi", $txtReason, $txtTimeForTemporary, $txtNoteForTemporary, $colStatusColor, $txtStartDate, $txtEndDate, $row['userId']);
                    $updateStmt->execute();
                    $updateStmt->close();

                    // Cancel schedules for this period
                    $scheduleSql = "UPDATE tbl_schedule_calls SET call_status = 'Cancelled' WHERE uryyToeSS4 = ? AND Clientshift_Date >= ? AND dateTime_in >= ?";
                    $scheduleStmt = $conn->prepare($scheduleSql);
                    $scheduleStmt->bind_param("sss", $txtClientId, $txtStartDate, $txtTimeForTemporary);
                    $scheduleStmt->execute();
                    $scheduleStmt->close();

                    $operationSuccess = true;
                } else {
                    $insertSql = "INSERT INTO tbl_client_status_records (col_client_name, col_reason, col_time, col_note, col_status_color, col_start_date, col_end_date, client_city, col_client_Id, col_company_Id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("ssssssssss", $txtClientName, $txtReason, $txtTimeForTemporary, $txtNoteForTemporary, $colStatusColor, $txtStartDate, $txtEndDate, $txtClientCity, $txtClientId, $txtCompanyId);
                    $insertStmt->execute();
                    $insertStmt->close();

                    // Cancel schedules for this period
                    $scheduleSql = "UPDATE tbl_schedule_calls SET call_status = 'Cancelled' WHERE uryyToeSS4 = ? AND Clientshift_Date >= ? AND dateTime_in >= ?";
                    $scheduleStmt = $conn->prepare($scheduleSql);
                    $scheduleStmt->bind_param("sss", $txtClientId, $txtStartDate, $txtTimeForTemporary);
                    $scheduleStmt->execute();
                    $scheduleStmt->close();

                    $operationSuccess = true;
                }
            }
        } else {
            // Insert new record
            $insertSql = "INSERT INTO tbl_client_status_records (col_client_name, col_reason, col_time, col_note, col_status_color, col_start_date, col_end_date, client_city, col_client_Id, col_company_Id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("ssssssssss", $txtClientName, $txtReason, $txtTimeForTemporary, $txtNoteForTemporary, $colStatusColor, $txtStartDate, $txtEndDate, $txtClientCity, $txtClientId, $txtCompanyId);
            $insertStmt->execute();
            $insertStmt->close();

            // Cancel schedules
            $scheduleSql = "UPDATE tbl_schedule_calls SET call_status = 'Cancelled' WHERE uryyToeSS4 = ? AND Clientshift_Date >= ? AND dateTime_in >= ?";
            $scheduleStmt = $conn->prepare($scheduleSql);
            $scheduleStmt->bind_param("sss", $txtClientId, $txtStartDate, $txtTimeForTemporary);
            $scheduleStmt->execute();
            $scheduleStmt->close();

            $operationSuccess = true;
        }

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }

    $conn->close();
    header("Location: ./client-details?uryyToeSS4=$txtClientId");
    exit;
}
