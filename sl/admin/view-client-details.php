<?php
include('client-header-contents.php');
// Validate clientId
$clientId = $_GET['uryyToeSS4'] ?? null;
$companyId = $_SESSION['usr_compId'] ?? null;

if (!$clientId || !$companyId) {
    die("Client not found or session expired.");
}

// Fetch client info securely
$stmt = $conn->prepare("
    SELECT * FROM tbl_general_client_form 
    WHERE uryyToeSS4 = ? AND col_company_Id = ? LIMIT 1
");
$stmt->bind_param("ss", $clientId, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();
$stmt->close();

if (!$client) {
    die("No client data found.");
}

// Helper function to render tables
function render_table($data, $fields)
{
    echo "<table class='table table-bordered mb-3 text-start print-table'>";
    foreach ($fields as $field => $label) {
        $value = $data[$field] ?? null;
        if ($value) {
            echo "<tr><th style='width:30%;'>" . htmlspecialchars($label) . "</th><td>" . htmlspecialchars($value) . "</td></tr>";
        } else {
            echo "<tr><th style='width:30%;'>" . htmlspecialchars($label) . "</th><td class='text-muted'>Not provided</td></tr>";
        }
    }
    echo "</table>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Client Full Details -
        <?= htmlspecialchars($client['client_first_name'] . ' ' . $client['client_last_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card-header.basic {
            background-color: #6c757d;
            color: #fff;
        }

        .card-header.funding {
            background-color: #adb5bd;
            color: #212529;
        }

        .card-header.nok {
            background-color: #6c757d;
            color: #fff;
        }

        .card-header.medical {
            background-color: #f08080;
            color: #212529;
        }

        .card-header.future {
            background-color: #495057;
            color: #fff;
        }

        .card-header.about {
            background-color: #17a2b8;
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }

        @media print {

            body,
            .container,
            .pcoded-main-container,
            .pcoded-content,
            .row {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            .no-print,
            nav,
            footer {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                margin-bottom: 20px !important;
                page-break-inside: avoid;
            }

            .card-body,
            .card-header {
                padding: 10px !important;
            }

            .card-header {
                font-weight: bold !important;
                font-size: 14pt !important;
                background-color: #f0f0f0 !important;
                color: #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .print-table {
                width: 100% !important;
                border-collapse: collapse;
                font-size: 12pt;
            }

            .print-table th,
            .print-table td {
                padding: 3px !important;
            }
        }
    </style>
</head>

<body class="bg-light p-4">
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="row">
                <div class="container">

                    <!-- Header Buttons (hidden when printing) -->
                    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
                        <h3 class="text-secondary">Client Full Details</h3>
                        <div>
                            <a href="./client-details.php?uryyToeSS4=<?= urlencode($clientId); ?>"
                                class="btn btn-outline-primary me-2">Back</a>
                            <a href="highlight.php?uryyToeSS4=<?= urlencode($clientId); ?>"
                                class="btn btn-outline-info me-2">
                                <i class="bi bi-file-text"></i> About Me
                            </a>
                            <!-- ✅ Modified to print only the div -->
                            <button onclick="printDiv('printArea')" class="btn btn-outline-success">Print</button>
                        </div>
                    </div>

                    <!-- ✅ Everything we want to print is inside this div -->
                    <div id="printArea">
                        <?php
                        // Build full address
                        $fullAddressParts = array_filter([
                            $client['client_address_line_1'] ?? '',
                            $client['client_address_line_2'] ?? '',
                            $client['client_city'] ?? '',
                            $client['client_county'] ?? '',
                            $client['client_poster_code'] ?? '',
                            $client['client_country'] ?? ''
                        ]);
                        $fullAddress = implode(', ', $fullAddressParts);

                        // Build full name
                        $fullName = trim(($client['client_first_name'] ?? '') . ' ' . ($client['client_last_name'] ?? ''));
                        ?>

                        <!-- Basic Information -->
                        <div class="card mb-4 shadow-sm text-start">
                            <div class="card-header basic">Basic Information</div>
                            <div class="card-body">
                                <?php
                                render_table([
                                    'full_name' => $fullName,
                                    'client_date_of_birth' => $client['client_date_of_birth'],
                                    'client_sexuality' => $client['client_sexuality'],
                                    'full_address' => $fullAddress,
                                    'client_primary_phone' => $client['client_primary_phone'],
                                    'col_second_phone' => $client['col_second_phone'],
                                    'client_email_address' => $client['client_email_address'],
                                    'col_swn_number' => $client['col_swn_number'],
                                ], [
                                    'full_name' => 'Full Name',
                                    'client_date_of_birth' => 'Date of Birth',
                                    'client_sexuality' => 'Gender',
                                    'full_address' => 'Address',
                                    'client_primary_phone' => 'Primary Phone',
                                    'col_second_phone' => 'Secondary Phone',
                                    'client_email_address' => 'Email',
                                    'col_swn_number' => 'Unique Identifier'
                                ]);
                                ?>
                            </div>
                        </div>

                        <!-- Funding -->
                        <div class="card mb-4 shadow-sm text-start">
                            <div class="card-header funding">Funding</div>
                            <div class="card-body">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_funding WHERE uryyToeSS4 = ?");
                                $stmt->bind_param("s", $clientId);
                                $stmt->execute();
                                $fundingResult = $stmt->get_result();
                                $fund = $fundingResult->fetch_assoc();
                                $stmt->close();

                                render_table($fund ?? [], [
                                    'la_funding' => 'Local Authority Funding',
                                    'private_funding' => 'Private Funding',
                                    'nhs_funding' => 'NHS Funding',
                                    'order_funding' => 'Order Funding',
                                    'local_authority_id' => 'Local Authority ID'
                                ]);
                                ?>
                            </div>
                        </div>

                        <!-- Next of Kin -->
                        <div class="card mb-4 shadow-sm text-start">
                            <div class="card-header nok">Next of Kin</div>
                            <div class="card-body">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_client_nok WHERE uryyToeSS4 = ?");
                                $stmt->bind_param("s", $clientId);
                                $stmt->execute();
                                $nokResult = $stmt->get_result();
                                if ($nokResult->num_rows > 0) {
                                    while ($nok = $nokResult->fetch_assoc()) {
                                        render_table($nok, [
                                            'col_first_name' => 'First Name',
                                            'col_last_name' => 'Last Name',
                                            'col_relationship' => 'Relationship',
                                            'col_phone_number' => 'Phone',
                                            'col_type_ofContact' => 'Type of Contact',
                                            'nok_emailaddress' => 'Email',
                                            'col_client_statement' => 'Client Statement',
                                            'lpa_documents' => 'LPA Documents'
                                        ]);
                                    }
                                } else {
                                    echo "<p class='text-muted'>No Next of Kin records found.</p>";
                                }
                                $stmt->close();
                                ?>
                            </div>
                        </div>

                        <!-- Medical Details -->
                        <div class="card mb-4 shadow-sm text-start">
                            <div class="card-header medical">Medical Details</div>
                            <div class="card-body">
                                <?php
                                $stmt = $conn->prepare("
                                    SELECT * FROM tbl_client_medical 
                                    WHERE uryyToeSS4 = ? AND col_company_Id = ? 
                                    ORDER BY dateTime DESC 
                                    LIMIT 1
                                ");
                                $stmt->bind_param("ss", $clientId, $companyId);
                                $stmt->execute();
                                $medResult = $stmt->get_result();

                                if ($med = $medResult->fetch_assoc()) {
                                    render_table($med, [
                                        'col_nhs_number' => 'NHS Number',
                                        'col_medical_support' => 'Medical Support',
                                        'col_dnar' => 'DNAR',
                                        'col_allergies' => 'Allergies',
                                        'col_gp_name' => 'GP Name',
                                        'col_phone_number' => 'GP Phone',
                                        'gp_email_address' => 'GP Email',
                                        'gp_address' => 'GP Address',
                                        'col_pharmancy_name' => 'Pharmacy Name',
                                        'pharmacy_phone' => 'Pharmacy Phone',
                                        'col_pharmancy_address' => 'Pharmacy Address',
                                        'dateTime' => 'Record Date'
                                    ]);
                                } else {
                                    echo "<p class='text-muted'>No medical records found.</p>";
                                }
                                $stmt->close();
                                ?>
                            </div>
                        </div>

                        <!-- Future Planning -->
                        <div class="card mb-4 shadow-sm text-start">
                            <div class="card-header future">Future Planning</div>
                            <div class="card-body">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_future_planning WHERE uryyToeSS4 = ? AND col_company_Id = ?");
                                $stmt->bind_param("ss", $clientId, $companyId);
                                $stmt->execute();
                                $fpResult = $stmt->get_result();
                                $fp = $fpResult->fetch_assoc();
                                $stmt->close();

                                render_table($fp ?? [], [
                                    'col_first_box' => 'Capacity to make health/wellbeing decisions',
                                    'col_second_box' => 'Health and Welfare LPA',
                                    'col_third_box' => 'Property and Financial Affairs LPA',
                                    'col_fourt_box' => 'Do Not Attempt CPR (DNACPR)',
                                    'col_fift_box' => 'Advance Decision to Refuse Treatment (ADRT)',
                                    'col_sixth_box' => 'ReSPECT Plan',
                                    'col_seventh_box' => 'Where is it kept?'
                                ]);
                                ?>
                            </div>
                        </div>
                    </div><!-- end printArea -->

                </div>

                <!-- Bottom panel (not printed) -->
                <div class="no-print row">
                    <?php include('bottom-panel-block.php'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="no-print">
        <?php include('footer-contents.php'); ?>
    </div>

    <script>
        function printDiv(divId) {
            let content = document.getElementById(divId).innerHTML;
            let myWindow = window.open('', '', 'width=900,height=650');
            myWindow.document.write(`
            <html>
                <head>
                    <title>Print</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
</body>

</html>