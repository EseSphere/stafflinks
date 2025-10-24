<?php
include('dbconnections.php');
$output = '';
if (!isset($_SESSION['usr_compId'])) {
    echo 'Unauthorized access.';
    exit;
}

$searchMode = isset($_POST["query"]);
$searchTerm = $searchMode ? trim($_POST["query"]) : '';
$searchTerm = htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8');

if ($searchMode) {
    $query = "SELECT * FROM tbl_pay_rate 
              WHERE col_name LIKE CONCAT('%', ?, '%') 
              OR col_service_type LIKE CONCAT('%', ?, '%')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
} else {
    $companyId = $_SESSION['usr_compId'];
    $query = "SELECT * FROM tbl_pay_rate 
              WHERE col_company_Id = ? 
              ORDER BY col_name ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $companyId);
}

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $output .= '
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>Rate name</th>
                    <th>Rate</th>
                    <th>Last updated at</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>';

        while ($trans = $result->fetch_assoc()) {
            $rateName = htmlspecialchars($trans["col_name"], ENT_QUOTES, 'UTF-8');
            $payRate = htmlspecialchars($trans["col_rates"], ENT_QUOTES, 'UTF-8');
            $lastUpdated = htmlspecialchars($trans["col_date"], ENT_QUOTES, 'UTF-8');
            $specialId = urlencode($trans["col_special_Id"]);

            $output .= "
                <tr>
                    <td>
                        <div class='d-inline-block align-middle'>
                            <img src='assets/images/profile/profile-icon.jpg' alt='user image' class='img-radius wid-40 align-top m-r-15'>
                            <div class='d-inline-block'>
                                <h6>{$rateName}</h6>
                            </div>
                        </div>
                    </td>
                    <td>£{$payRate}</td>
                    <td>{$lastUpdated}</td>
                    <td>
                        <a href='./edit-pay-rate?col_special_Id={$specialId}' style='text-decoration: none;'>
                            <button title='Edit pay rate details' type='button' class='btn btn-primary btn-sm'>
                                <i class='feather mr-2 icon-edit'></i>
                            </button>
                        </a>
                    </td>
                </tr>";
        }

        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo 'No records found.';
    }
} else {
    echo 'An error occurred while fetching data.';
}

$stmt->close();
$conn->close();
