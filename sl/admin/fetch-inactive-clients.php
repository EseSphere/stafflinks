<script>
    $('#selectAllCheckbox').change(function() {
        $('.checkboxes').prop('checked', $(this).prop('checked'));
    });
</script>

<?php
include('dbconnections.php');

$varGetAllData = 'Select all';
$varCookieCity = $_COOKIE['companyCity'] ?? null;
$search = trim($_POST['query'] ?? '');
$type = $_POST['type'] ?? '';
$today = date('Y-m-d');
$companyId = $_SESSION['usr_compId'] ?? '';

if (!$companyId) {
    echo 'Unauthorized access';
    exit;
}

$output = '';
$conn->set_charset("utf8mb4");

// choose reasons based on type
if ($type === 'temporary') {
    $inactiveReasons = "'Hospitalized','Holiday','With family','Inactive','Other'";
} elseif ($type === 'permanent') {
    $inactiveReasons = "'Deceased','Left Service','Permanent'";
} else {
    $inactiveReasons = "'Deceased','Left Service','Hospitalized','Inactive','Holiday','With family','Permanent','Other'";
}

$likeSearch = '%' . $search . '%';

// Subquery to get latest reason per client
$latestReasonSubquery = "
    SELECT t3.*
    FROM tbl_client_status_records t3
    INNER JOIN (
        SELECT col_client_Id, MAX(col_start_date) AS max_date
        FROM tbl_client_status_records
        GROUP BY col_client_Id
    ) t4 ON t3.col_client_Id = t4.col_client_Id AND t3.col_start_date = t4.max_date
    WHERE t3.col_end_date = 'TFN'
      AND t3.col_reason IN ($inactiveReasons)
";

// query depending on city filter
if ($varCookieCity === $varGetAllData || !$varCookieCity) {
    $sql = "
        SELECT 
            t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, 
            t1.client_poster_code, t1.client_sexuality, t1.client_preferred_name, 
            t1.client_date_of_birth, t1.client_area, t1.uryyToeSS4, t1.col_company_Id, 
            t2.col_reason, t2.col_status_color
        FROM tbl_general_client_form t1
        LEFT JOIN ($latestReasonSubquery) t2 ON t1.uryyToeSS4 = t2.col_client_Id
        WHERE t1.col_company_Id = ?
          AND (t1.client_first_name LIKE ? OR t1.client_last_name LIKE ?)
        ORDER BY t1.client_first_name ASC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $companyId, $likeSearch, $likeSearch);
} else {
    $sql = "
        SELECT 
            t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, 
            t1.client_poster_code, t1.client_sexuality, t1.client_preferred_name, 
            t1.client_date_of_birth, t1.client_area, t1.col_Office_Incharge,
            t1.uryyToeSS4, t1.col_company_Id, 
            t2.col_reason, t2.col_status_color
        FROM tbl_general_client_form t1
        LEFT JOIN ($latestReasonSubquery) t2 ON t1.uryyToeSS4 = t2.col_client_Id
        WHERE t1.col_Office_Incharge = ?
          AND t1.col_company_Id = ?
          AND (t1.client_first_name LIKE ? OR t1.client_last_name LIKE ?)
        ORDER BY t1.client_first_name ASC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $varCookieCity, $companyId, $likeSearch, $likeSearch);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $output .= '<div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Primary phone</th>
                    <th>Groups</th>
                    <th>Date of birth</th>
                    <th>Post code</th>
                    <th>Gender</th>
                    <th class="text-left">Preferred name</th>
                    <th>Profile</th>
                </tr>
            </thead><tbody>';
    while ($trans = $result->fetch_assoc()) {
        $clientDOB = $trans['client_date_of_birth'] ? date('d M, Y', strtotime($trans['client_date_of_birth'])) : '';
        $output .= '
            <tr>
                <td>
                    <a style="cursor:pointer; text-decoration:none; color:#000;" href="./client-details?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '">
                        <div class="d-inline-block align-middle">
                            <div class="d-inline-block">
                                <h6>' . htmlspecialchars($trans["client_first_name"]) . ' ' . htmlspecialchars($trans["client_last_name"]) . '</h6>
                                <p class="m-b-0" style="padding:3px 0 3px 10px; border-radius:50px; color:' . htmlspecialchars($trans["col_status_color"]) . ';"><strong>' . htmlspecialchars($trans["col_reason"]) . '</strong></p>
                            </div>
                        </div>
                    </a>
                </td>
                <td>0' . htmlspecialchars($trans["client_primary_phone"]) . '</td>
                <td>' . htmlspecialchars($trans["client_area"]) . '</td>
                <td>' . $clientDOB . '</td>
                <td>' . htmlspecialchars($trans["client_poster_code"]) . '</td>
                <td>' . htmlspecialchars($trans["client_sexuality"]) . '</td>
                <td>' . htmlspecialchars($trans["client_preferred_name"]) . '</td>
                <td>
                    <a href="./client-task?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client task" type="button" class="btn btn-primary btn-sm"><i class="feather mr-2 icon-list"></i></button></a>
                    <a href="./client-medication?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client medication" type="button" class="btn btn-danger btn-sm"><i class="feather mr-2 icon-heart"></i></button></a>
                    <a href="./client-details?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client details" type="button" class="btn btn-info btn-sm"><i class="feather mr-2 icon-eye"></i></button></a>
                </td>
            </tr>';
    }
    $output .= '</tbody></table></div>';
    echo $output;
} else {
    echo 'Data Not Found';
}

$stmt->close();
$conn->close();
?>