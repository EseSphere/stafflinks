<?php
include('dbconnections.php');

if (isset($_POST['btnDeleteRun'])) {
    $RunSpecialId = $_POST['RunSpecialId'];
    $companyId = $_SESSION['usr_compId'];

    $queries = [
        "DELETE FROM tbl_client_runs WHERE run_ids = ? AND col_company_Id = ?",
        "DELETE FROM tbl_manage_runs WHERE run_area_nameId = ? AND col_company_Id = ?",
        "DELETE FROM tbl_schedule_calls WHERE col_area_Id = ? AND Clientshift_Date >= CURDATE() AND col_company_Id = ?"
    ];
    $allSuccess = true;
    foreach ($queries as $sql) {
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $RunSpecialId, $companyId);
            if (!$stmt->execute()) {
                $allSuccess = false;
                break;
            }
            $stmt->close();
        } else {
            $allSuccess = false;
            break;
        }
    }
    if ($allSuccess) {
        header('Location: ./manage-runs');
        exit;
    } else {
        echo "Error: Unable to delete run. Please try again.";
    }
}
