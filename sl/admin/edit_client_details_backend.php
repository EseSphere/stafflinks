<?php
include('client-header-contents.php');

$companyId = $_SESSION['usr_compId'] ?? null;

if (!$companyId) {
    die("Unauthorized access.");
}

// Fetch client details securely
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("ss", $uryyToeSS4, $companyId);
$stmt->execute();
$get_team_row = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (isset($_POST['btnUpdateClientInfo'])) {
    // Sanitize input
    $fields = [
        'txtSecondBox',
        'txtThirdBox',
        'txtFourthBox',
        'txtFifthBox',
        'txtSixthBox',
        'txtSeventhBox',
        'txtEightthBox',
        'txtNinethBox',
        'txtTenBox',
        'txtEleventhBox',
        'txtTwelvthBox',
        'txtThirtenBox',
        'txtFourtenBox',
        'txtFiftenBox',
        'txtcompanyClientId',
        'txtCompanyId'
    ];

    foreach ($fields as $field) {
        $$field = trim($_POST[$field] ?? '');
    }

    $clientName = $txtSecondBox . ' ' . $txtThirdBox;

    // Update client information using prepared statement
    $updateClient = $conn->prepare("
        UPDATE tbl_general_client_form SET
            client_first_name = ?, client_last_name = ?, client_middle_name = ?, client_preferred_name = ?,
            client_email_address = ?, client_primary_phone = ?, client_date_of_birth = ?, client_address_line_1 = ?,
            client_address_line_2 = ?, client_city = ?, client_county = ?, client_poster_code = ?,
            client_country = ?, client_culture_religion = ?
        WHERE uryyToeSS4 = ? AND col_company_Id = ?
    ");
    $updateClient->bind_param(
        "ssssssssssssssss",
        $txtSecondBox,
        $txtThirdBox,
        $txtFourthBox,
        $txtFifthBox,
        $txtSixthBox,
        $txtSeventhBox,
        $txtEightthBox,
        $txtNinethBox,
        $txtTenBox,
        $txtEleventhBox,
        $txtTwelvthBox,
        $txtThirtenBox,
        $txtFourtenBox,
        $txtFiftenBox,
        $txtcompanyClientId,
        $txtCompanyId
    );

    if ($updateClient->execute()) {
        // Update related tables
        $relatedTables = [
            'tbl_clienttime_calls' => ['client_name', 'client_city'],
            'tbl_manage_runs' => ['client_name', 'col_client_city'],
            'tbl_schedule_calls' => ['client_name', 'col_area_city']
        ];

        foreach ($relatedTables as $table => $columns) {
            $stmt = $conn->prepare("
                UPDATE $table SET {$columns[0]} = ?, {$columns[1]} = ?
                WHERE uryyToeSS4 = ? AND col_company_Id = ?
            ");
            $stmt->bind_param("ssss", $clientName, $txtEleventhBox, $txtcompanyClientId, $txtCompanyId);
            $stmt->execute();
            $stmt->close();
        }

        header("Location: ./client-details?uryyToeSS4=$txtcompanyClientId");
        exit;
    } else {
        header("Location: ./client-details?uryyToeSS4=$txtcompanyClientId&error=update_failed");
        exit;
    }
}
