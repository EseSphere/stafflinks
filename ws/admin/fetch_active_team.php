<?php
include('dbconnections.php');

$companyCity = isset($_COOKIE['companyCity']) ? htmlspecialchars($_COOKIE['companyCity'], ENT_QUOTES, 'UTF-8') : '';
$companyId = isset($_SESSION['usr_compId']) ? intval($_SESSION['usr_compId']) : 0;
$today = date('Y-m-d');

$allDataView = ($companyCity === 'Select all');
$output = '';

$search = isset($_POST["query"]) ? '%' . $_POST["query"] . '%' : null;

// Base SQL with NOT EXISTS to hide approved teams within the date range
$baseSql = "
SELECT t1.userId, t1.team_first_name, t1.team_last_name, t1.team_primary_phone, 
       t1.team_poster_code, t1.team_sexuality, t1.team_nationality, t1.team_date_of_birth, 
       t1.team_city, t1.uryyTteamoeSS4, t1.col_company_Id
FROM tbl_general_team_form t1
WHERE NOT EXISTS (
    SELECT 1 FROM tbl_team_status t2 
    WHERE t2.uryyTteamoeSS4 = t1.uryyTteamoeSS4 
      AND t2.col_approval = 'Approved' 
      AND (CURDATE() BETWEEN t2.col_startDate AND t2.col_endDate OR (t2.col_endDate = 'TFN' AND t2.col_startDate <= CURDATE()))
)
";

$params = [];
$types = "";

// Add company filtering if not selecting all
if (!$allDataView) {
    $baseSql .= " AND t1.col_company_city = ? AND t1.col_company_Id = ?";
    $types .= "si";
    $params[] = $companyCity;
    $params[] = $companyId;
} elseif (!$allDataView && $companyCity) {
    $baseSql .= " AND t1.col_company_Id = ?";
    $types .= "i";
    $params[] = $companyId;
}

// Add search filtering
if ($search) {
    $baseSql .= " AND (t1.team_first_name LIKE ? OR t1.team_last_name LIKE ?)";
    $types .= "ss";
    $params[] = $search;
    $params[] = $search;
}

$baseSql .= " ORDER BY t1.team_first_name ASC";

$stmt = $conn->prepare($baseSql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Generate output table
if ($result->num_rows > 0) {
    $output .= '<div class="table-responsive">
    <table class="table table-striped table-hover mb-0">
    <thead>
    <tr>
    <th><input type="checkbox" id="selectAllCheckbox"></th>
    <th>Name</th>
    <th>Date of birth</th>
    <th>Nationality</th>
    <th>Phone</th>
    <th>Gender</th>
    <th class="text-left">City based</th>
    <th>Profile</th>
    </tr>
    </thead>';

    while ($row = $result->fetch_assoc()) {
        $teamDOB = date('d M, Y', strtotime($row['team_date_of_birth']));

        $output .= '
        <tr>
        <td><input type="checkbox" class="checkboxes" name="txtSelectedId[]" value="' . intval($row["userId"]) . '"></td>
        <td>
            <a href="./team-details?uryyTteamoeSS4=' . urlencode($row["uryyTteamoeSS4"]) . '" class="text-dark text-decoration-none">
                <div class="d-inline-block align-middle">
                    <img src="assets/images/profile/profile-icon.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                    <div class="d-inline-block">
                        <h6>' . htmlspecialchars($row["team_first_name"]) . ' ' . htmlspecialchars($row["team_last_name"]) . '</h6>
                    </div>
                </div>
            </a>
        </td>
        <td>' . $teamDOB . '</td>
        <td>' . htmlspecialchars($row["team_nationality"]) . '</td>
        <td>0' . htmlspecialchars($row["team_primary_phone"]) . '</td>
        <td>' . htmlspecialchars($row["team_sexuality"]) . '</td>
        <td>' . htmlspecialchars($row["team_city"]) . '</td>
        <td>
            <a href="./team-details?uryyTteamoeSS4=' . urlencode($row["uryyTteamoeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '" class="btn btn-info btn-sm" title="View carer profile">
                <i class="feather mr-2 icon-eye"></i>
            </a>
        </td>
        </tr>';
    }
    $output .= '</table></div>';
} else {
    $output = 'City not specified';
}

echo $output;
