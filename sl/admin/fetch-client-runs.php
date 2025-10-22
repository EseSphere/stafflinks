<style>
    .pagination .page-link {
        font-size: 0.88rem;
        padding: 0.30rem 0.7rem;
        margin: 0 5px;
        background-color: #f8f9fa;
        color: #6c757d;
        border: 1x solid #dee2e6;
        transition: all 0.2s ease;
    }

    .pagination .active .page-link {
        background-color: #007bff;
        color: #ffffff;
        border-color: #6c757d;
    }

    .pagination .disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
</style>

<?php
include('dbconnections.php');
if (!isset($_SESSION['usr_compId'])) {
    exit('Unauthorized Access');
}

$companyCity = $_COOKIE["companyCity"] ?? '';
$compId = $_SESSION['usr_compId'];
$varGetAllData = 'Select all';
$searchQuery = $_POST['query'] ?? '';
$page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int) $_POST['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$searchCondition = '';
$params = [];
$paramTypes = '';

if (!empty($searchQuery)) {
    $searchQuery = '%' . $searchQuery . '%';
    $searchCondition = " AND (run_name LIKE ? OR run_town LIKE ?)";
    $params[] = $searchQuery;
    $params[] = $searchQuery;
    $paramTypes .= 'ss';
}

if ($varGetAllData === $companyCity) {
    $query = "SELECT * FROM tbl_client_runs WHERE col_company_Id = ? $searchCondition GROUP BY run_name ORDER BY userId ASC LIMIT ? OFFSET ?";
    $params = array_merge([$compId], $params);
    $paramTypes = 's' . $paramTypes . 'ii';
    $params[] = $limit;
    $params[] = $offset;

    $countQuery = "SELECT COUNT(DISTINCT run_name) as total FROM tbl_client_runs WHERE col_company_Id = ? $searchCondition";
    $countParams = array_merge([$compId], array_slice($params, 1, -2));
    $countTypes = substr($paramTypes, 0, -2);
} else {
    $query = "SELECT * FROM tbl_client_runs WHERE col_run_city = ? AND col_company_Id = ? $searchCondition GROUP BY run_name ORDER BY userId ASC LIMIT ? OFFSET ?";
    $params = array_merge([$companyCity, $compId], $params);
    $paramTypes = 'ss' . $paramTypes . 'ii';
    $params[] = $limit;
    $params[] = $offset;

    $countQuery = "SELECT COUNT(DISTINCT run_name) as total FROM tbl_client_runs WHERE col_run_city = ? AND col_company_Id = ? $searchCondition";
    $countParams = array_merge([$companyCity, $compId], array_slice($params, 2, -2));
    $countTypes = substr($paramTypes, 0, -2);
}

$stmt = $conn->prepare($query);
$stmt->bind_param($paramTypes, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$output = '';

if ($result->num_rows > 0) {
    $output .= '<div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Run name</th>
                                <th>Town located</th>
                                <th>Decision</th>
                            </tr>
                        </thead>
                        <tbody>';

    while ($trans = $result->fetch_assoc()) {
        $runDateTime = htmlspecialchars($trans['dateTime']);
        $runName = htmlspecialchars($trans['run_name']);
        $runTown = htmlspecialchars($trans['run_town']);
        $runIds = urlencode($trans['run_ids']);
        $runCity = urlencode($trans['col_run_city']);

        $output .= "<tr>
            <td>
                <div class='d-inline-block align-middle'>
                    <div class='d-inline-block'>
                        <h6>{$runName}</h6>
                        <p class='m-b-0'><strong>{$runDateTime}</strong></p>
                    </div>
                </div>
            </td>
            <td>{$runTown}</td>
            <td>
                <a href='./attach-clients?specId={$runIds}&city={$runCity}&u7ye={$crackEncryptedbinary}'><button class='btn btn-info btn-sm'><i class='feather icon-eye'></i></button></a>
                <a href='./delete-run?run_ids={$runIds}&u7ye={$crackEncryptedbinary}'><button class='btn btn-danger btn-sm'><i class='feather icon-trash'></i></button></a>
            </td>
        </tr>";
    }

    $output .= '</tbody></table></div>';

    // Get total pages
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param($countTypes, ...$countParams);
    $stmt->execute();
    $countResult = $stmt->get_result();
    $totalRows = $countResult->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $limit);

    $output .= '<nav class="mt-4 px-3">
    <ul class="pagination justify-content-start">';

    $output .= '<li class="page-item ' . ($page <= 1 ? 'disabled' : '') . '">
                    <a class="page-link" href="#" data-page="' . max(1, $page - 1) . '">Previous</a>
                </li>';

    $range = 5;
    $start = max(1, $page - floor($range / 2));
    $end = min($totalPages, $start + $range - 1);

    if ($start > 1) {
        $output .= '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
        $output .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }

    for ($i = $start; $i <= $end; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $output .= "<li class='page-item $active'><a class='page-link' href='#' data-page='$i'>$i</a></li>";
    }

    if ($end < $totalPages) {
        $output .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        $output .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $totalPages . '">' . $totalPages . '</a></li>';
    }

    $output .= '<li class="page-item ' . ($page >= $totalPages ? 'disabled' : '') . '">
                    <a class="page-link" href="#" data-page="' . min($totalPages, $page + 1) . '">Next</a>
                </li>';

    $output .= '</ul></nav>';
} else {
    $output = '<div class="text-center py-3">No runs found.</div>';
}

echo $output;
