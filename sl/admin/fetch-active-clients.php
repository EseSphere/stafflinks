<script>
    $('#selectAllCheckbox').change(function() {
        $('.checkboxes').prop('checked', $(this).prop('checked'));
    });
</script>
<?php
include('dbconnections.php');
$varGetAllData = 'Select all';
$varCookieCity = $_COOKIE['companyCity'] ?? null;
$search = $_POST['query'] ?? null;
$companyId = $_SESSION['usr_compId'] ?? null;
$today = date('Y-m-d');
if (!$companyId) {
    echo 'Invalid session';
    exit;
}
if ($varGetAllData === $varCookieCity) {
    if ($search) {
        $searchParam = "%{$search}%";
        $stmt = $conn->prepare("
     SELECT t1.id, t1.client_first_name, t1.client_last_name, 
            t1.client_primary_phone, t1.client_poster_code, t1.client_sexuality, 
            t1.client_preferred_name, t1.client_date_of_birth, t1.client_area, 
            t1.uryyToeSS4, t1.col_company_Id
     FROM tbl_general_client_form t1
     WHERE (t1.client_first_name LIKE ? OR t1.client_last_name LIKE ?)
       AND NOT EXISTS (
             SELECT 1 
             FROM tbl_client_status_records t2
             WHERE t1.uryyToeSS4 = t2.col_client_Id
               AND (
                    (CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) 
                    OR (t2.col_start_date <= ? AND t2.col_end_date = 'TFN')
               )
       )
     GROUP BY t1.uryyToeSS4 ORDER BY t1.client_first_name ASC
 ");

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $searchParam, $searchParam, $today);
    } else {
        $stmt = $conn->prepare("
    SELECT t1.id, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, 
           t1.client_poster_code, t1.client_sexuality, t1.client_preferred_name, t1.client_date_of_birth, 
           t1.client_area, t1.uryyToeSS4, t1.col_company_Id, t2.col_reason, t2.col_status_color, t2.col_end_date 
    FROM tbl_general_client_form t1
    LEFT JOIN tbl_client_status_records t2 
        ON t1.uryyToeSS4 = t2.col_client_Id 
        AND ((CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) OR (t2.col_start_date <= ? AND t2.col_end_date = 'TFN'))
    WHERE t1.col_company_Id = ?
      AND ((t2.col_reason NOT IN ('Deceased', 'Left Service', 'Hospitalized', 'Inactive', 'Holiday', 'With family', 'Permanent', 'Other') OR t2.col_reason IS NULL))
    ORDER BY t1.client_first_name ASC
");
        $stmt->bind_param("ss", $today, $companyId);
    }
} else {
    if (!$varCookieCity) {
        echo 'City not specified';
        exit;
    }
    if ($search) {
        $searchParam = "%{$search}%";
        $stmt = $conn->prepare("
            SELECT t1.id, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, t1.client_poster_code, 
                   t1.client_city, t1.client_sexuality, t1.client_preferred_name, t1.client_date_of_birth, 
                   t1.client_area, t1.col_Office_Incharge, t1.uryyToeSS4, t1.col_company_Id, t2.col_reason, t2.col_status_color 
            FROM tbl_general_client_form t1
            LEFT JOIN tbl_client_status_records t2 
                ON t1.uryyToeSS4 = t2.col_client_Id 
                AND ((CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) OR (t2.col_start_date <= ? AND t2.col_end_date = 'TFN'))
            WHERE t1.col_Office_Incharge = ?
              AND (t1.client_first_name LIKE ? OR t1.client_last_name LIKE ?)
              GROUP BY t1.uryyToeSS4 ORDER BY t1.client_first_name ASC");
        $stmt->bind_param("ssss", $today, $varCookieCity, $searchParam, $searchParam);
    } else {
        $stmt = $conn->prepare("
            SELECT t1.id, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, 
                   t1.client_poster_code, t1.client_sexuality, t1.client_preferred_name, t1.client_date_of_birth, 
                   t1.client_area, t1.col_Office_Incharge, t1.uryyToeSS4, t1.col_company_Id, t2.col_reason, t2.col_status_color, t2.col_end_date 
            FROM tbl_general_client_form t1
            LEFT JOIN tbl_client_status_records t2 
                ON t1.uryyToeSS4 = t2.col_client_Id 
                AND ((CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) OR (t2.col_start_date <= ? AND t2.col_end_date = 'TFN'))
            WHERE t1.col_Office_Incharge = ?
              AND t1.col_company_Id = ?
              AND ((t2.col_reason NOT IN ('Deceased', 'Left Service', 'Hospitalized', 'Inactive', 'Holiday', 'With family', 'Permanent', 'Other') OR t2.col_reason IS NULL))
            ORDER BY t1.client_first_name ASC
        ");
        $stmt->bind_param("sss", $today, $varCookieCity, $companyId);
    }
}
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $output = '<div class="table-responsive">
                   <table class="table table-striped table-hover mb-0">
                   <thead>
                       <tr>
                           <th>Name</th>
                           <th>Primary phone</th>
                           <th>Groups</th>
                           <th>Date of birth</th>
                           <th>Post code</th>
                           <th>Gender</th>
                           <th class=" text-left">Preferred name</th>
                           <th>Profile</th>
                       </tr>
                   </thead>';
    while ($trans = $result->fetch_assoc()) {
        $clientDOB = date('d M, Y', strtotime($trans['client_date_of_birth']));
        $output .= '
            <tr>
                <td>
                    <a style="cursor:pointer; text-decoration:none; color:#000;" href="./client-details?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '">
                        <div class="d-inline-block align-middle">
                            <div class="d-inline-block">
                                <h6>' . htmlspecialchars($trans["client_first_name"]) . ' ' . htmlspecialchars($trans["client_last_name"]) . '</h6>
                            </div>
                        </div>
                    </a>
                </td>
                <td>' . htmlspecialchars($trans["client_primary_phone"]) . '</td>
                <td>' . htmlspecialchars($trans["client_area"]) . '</td>
                <td>' . $clientDOB . '</td>
                <td>' . htmlspecialchars($trans["client_poster_code"]) . '</td>
                <td>' . htmlspecialchars($trans["client_sexuality"]) . '</td>
                <td>' . htmlspecialchars($trans["client_preferred_name"]) . '</td>
                <td>
                    <a style="text-decoration:none;" href="./client-task?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client task" type="button" class="btn btn-primary btn-sm"><i class="feather mr-2 icon-list"></i></button></a>
                    <a style="text-decoration:none;" href="./client-medication?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client medication" type="button" class="btn btn-danger btn-sm"><i class="feather mr-2 icon-heart"></i></button></a>
                    <a style="text-decoration:none;" href="./client-details?uryyToeSS4=' . urlencode($trans["uryyToeSS4"]) . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client details" type="button" class="btn btn-info btn-sm"><i class="feather mr-2 icon-eye"></i></button></a>
                </td>
            </tr>';
    }
    $output .= '</table></div>';
    echo $output;
} else {
    echo 'Data Not Found';
}
$stmt->close();
$conn->close();
