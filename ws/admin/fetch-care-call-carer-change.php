<?php
include('dbconnections.php');
$varGetAllData = 'Select all';
$varCookieCity = $_COOKIE["companyCity"];
if ($varGetAllData == $varCookieCity) {
    $output = '';
    if (isset($_POST["query"])) {
        $search = mysqli_real_escape_string($conn, $_POST["query"]);
        $query = "
    SELECT c.userid, c.team_first_name, c.team_last_name, c.team_date_of_birth, c.col_company_city, c.col_team_resource, c.col_company_Id, c.team_nationality, c.team_primary_phone, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c LEFT JOIN tbl_team_status a ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 AND a.col_approval = 'Approved' AND CURDATE() BETWEEN a.col_startDate AND a.col_endDate 
    WHERE (a.uryyTteamoeSS4 IS NULL AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
    AND c.team_first_name LIKE '%" . $search . "%' OR c.team_last_name LIKE '%" . $search . "%' OR c.team_middle_name LIKE '%" . $search . "%');
";
    } else {
        $query = "
    SELECT c.userid, c.team_first_name, c.team_last_name, c.team_date_of_birth, c.col_company_city, c.col_team_resource, c.col_company_Id, c.team_nationality, c.team_primary_phone, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c LEFT JOIN tbl_team_status a ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 AND a.col_approval = 'Approved' AND CURDATE() BETWEEN a.col_startDate AND a.col_endDate 
    WHERE (a.uryyTteamoeSS4 IS NULL AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY c.team_first_name ASC;
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
                            <th>Phone</th>
                            <th>Change carer</th>
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
                                                    <td>' . $trans["team_primary_phone"] . '</td>
                                                    <td>
                                                    <form method="post" action="./processing-change-carecall-carer" enctype="multipart/form-data" autocomplete="off">
                                                        <input type="hidden" name="clientSpecialId" value="' . $_SESSION['myUsersId'] . '" />
                                                        <input type="hidden" name="textCareCallType" value="' . $_SESSION['client_care_call'] . '" />
                                                        <input type="hidden" name="textCareCallDate" value="' . $_SESSION['Clientshift_Date'] . '" />
                                                        <input type="hidden" name="txtCarerResource" value="' . $trans["col_team_resource"] . '" />
                                                        <input type="hidden" name="txtFirstCarer" value="' . $trans["team_first_name"] . ' ' . $trans["team_last_name"] . '" />
                                                        <input type="hidden" name="txtCarerSpecialId" value="' . $trans["uryyTteamoeSS4"] . '" />
                                                        <input type="hidden" name="txtTimelineColor" value="#34495e" />
                                                        <input type="hidden" name="txtCallStatus" value="Scheduled" />
                                                        <input type="hidden" name="txtBgColor" value="rgba(44, 62, 80,.5)" />
                                                        <button style="height:40px;" title="Assign this visit to me" name="btnChangeCarer" type="submit" class="btn btn-info btn-sm"><i class="feather mr-2 icon-briefcase"></i> Assign run</button>
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
    $output = '';
    if (isset($_POST["query"])) {
        $search = mysqli_real_escape_string($conn, $_POST["query"]);
        $query = "
    SELECT c.userid, c.team_first_name, c.team_last_name, c.team_date_of_birth, c.col_company_city, c.col_team_resource, c.col_company_Id, c.team_nationality, c.team_primary_phone, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c LEFT JOIN tbl_team_status a ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 AND a.col_approval = 'Approved' AND CURDATE() BETWEEN a.col_startDate AND a.col_endDate 
    WHERE (a.uryyTteamoeSS4 IS NULL AND c.col_company_city = '" . $_COOKIE["companyCity"] . "' AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
    AND c.team_first_name LIKE '%" . $search . "%' OR c.team_last_name LIKE '%" . $search . "%' OR c.team_middle_name LIKE '%" . $search . "%');
";
    } else {
        $query = "
    SELECT c.userid, c.team_first_name, c.team_last_name, c.team_date_of_birth, c.col_company_city, c.col_team_resource, c.col_company_Id, c.team_nationality, c.team_primary_phone, c.team_city, c.uryyTteamoeSS4 
    FROM tbl_general_team_form c LEFT JOIN tbl_team_status a ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4 AND a.col_approval = 'Approved' AND CURDATE() BETWEEN a.col_startDate AND a.col_endDate 
    WHERE (a.uryyTteamoeSS4 IS NULL AND c.col_company_city = '" . $_COOKIE["companyCity"] . "' AND c.col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY c.team_first_name ASC;
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
                            <th>Phone</th>
                            <th>Change carer</th>
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
                                                    <td>' . $trans["team_primary_phone"] . '</td>
                                                    <td>
                                                    <form method="post" action="./processing-change-carecall-carer" enctype="multipart/form-data" autocomplete="off">
                                                        <input type="hidden" name="clientSpecialId" value="' . $_SESSION['myUsersId'] . '" />
                                                        <input type="hidden" name="textCareCallType" value="' . $_SESSION['client_care_call'] . '" />
                                                        <input type="hidden" name="textCareCallDate" value="' . $_SESSION['Clientshift_Date'] . '" />
                                                        <input type="hidden" name="txtCarerResource" value="' . $trans["col_team_resource"] . '" />
                                                        <input type="hidden" name="txtFirstCarer" value="' . $trans["team_first_name"] . ' ' . $trans["team_last_name"] . '" />
                                                        <input type="hidden" name="txtCarerSpecialId" value="' . $trans["uryyTteamoeSS4"] . '" />
                                                        <input type="hidden" name="txtTimelineColor" value="#34495e" />
                                                        <input type="hidden" name="txtCallStatus" value="Scheduled" />
                                                        <input type="hidden" name="txtBgColor" value="rgba(44, 62, 80,.5)" />
                                                        <button style="height:40px;" title="Assign this visit to me" name="btnChangeCarer" type="submit" class="btn btn-info btn-sm"><i class="feather mr-2 icon-briefcase"></i> Assign run</button>
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
