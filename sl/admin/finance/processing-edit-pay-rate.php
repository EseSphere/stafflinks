<?php

if (isset($_POST['btnUpdatePayRateData'])) {
    require_once 'dbconnections.php';

    $txtName = $_POST['txtName'] ?? '';
    $txtDayType = $_POST['txtdayType'] ?? '';
    $txtWWTA = $_POST['txtWWTA'] ?? '';
    $txtRateType = $_POST['txtRateType'] ?? '';
    $txtHourlyRate = $_POST['txtHourlyRate'] ?? '';
    $txtServiceType = $_POST['txtSelectservicetype'] ?? '';
    $rateId = $_POST['mySpecialId'] ?? '';
    $currentDate = $_POST['txtCurrentDate'] ?? '';

    $checkSql = "SELECT 1 FROM tbl_pay_rate WHERE col_name = ? AND col_special_Id != ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $txtName, $rateId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo <<<HTML
<script type="text/javascript">
    $(document).ready(function() {
        $('#popupAlert').show();
    });
</script>
HTML;
    } else {
        $updateSql = "UPDATE tbl_pay_rate SET col_name = ?, col_days = ?, col_applies = ?, col_type = ?, col_rates = ?, col_service_type = ?, col_date = ? WHERE col_special_Id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param(
            "ssssssss",
            $txtName,
            $txtDayType,
            $txtWWTA,
            $txtRateType,
            $txtHourlyRate,
            $txtServiceType,
            $currentDate,
            $rateId
        );
        if ($updateStmt->execute()) {
            $sqlUpdate = "UPDATE tbl_general_team_form SET col_pay_rate = ? WHERE col_rate_type = ? AND col_company_Id = ?";
            $sqlStmt = $conn->prepare($sqlUpdate);
            $sqlStmt->bind_param("dss", $txtHourlyRate, $txtName, $_SESSION['usr_compId']);
            if ($sqlStmt->execute()) {
                header("Location: ./edit-pay-rate?col_special_Id=" . urlencode($rateId));
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $checkStmt->close();
    $updateStmt->close();
    $conn->close();
}
