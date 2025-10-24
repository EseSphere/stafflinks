<?php
include('dbconnections.php');
if (
    isset($_COOKIE['StartDate']) &&
    isset($_COOKIE['EndDate']) &&
    isset($_COOKIE['CareGiver']) &&
    isset($_COOKIE['txtClientContract']) &&
    isset($_COOKIE['CareRecipient']) &&
    isset($_COOKIE['CompanyId']) &&
    isset($_COOKIE['Contract'])
) {
    header("Location: dashboard.php");
    exit();
} else {
    $txtStartDate = $first_day_this_month;
    $txtEndDate = $last_day_this_month;
    $txtCareGiver = 'Checked in';
    $txtClientContract = 'Checked in';
    $txtCareRecipient = 'Checked in';
    $txtCompanyId = $_SESSION['usr_compId'] ?? 'default_id';
    $txtContract = 'Checked in';
    $expiry = time() + (86400 * 30);

    $success = true;
    $success &= setcookie('StartDate', $txtStartDate, $expiry, '/');
    $success &= setcookie('EndDate', $txtEndDate, $expiry, '/');
    $success &= setcookie('CareGiver', $txtCareGiver, $expiry, '/');
    $success &= setcookie('ClientContract', $txtClientContract, $expiry, '/');
    $success &= setcookie('CareRecipient', $txtCareRecipient, $expiry, '/');
    $success &= setcookie('CompanyId', $txtCompanyId, $expiry, '/');
    $success &= setcookie('Contract', $txtContract, $expiry, '/');
    if ($success) {
        $stmt = $conn->prepare("SELECT finance_access FROM tbl_admin 
        WHERE user_email_address = ?");
        $stmt->bind_param("s", $_SESSION['usr_email']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if ($row['finance_access'] === 'Granted') {
                header('Location: ./dashboard');
            } else {
                header('Location: ./access-restricted');
            }
        } else {
            header('Location: ../logout');
        }
    } else {
        echo "Failed to set one or more cookies.";
    }
}

$stmt->close();
$conn->close();
exit();
