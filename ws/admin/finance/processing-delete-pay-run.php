<?php

if (isset($_POST['btnDeletePayRun'])) {
    include('dbconnections.php');

    $txtCompanyId = mysqli_real_escape_string($conn, $_POST['txtCompanyId']);
    $txtPayRunId = mysqli_real_escape_string($conn, $_POST['txtPayRunId']);

    $sql_delete_pay_run = mysqli_query($conn, "DELETE FROM tbl_pay_run 
    WHERE (col_pay_runId = '$txtPayRunId' AND col_company_Id = '$txtCompanyId') ");
    if ($sql_delete_pay_run) {
        echo "<script>
                window.history.go(-1);
            </script>";
        //header('Location: ./pay-runs-994847-009484-2237746-i8846');
    } else {
    }
}
