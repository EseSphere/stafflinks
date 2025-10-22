<?php
if (isset($_POST['btnAddNewRun'])) {
    $txtAddNewRun = mysqli_real_escape_string($conn, $_REQUEST['txtAddNewRun']);
    $txtRunTown = 'Null';
    $txtCityInCharge = mysqli_real_escape_string($conn, $_REQUEST['txtCityInCharge']);
    $txtCompId = $_SESSION['usr_compId'];

    $myCheck = "SELECT * FROM tbl_client_runs WHERE run_name = '" . $txtAddNewRun . "' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);
    if ($countRes != 0) {
        echo "
            <script type='text/javascript'>
            $(document).ready(function() {
                $('#popupAlert').show();
            });
            </script>";
    } else {
        $sql_run_Id = "SELECT MAX(run_ids + 0) FROM tbl_client_runs";
        $result_run_Id = $conn->query($sql_run_Id);
        $row_run_Id = mysqli_fetch_array($result_run_Id);
        $hold_runs_Id = $row_run_Id['MAX(run_ids + 0)'];
        $count_runs_Id = mysqli_num_rows($result_run_Id);

        if ($count_runs_Id == 0) {
            $addnew_run_Id = 4788 + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_client_runs (run_name, run_town, col_run_city, run_ids, comp_location_view, col_company_Id) 
                VALUES('" . $txtAddNewRun . "', '" . $txtRunTown . "', '" . $txtCityInCharge . "', '" . $addnew_run_Id . "', '" . $txtCityInCharge . "', '" . $txtCompId . "') ");
            if ($queryIns) {
                header("Location: ./attach-clients?city=$txtCityInCharge&specId=$addnew_run_Id&u7ye=$crackEncryptedbinary");
            }
        } else {
            $increase_run_Id = $hold_runs_Id + 1;
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_client_runs (run_name, run_town, col_run_city, run_ids, comp_location_view, col_company_Id) 
                VALUES('" . $txtAddNewRun . "', '" . $txtRunTown . "', '" . $txtCityInCharge . "', '" . $increase_run_Id . "', '" . $txtCityInCharge . "', '" . $txtCompId . "') ");
            if ($queryIns) {
                header("Location: ./attach-clients?city=$txtCityInCharge&specId=$increase_run_Id&u7ye=$crackEncryptedbinary");
            }
        }
    }
}
