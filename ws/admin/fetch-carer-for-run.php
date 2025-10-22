<?php
include('dbconnections.php');
if (isset($_GET['run_area_nameId'])) {
    $run_area_nameId = $_GET['run_area_nameId'];
}
$selDate = $_SESSION["currentDateRota"];

$output = '';
$varGetAllData = 'Select all';
$varCookieCity = $_COOKIE["companyCity"];
if ($varGetAllData == $varCookieCity) {
    if (isset($_POST["query"])) {
        $search = mysqli_real_escape_string($conn, $_POST["query"]);
        $query = "
        SELECT c.team_first_name, c.team_last_name, c.team_date_of_birth, 
           c.col_company_city, c.col_company_Id, c.team_nationality, 
           c.team_primary_phone, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c 
    LEFT JOIN tbl_team_status a 
        ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 
        AND a.col_approval = 'Approved'
        AND (
            '$selDate' BETWEEN a.col_startDate AND a.col_endDate
            OR (a.col_startDate <= '$selDate' AND a.col_endDate = 'TFN')
        )
    WHERE a.uryyTteamoeSS4 IS NULL 
    AND c.col_company_city = '" . $_COOKIE["companyCity"] . "' 
    AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
    AND (c.team_first_name LIKE '%" . $search . "%' 
        OR c.team_last_name LIKE '%" . $search . "%' 
        OR c.team_middle_name LIKE '%" . $search . "%')
    ORDER BY c.team_first_name ASC;
    ";
    } else {
        $query = "
    SELECT c.team_first_name, c.team_last_name, c.team_date_of_birth, 
           c.col_company_city, c.col_company_Id, c.team_nationality, 
           c.team_primary_phone, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c
    LEFT JOIN tbl_team_status a 
        ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 
        AND a.col_approval = 'Approved'
        AND (
            '$selDate' BETWEEN a.col_startDate AND a.col_endDate
            OR (a.col_startDate <= '$selDate' AND a.col_endDate = 'TFN')
        )
    WHERE a.uryyTteamoeSS4 IS NULL
      AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "'
    ORDER BY c.team_first_name ASC;
";
    }
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '<div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date of birth</th>
                                <th>Nationality</th>
                                <th>Group</th>
                                <th>Assign run</th>
                            </tr>
                        </thead>
                        ';
        while ($trans = mysqli_fetch_array($result)) {
            $teamDOB = date('d M, Y', strtotime("" . $trans['team_date_of_birth'] . ""));
            $output .= '
                                                        <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="assets/images/profile/profile-icon.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                                <div class="d-inline-block">
                                                                    <h6>' . $trans["team_first_name"] . '  ' . $trans["team_last_name"] . '</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>' . $teamDOB . '</td>
                                                        <td>' . $trans["team_nationality"] . '</td>
                                                        <td>' . $trans["team_city"] . '</td>
                                                        <td>
                                                        <form method="post" action="./processing-schedule-roster" enctype="multipart/form-data" autocomplete="off">
                                                            <input type="hidden" name="txtFirstCarer" value="' . $trans["team_first_name"] . ' ' . $trans["team_last_name"] . '" />
                                                            <input type="hidden" name="txtFirstCarerId" value="' . $trans["uryyTteamoeSS4"] . '" />
                                                            <input type="hidden" name="txtPayRate" value="' . $trans["col_pay_rate"] . '" />
                                                            <input type="hidden" name="txtMileage" value="' . $trans["col_mileage"] . '" />
                                                            <input type="hidden" name="txtRunName" value="' . $_SESSION["runName"] . '" />
                                                            <input type="hidden" name="txtRunNameId" value="' . $_SESSION["runNameId"] . '" />
                                                            <input type="hidden" name="txtRunNameArea" value="' . $_SESSION["runNameArea"] . '" />
                                                            <input type="hidden" name="txtRunNameCity" value="' . $_SESSION["runNameCity"] . '" />
                                                            <input type="hidden" name="txtClientGroup" value="' . $_SESSION["uryyToeSS4"] . '" />
                                                            <input type="hidden" name="txtCurCarerId" value="' . $_SESSION["get_curCarer_Id"] . '" />
                                                            <input type="hidden" name="txtShiftDate" value="' . $_SESSION["currentDateRota"] . '" />
                                                            <input type="hidden" name="txtRotaDateInDay" value="' . $_SESSION['currentRotaDay'] . '" />
                                                            <input type="hidden" value="02c<?php echo $id; ?>" name="carecallID" />
                                                            <button style="height:40px;" title="View carer profile" name="btnScheduleRuns" type="submit" class="btn btn-info btn-sm"><i class="feather mr-2 icon-briefcase"></i> Assign run</button>
                                                        </form>
                                                        </td>
                                                    </tr>
            ';
        }
        echo $output;
    } else {
        echo 'Data Not Found';
    }
} else {
    if (isset($_POST["query"])) {
        $search = mysqli_real_escape_string($conn, $_POST["query"]);
        $query = "
    SELECT c.team_first_name, c.team_last_name, c.team_date_of_birth, 
           c.col_company_city, c.col_company_Id, c.team_nationality, 
           c.team_primary_phone, c.col_pay_rate, c.col_mileage, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c 
    LEFT JOIN tbl_team_status a 
        ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 
        AND a.col_approval = 'Approved'
        AND (
            '$selDate' BETWEEN a.col_startDate AND a.col_endDate
            OR (a.col_startDate <= '$selDate' AND a.col_endDate = 'TFN')
        )
    WHERE a.uryyTteamoeSS4 IS NULL 
    AND c.col_company_city = '" . $_COOKIE["companyCity"] . "' 
    AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
    AND (c.team_first_name LIKE '%" . $search . "%' 
        OR c.team_last_name LIKE '%" . $search . "%' 
        OR c.team_middle_name LIKE '%" . $search . "%')
    ORDER BY c.team_first_name ASC;
";
    } else {
        $query = "
    SELECT c.team_first_name, c.team_last_name, c.team_date_of_birth, 
           c.col_company_city, c.col_pay_rate, c.col_mileage, c.col_company_Id, c.team_nationality, 
           c.team_primary_phone, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c 
    LEFT JOIN tbl_team_status a 
        ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 
        AND a.col_approval = 'Approved'
        AND (
            '$selDate' BETWEEN a.col_startDate AND a.col_endDate
            OR (a.col_startDate <= '$selDate' AND a.col_endDate = 'TFN')
        )
    WHERE a.uryyTteamoeSS4 IS NULL 
    AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
    ORDER BY c.team_first_name ASC;
    ";
    }
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '<div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date of birth</th>
                                <th>Nationality</th>
                                <th>Group</th>
                                <th>Assign run</th>
                            </tr>
                        </thead>
                        ';
        while ($trans = mysqli_fetch_array($result)) {
            $teamDOB = date('d M, Y', strtotime("" . $trans['team_date_of_birth'] . ""));
            $output .= '
                                                        <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="assets/images/profile/profile-icon.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                                <div class="d-inline-block">
                                                                    <h6>' . $trans["team_first_name"] . '  ' . $trans["team_last_name"] . '</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>' . $teamDOB . '</td>
                                                        <td>' . $trans["team_nationality"] . '</td>
                                                        <td>' . $trans["team_city"] . '</td>
                                                        <td>
                                                        <form method="post" action="./processing-schedule-roster" enctype="multipart/form-data" autocomplete="off">
                                                            <input type="hidden" name="txtFirstCarer" value="' . $trans["team_first_name"] . ' ' . $trans["team_last_name"] . '" />
                                                            <input type="hidden" name="txtFirstCarerId" value="' . $trans["uryyTteamoeSS4"] . '" />
                                                            <input type="hidden" name="txtPayRate" value="' . $trans["col_pay_rate"] . '" />
                                                            <input type="hidden" name="txtMileage" value="' . $trans["col_mileage"] . '" />
                                                            <input type="hidden" name="txtRunName" value="' . $_SESSION["runName"] . '" />
                                                            <input type="hidden" name="txtRunNameId" value="' . $_SESSION["runNameId"] . '" />
                                                            <input type="hidden" name="txtRunNameArea" value="' . $_SESSION["runNameArea"] . '" />
                                                            <input type="hidden" name="txtRunNameCity" value="' . $_SESSION["runNameCity"] . '" />
                                                            <input type="hidden" name="txtClientGroup" value="' . $_SESSION["uryyToeSS4"] . '" />
                                                            <input type="hidden" name="txtCurCarerId" value="' . $_SESSION["get_curCarer_Id"] . '" />
                                                            <input type="hidden" name="txtShiftDate" value="' . $_SESSION["currentDateRota"] . '" />
                                                            <input type="hidden" name="txtRotaDateInDay" value="' . $_SESSION['currentRotaDay'] . '" />
                                                            <input type="hidden" value="02c<?php echo $id; ?>" name="carecallID" />
                                                            <button style="height:40px;" title="View carer profile" name="btnScheduleRuns" type="submit" class="btn btn-info btn-sm"><i class="feather mr-2 icon-briefcase"></i> Assign run</button>
                                                        </form>
                                                        </td>
                                                    </tr>
            ';
        }
        echo $output;
    } else {
        echo 'Data Not Found';
    }
}
