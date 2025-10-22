<?php
include('client-header-contents.php');
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    if (isset($_POST['btnAutoUpdate'])) {
        $txtStatus = $_POST['txtStatus'];
        $sql_update = "UPDATE tbl_raise_concern SET col_status = '$txtStatus' 
        WHERE (userId = '$userId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
        if ($conn->query($sql_update) === TRUE) {
            header("Location: ./view-report.php?userId=" . $userId);
        } else {
            header("Location: ./auth-reports");
        }
    }
}
