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
$client = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$client) {
    die("No client data found.");
}

// Build full name
$fullName = trim(($client['client_first_name'] ?? '') . ' ' . ($client['client_last_name'] ?? ''));

// Fetch medication overview with extra fields
$stmt = $conn->prepare("
    SELECT med_name, med_dosage, med_type, med_support_required, med_package, med_details,
           col_period_two,
           care_call1, care_call2, care_call3, care_call4,
           extra_call1, extra_call2, extra_call3, extra_call4,
           col_extra_visit
    FROM tbl_clients_medication_records
    WHERE uryyToeSS4 = ? AND col_company_Id = ?
    ORDER BY med_name ASC
");

$stmt->bind_param("ss", $clientId, $companyId);
$stmt->execute();
$meds = $stmt->get_result();
$stmt->close();
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-12">

                <!-- Header Buttons -->
                <div class="d-flex justify-content-between align-items-center mb-3 no-print">
                    <h3 class="text-secondary">Medication Overview</h3>
                    <div>
                        <a href="./view-client-details.php?uryyToeSS4=<?= urlencode($clientId); ?>"
                            class="btn btn-outline-primary me-2">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <button onclick="printDiv('printArea')" class="btn btn-outline-success">Print</button>
                    </div>
                </div>

                <!-- Content to print -->
                <div id="printArea">

                    <!-- Client Basic Information -->
                    <div class="card shadow-sm mb-4 text-start">
                        <div class="card-header basic">Client Information</div>
                        <div class="card-body">
                            <?php
                            $fullAddressParts = array_filter([
                                $client['client_address_line_1'] ?? '',
                                $client['client_address_line_2'] ?? '',
                                $client['client_city'] ?? '',
                                $client['client_county'] ?? '',
                                $client['client_poster_code'] ?? '',
                                $client['client_country'] ?? ''
                            ]);
                            $fullAddress = implode(', ', $fullAddressParts);
                            ?>
                            <p><strong>Full Name:</strong> <?= htmlspecialchars($fullName ?: 'Not provided'); ?></p>
                            <p><strong>Date of Birth:</strong>
                                <?= htmlspecialchars($client['client_date_of_birth'] ?? 'Not provided'); ?></p>
                            <p><strong>Gender:</strong>
                                <?= htmlspecialchars($client['client_sexuality'] ?? 'Not provided'); ?></p>
                            <p><strong>Unique ID:</strong>
                                <?= htmlspecialchars($client['col_swn_number'] ?? 'Not provided'); ?></p>
                            <p><strong>Address:</strong> <?= htmlspecialchars($fullAddress ?: 'Not provided'); ?></p>
                            <p><strong>Primary Phone:</strong>
                                <?= htmlspecialchars($client['client_primary_phone'] ?? 'Not provided'); ?></p>
                            <p><strong>Secondary Phone:</strong>
                                <?= htmlspecialchars($client['col_second_phone'] ?? 'Not provided'); ?></p>
                            <p><strong>Email:</strong>
                                <?= htmlspecialchars($client['client_email_address'] ?? 'Not provided'); ?></p>
                        </div>
                    </div>

                    <!-- Medications Table -->
                    <div class="card shadow-sm">
                        <div class="card-body table-responsive">
                            <?php if ($meds->num_rows > 0): ?>
                                <table class="table table-sm table-striped table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="text-align:left;">Medication</th>
                                            <th style="text-align:left;">Dosage</th>
                                            <th style="text-align:left;">Type</th>
                                            <th style="text-align:left;">Support</th>
                                            <th style="text-align:left;">Package</th>
                                            <th style="text-align:left;">Details</th>
                                            <th style="text-align:left;">Period</th>
                                            <th style="text-align:left;">Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $meds->fetch_assoc()): ?>
                                            <?php
                                            // Collect all care/extra calls and take first letter if not empty
                                            $calls = [];
                                            foreach (
                                                [
                                                    'care_call1',
                                                    'care_call2',
                                                    'care_call3',
                                                    'care_call4',
                                                    'extra_call1',
                                                    'extra_call2',
                                                    'extra_call3',
                                                    'extra_call4',
                                                    'col_extra_visit'
                                                ] as $field
                                            ) {
                                                if (!empty($row[$field])) {
                                                    $calls[] = strtoupper(substr($row[$field], 0, 1));
                                                }
                                            }
                                            $frequency = implode(', ', $calls);
                                            ?>
                                            <tr>
                                                <td style="text-align:left; max-width:300px !important;word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><?= htmlspecialchars($row['med_name']); ?></td>
                                                <td style="text-align:left; max-width:100px !important;word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><?= htmlspecialchars($row['med_dosage']); ?></td>
                                                <td style="text-align:left; max-width:100px !important;word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><?= htmlspecialchars($row['med_type']); ?></td>
                                                <td style="text-align:left;">
                                                    <?= htmlspecialchars($row['med_support_required']); ?></td>
                                                <td style="text-align:left;"><?= htmlspecialchars($row['med_package']); ?></td>
                                                <td style="text-align:left; max-width:230px !important;word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><?= htmlspecialchars($row['med_details']); ?></td>
                                                <td style="text-align:left;"><?= htmlspecialchars($row['col_period_two']); ?>
                                                </td>
                                                <td style="text-align:left;"><?= $frequency; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted">No medication records found for this client.</p>
                            <?php endif; ?>
                        </div>
                    </div>


                </div> <!-- End printArea -->

            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>

<script>
    function printDiv(divId) {
        const divContents = document.getElementById(divId).innerHTML;
        const printWindow = window.open('', '', 'height=800,width=1200');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write(
            '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">');
        printWindow.document.write(`
        <style>
            body { padding: 3px; font-size: 12pt; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: 5px; text-align: left; }
            th { background-color: #f8f9fa !important; }
        </style>
    `);
        printWindow.document.write('</head><body>');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }
</script>

<style>
    @media print {

        .btn,
        .no-print,
        .pcoded-navbar,
        .bottom-panel-block {
            display: none !important;
        }

        .pcoded-main-container {
            width: 100% !important;
            margin: 0;
            padding: 0;
        }

        .card-body p {
            margin-bottom: 4px;
        }
    }
</style>