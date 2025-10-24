<?php
include('dbconnections.php');

$output = '';

$limit = 10;
$page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

// ✅ Base query (filter by company)
$baseQuery = "SELECT * FROM tbl_invoice_rate WHERE col_company_Id = ?";
$params = [$_SESSION['usr_compId']];
$paramTypes = 'i';

// ✅ Optional search filter
if (!empty($_POST["query"])) {
    $search = "%" . $_POST["query"] . "%";
    $baseQuery .= " AND col_name LIKE ?";
    $params[] = $search;
    $paramTypes .= 's';
}

// ✅ Count query for pagination
$countQuery = "SELECT COUNT(*) FROM tbl_invoice_rate WHERE col_company_Id = ?";
$countParams = [$_SESSION['usr_compId']];
$countParamTypes = 'i';

if (!empty($_POST["query"])) {
    $countQuery .= " AND col_name LIKE ?";
    $countParams[] = $search;
    $countParamTypes .= 's';
}

$stmtCount = $conn->prepare($countQuery);
$stmtCount->bind_param($countParamTypes, ...$countParams);
$stmtCount->execute();
$stmtCount->bind_result($totalRecords);
$stmtCount->fetch();
$stmtCount->close();

$totalPages = ceil($totalRecords / $limit);

// ✅ Add pagination to main query
$baseQuery .= " ORDER BY col_name ASC LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;
$paramTypes .= 'ii';

$stmt = $conn->prepare($baseQuery);
$stmt->bind_param($paramTypes, ...$params);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $output .= '
    <table class="table table-striped table-hover mb-0">
        <thead>
            <tr>
                <th>Rate name</th>
                <th>Invoice rate</th>
                <th>Last updated at</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($trans = $result->fetch_assoc()) {
        // ✅ Safely handle missing date or rate values
        $date = !empty($trans['col_date'])
            ? DateTime::createFromFormat('Y-m-d', $trans['col_date'])
            : null;

        // ✅ Fix: Handle missing or differently named rate column
        // (try col_rate, then col_invoice_rate, then fallback)
        $InvoiceRate = htmlspecialchars($trans['col_rate'] ?? $trans['col_rates'] ?? '0.00');

        // ✅ Format date safely
        $varInvoiceDate = $date ? $date->format('d M, Y') : 'N/A';

        $output .= '
        <tr>
            <td>
                <div class="d-inline-block align-middle">
                    <div class="d-inline-block">
                        <h6>' . htmlspecialchars($trans["col_name"] ?? 'N/A') . '</h6>
                    </div>
                </div>
            </td>
            <td>' . $InvoiceRate . '</td>
            <td>' . $varInvoiceDate . '</td>
            <td>
                <a style="text-decoration:none;" href="./invoicing-rate?col_special_Id=' . urlencode($trans["col_special_Id"] ?? '') . '">
                    <button title="View invoice rate" type="button" class="btn btn-primary btn-sm">
                        <i class="feather mr-2 icon-eye"></i>
                    </button>
                </a>
            </td>
        </tr>';
    }

    $output .= '</tbody></table>';

    // ✅ Pagination
    $output .= '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center mt-3">';
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i === $page) ? ' active' : '';
        $output .= '<li class="page-item' . $activeClass . '">
                        <button class="page-link" onclick="loadPage(' . $i . ')">' . $i . '</button>
                    </li>';
    }
    $output .= '</ul></nav>';

    echo $output;
} else {
    echo '<div class="alert alert-warning">Data Not Found</div>';
}

// ✅ Close resources
$stmt->close();
$conn->close();
