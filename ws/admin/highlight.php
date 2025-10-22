<?php
include('client-header-contents.php');

// Validate clientId
$clientId = $_GET['uryyToeSS4'] ?? null;
$companyId = $_SESSION['usr_compId'] ?? null;

if (!$clientId || !$companyId) {
    die("No client selected or session expired.");
}

// Fetch About Me details
$stmt = $conn->prepare("
    SELECT client_first_name, client_last_name, client_ailment, client_highlights, client_service, 
           what_is_important_to_me, my_medical_history, my_likes_and_dislikes, my_current_condition, 
           my_physical_health, my_mental_health, how_i_communicate, assistive_equipment_i_use
    FROM tbl_general_client_form 
    WHERE uryyToeSS4 = ? AND col_company_Id = ?
");
$stmt->bind_param("ss", $clientId, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();
$stmt->close();

// Build full name safely
$fullName = trim(($client['client_first_name'] ?? '') . ' ' . ($client['client_last_name'] ?? ''));

// Fields and labels
$fields = [
    'client_ailment'            => 'Client Ailment',
    'client_highlights'         => 'Highlights',
    'client_service'            => 'Service',
    'what_is_important_to_me'   => 'What is Important to Me',
    'my_medical_history'        => 'Medical History',
    'my_likes_and_dislikes'     => 'Likes & Dislikes',
    'my_current_condition'      => 'Current Condition',
    'my_physical_health'        => 'Physical Health',
    'my_mental_health'          => 'Mental Health',
    'how_i_communicate'         => 'How I Communicate',
    'assistive_equipment_i_use' => 'Assistive Equipment I Use'
];

// Helper to render field
function renderField($label, $value)
{
    $value = trim($value);
    if ($value === '') {
        $value = "<span class='text-muted'>Not provided</span>";
    } else {
        $value = nl2br(htmlspecialchars($value));
    }
    echo "<h6 class='fw-bold mt-5'>" . htmlspecialchars($label) . "</h6>";
    echo "<p>$value</p>";
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <!-- About Me Section -->
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-3 ">
                    <h3>About Me</h3>
                    <div class="no-print">
                        <a href="./view-client-details.php?uryyToeSS4=<?= urlencode($clientId); ?>"
                            class="btn btn-outline-primary me-2">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <button onclick="printDiv('printArea')" class="btn btn-outline-success">
                            Print
                        </button>
                    </div>
                </div>

                <!-- Printable Area -->
                <div id="printArea">
                    <div class="card shadow-sm w-100">
                        <div class="card-body">
                            <!-- Client Name inside card body -->
                            <h4 class="fw-bold mb-4">
                                <?= htmlspecialchars($fullName ?: 'Unknown Client'); ?>
                            </h4>

                            <?php
                            $hasData = false;
                            foreach ($fields as $field => $label) {
                                if (!empty($client[$field])) {
                                    renderField($label, $client[$field]);
                                    $hasData = true;
                                }
                            }
                            if (!$hasData) {
                                echo "<p class='text-muted'>No About Me information provided.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>
<?php include('footer-contents.php'); ?>


<script>
function printDiv(divId) {
    let content = document.getElementById(divId).innerHTML;
    let myWindow = window.open('', '', 'width=900,height=650');
    myWindow.document.write(`
        <html>
            <head>
                <title>Print</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    .card { border: none; width: 100%; }
                    h4 { font-size: 22px; margin-bottom: 15px; }
                    h6 { font-size: 16px; margin-top: 25px; }
                    p { font-size: 14px; }
                </style>
            </head>
            <body>${content}</body>
        </html>
    `);
    myWindow.document.close();
    myWindow.focus();
    myWindow.print();
    myWindow.close();
}
</script>