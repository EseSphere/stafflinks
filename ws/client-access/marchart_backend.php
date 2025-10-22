<?php
if (isset($_GET['uryyToeSS4'])) {
    $myuryyToeSS4 = $_GET['uryyToeSS4'];
}
// Get selected month, year, and uryyToeSS4 from URL parameters
$selected_month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$selected_year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$uryyToeSS4 = isset($_GET['uryyToeSS4']) ? $_GET['uryyToeSS4'] : '';

if (empty($uryyToeSS4)) {
    die("Error: Missing authentication token.");
}

// Debugging: Print values
//echo "<pre>";
//echo "Selected Month: " . $selected_month . "\n";
//echo "Selected Year: " . $selected_year . "\n";
//echo "uryyToeSS4: " . htmlspecialchars($uryyToeSS4) . "\n";
//echo "</pre>";

// Sanitize uryyToeSS4
$uryyToeSS4 = $conn->real_escape_string($uryyToeSS4);
$sql = "SELECT task_name, med_date FROM tbl_finished_meds 
        WHERE (uryyToeSS4 = ? 
        AND MONTH(med_date) = ? AND YEAR(med_date) = ?)
        ORDER BY med_date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $uryyToeSS4, $selected_month, $selected_year);
$stmt->execute();
$result = $stmt->get_result();

// Debugging: Check if query returns results
if (!$result) {
    die("Query Error: " . $stmt->error);
}

$medications = [];
$dates = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $med_name = $row['task_name'];
        $med_date = $row['med_date']; // Store the original date format
        $formatted_date = date("jS M", strtotime($med_date)); // Format for display

        $medications[$med_name][$med_date] = $formatted_date;
        $dates[$med_date] = $formatted_date;
    }
} else {
}

// Sort dates in ascending order using original values
ksort($dates);

// Previous and next month calculations
$prev_month = $selected_month - 1;
$next_month = $selected_month + 1;
$prev_year = $selected_year;
$next_year = $selected_year;

if ($prev_month < 1) {
    $prev_month = 12;
    $prev_year--;
}
if ($next_month > 12) {
    $next_month = 1;
    $next_year++;
}

$myuryyToeSS4 = $conn->real_escape_string($myuryyToeSS4); // fallback if not using prepared stmt
$companyId = $_SESSION['usr_compId'] ?? '';
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("ss", $myuryyToeSS4, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$showRows = $result->fetch_assoc();
$clientFirstName = $showRows['client_first_name'] ?? '';
$stmt->close();
