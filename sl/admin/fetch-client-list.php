<?php
include('dbconnections.php');
$varGetAllData = 'Select all';
$varCookieCity = isset($_COOKIE["companyCity"]) ? $_COOKIE["companyCity"] : null;
$today = date('Y-m-d');

function getClientRows($conn, $query, $params = [])
{
    $stmt = $conn->prepare($query);
    if ($params) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt->get_result();
}

// Subquery template for latest reason
$latestReasonSubquery = "
    SELECT t3.*
    FROM tbl_client_status_records t3
    INNER JOIN (
        SELECT col_client_Id, MAX(col_start_date) AS max_date
        FROM tbl_client_status_records
        GROUP BY col_client_Id
    ) t4 ON t3.col_client_Id = t4.col_client_Id AND t3.col_start_date = t4.max_date
";

$output = '';

if ($varCookieCity === $varGetAllData) {
    if (isset($_POST["query"])) {
        $search = '%' . $_POST["query"] . '%';
        $query = "
            SELECT t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, t1.client_poster_code, 
                   t1.client_sexuality, t1.client_preferred_name, t1.client_date_of_birth, t1.client_area, t1.uryyToeSS4, t1.col_company_Id, 
                   t2.col_reason, t2.col_status_color 
            FROM tbl_general_client_form t1
            LEFT JOIN ($latestReasonSubquery) t2 ON t1.uryyToeSS4 = t2.col_client_Id
            WHERE t1.client_first_name LIKE ? 
               OR t1.client_last_name LIKE ? 
               OR t1.client_middle_name LIKE ? 
            ORDER BY t1.client_first_name ASC";
        $result = getClientRows($conn, $query, [$search, $search, $search]);
    } else {
        $query = "
            SELECT t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, t1.client_poster_code, 
                   t1.client_sexuality, t1.client_preferred_name, t1.client_date_of_birth, t1.client_area, t1.uryyToeSS4, t1.col_company_Id, 
                   t2.col_reason, t2.col_status_color 
            FROM tbl_general_client_form t1
            LEFT JOIN ($latestReasonSubquery) t2 ON t1.uryyToeSS4 = t2.col_client_Id
            WHERE t1.col_company_Id = ? 
            ORDER BY t1.client_first_name ASC";
        $result = getClientRows($conn, $query, [$_SESSION['usr_compId']]);
    }
} elseif ($varCookieCity !== null) {
    if (isset($_POST["query"])) {
        $search = '%' . $_POST["query"] . '%';
        $query = "
            SELECT t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, t1.client_poster_code, t1.client_city, 
                   t1.client_sexuality, t1.client_preferred_name, t1.client_date_of_birth, t1.client_area, t1.col_Office_Incharge, t1.uryyToeSS4, t1.col_company_Id, 
                   t2.col_reason, t2.col_status_color 
            FROM tbl_general_client_form t1
            LEFT JOIN ($latestReasonSubquery) t2 ON t1.uryyToeSS4 = t2.col_client_Id
            WHERE t1.col_Office_Incharge = ? 
              AND (t1.client_first_name LIKE ? 
                   OR t1.client_last_name LIKE ? 
                   OR t1.client_middle_name LIKE ?)";
        $result = getClientRows($conn, $query, [$varCookieCity, $search, $search, $search]);
    } else {
        $query = "
            SELECT t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, t1.client_poster_code, t1.client_city, 
                   t1.client_sexuality, t1.client_preferred_name, t1.client_date_of_birth, t1.client_area, t1.col_Office_Incharge, t1.uryyToeSS4, t1.col_company_Id, 
                   t2.col_reason, t2.col_status_color 
            FROM tbl_general_client_form t1
            LEFT JOIN ($latestReasonSubquery) t2 ON t1.uryyToeSS4 = t2.col_client_Id
            WHERE t1.col_Office_Incharge = ? 
              AND t1.col_company_Id = ? 
            ORDER BY t1.client_first_name ASC";
        $result = getClientRows($conn, $query, [$varCookieCity, $_SESSION['usr_compId']]);
    }
} else {
    echo 'Data Not Found';
    exit;
}

if ($result && $result->num_rows > 0) {
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
                            <th class=" text-left">Preferred name</th>
                            <th>Profile</th>
                        </tr>
                    </thead>';
    while ($trans = $result->fetch_assoc()) {
        $clientDOB = date('d M, Y', strtotime($trans['client_date_of_birth']));
        $output .= '
            <tr>
                <td>
                    <a style="cursor:pointer; text-decoration:none; color:#000;" href="./client-details?uryyToeSS4=' . $trans["uryyToeSS4"] . '&u7ye=' . $crackEncryptedbinary . '">
                        <div class="d-inline-block align-middle">
                            <div class="d-inline-block">
                                <h6>' . htmlspecialchars($trans["client_first_name"]) . ' ' . htmlspecialchars($trans["client_last_name"]) . '</h6>
                                <p class="m-b-0" style="padding:3px 0px 3px 10px; border-radius:50px; color:' . htmlspecialchars($trans["col_status_color"]) . ';"><strong>' . htmlspecialchars($trans["col_reason"]) . '</strong></p>
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
                    <a style="text-decoration:none;" href="./client-task?uryyToeSS4=' . $trans["uryyToeSS4"] . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client task" type="button" class="btn btn-primary btn-sm"><i class="feather mr-2 icon-list"></i></button></a>
                    <a style="text-decoration:none;" href="./client-medication?uryyToeSS4=' . $trans["uryyToeSS4"] . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client medication" type="button" class="btn btn-danger btn-sm"><i class="feather mr-2 icon-heart"></i></button></a>
                    <a style="text-decoration:none;" href="./client-details?uryyToeSS4=' . $trans["uryyToeSS4"] . '&u7ye=' . $crackEncryptedbinary . '"><button title="View client details" type="button" class="btn btn-info btn-sm"><i class="feather mr-2 icon-eye"></i></button></a>
                </td>
            </tr>';
    }
    echo $output;
} else {
    echo 'Data Not Found';
}
