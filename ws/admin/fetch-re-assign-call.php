<?php
include('dbconnections.php');

$selDate = $_POST['selDate'] ?? $_SESSION['currentDateRota'] ?? date('Y-m-d');
$varCookieCity = $_COOKIE["companyCity"] ?? '';
$output = '';

// Determine if search is performed
$isSearch = isset($_POST["query"]) && !empty($_POST["query"]);
$search = $isSearch ? '%' . $_POST["query"] . '%' : null;

// If cookie value is "Select all", no city filter
if (strtolower($varCookieCity) === 'select all') {
    if ($isSearch) {
        // Search across entire company
        $stmt = $conn->prepare("
            SELECT * FROM tbl_general_team_form 
            WHERE col_company_Id = ?
              AND (team_first_name LIKE ? OR team_last_name LIKE ?)
            ORDER BY team_first_name ASC
        ");
        $stmt->bind_param("sss", $_SESSION['usr_compId'], $search, $search);
    } else {
        $stmt = $conn->prepare("
            SELECT c.team_first_name, c.team_last_name, c.team_date_of_birth,
                   c.col_company_city, c.col_company_Id, c.team_nationality,
                   c.team_primary_phone, c.team_city, c.uryyTteamoeSS4
            FROM tbl_general_team_form c
            LEFT JOIN tbl_team_status a
                   ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4
                   AND a.col_approval = 'Approved'
                   AND (? BETWEEN a.col_startDate AND a.col_endDate
                        OR (a.col_startDate <= ? AND a.col_endDate = 'TFN'))
            WHERE a.uryyTteamoeSS4 IS NULL
              AND c.col_company_Id = ?
            ORDER BY c.team_first_name ASC
        ");
        $stmt->bind_param("sss", $selDate, $selDate, $_SESSION['usr_compId']);
    }
} else {
    // Filter by city
    if ($isSearch) {
        // Search within city
        $stmt = $conn->prepare("
            SELECT * FROM tbl_general_team_form
            WHERE col_company_Id = ?
              AND col_company_city = ?
              AND (team_first_name LIKE ? OR team_last_name LIKE ?)
            ORDER BY team_first_name ASC
        ");
        $stmt->bind_param("ssss", $_SESSION['usr_compId'], $varCookieCity, $search, $search);
    } else {
        // Non-search: city filter + unapproved status
        $stmt = $conn->prepare("
            SELECT c.team_first_name, c.team_last_name, c.team_date_of_birth,
                   c.col_company_city, c.col_company_Id, c.team_nationality,
                   c.team_primary_phone, c.team_city, c.uryyTteamoeSS4
            FROM tbl_general_team_form c
            LEFT JOIN tbl_team_status a
                   ON c.uryyTteamoeSS4 = a.uryyTteamoeSS4
                   AND a.col_approval = 'Approved'
                   AND (? BETWEEN a.col_startDate AND a.col_endDate
                        OR (a.col_startDate <= ? AND a.col_endDate = 'TFN'))
            WHERE a.uryyTteamoeSS4 IS NULL
              AND c.col_company_Id = ?
              AND c.col_company_city = ?
            ORDER BY c.team_first_name ASC
        ");
        $stmt->bind_param("ssss", $selDate, $selDate, $_SESSION['usr_compId'], $varCookieCity);
    }
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $output .= '<div class="table-responsive">
    <table class="table table-striped table-hover mb-0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date of birth</th>
            <th>Nationality</th>
            <th>Phone</th>
            <th>Assign run</th>
        </tr>
    </thead>';

    while ($trans = $result->fetch_assoc()) {
        $teamDOB = date('d M, Y', strtotime($trans['team_date_of_birth']));
        $output .= '
        <tr>
            <td>
                <div class="d-inline-block align-middle">
                    <img src="assets/images/profile/profile-icon.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                    <div class="d-inline-block">
                        <h6>' . $trans["team_first_name"] . ' ' . $trans["team_last_name"] . '</h6>
                    </div>
                </div>
            </td>
            <td>' . $teamDOB . '</td>
            <td>' . $trans["team_nationality"] . '</td>
            <td>' . $trans["team_primary_phone"] . '</td>
            <td>
                <form method="post" action="./processing-re-assign-call" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="txtCarerName" value="' . $trans["team_first_name"] . ' ' . $trans["team_last_name"] . '" />
                    <input type="hidden" name="txtNewCarerId" value="' . $trans["uryyTteamoeSS4"] . '" />
                    <input type="hidden" name="txtSelectedDate" value="' . $selDate . '" />
                    <input type="hidden" name="txtCurrentCarerId" value="' . ($_SESSION['carerUniqueId'] ?? '') . '" />
                    <input type="hidden" name="txtCareCalls" value="' . $_SESSION['get_care_calls'] . '" />
                    <input type="hidden" name="txtRunName" value="' . $_SESSION['get_run_name'] . '" />
                    <input type="hidden" name="txtClientSpecId" value="' . $_SESSION['get_client_Spec_Id'] . '" />
                    <input type="hidden" name="txtClientGroup" value="' . $_SESSION['userId'] . '" />
                    <button style="height:40px;" title="View carer profile" name="btnScheduleRuns" type="submit" class="btn btn-info btn-sm">
                        <i class="feather mr-2 icon-briefcase"></i> Assign run
                    </button>
                </form>
            </td>
        </tr>';
    }

    $output .= '</table></div>';
    echo $output;
} else {
    echo 'Data Not Found';
}

$stmt->close();
