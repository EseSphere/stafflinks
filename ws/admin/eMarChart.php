<?php require_once 'eMarchart_backend.php'; ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="page-header-title">
                            <h5 class="m-b-10">
                                <?php
                                $stmt = $conn->prepare("SELECT client_first_name, client_last_name FROM tbl_general_client_form 
                                WHERE uryyToeSS4 = ? AND col_company_Id = ?");
                                $stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
                                $stmt->execute();
                                $stmt->bind_result($clientFirstName, $clientLastName);
                                $stmt->fetch();
                                $fullName = trim("$clientFirstName $clientLastName");
                                echo htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') . "'s MarChart";
                                $stmt->close();
                                ?>
                            </h5>
                            <p style="margin-top: -10px;">Download eMarchart from start month to end month.</p>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i>Home</a></li>
                            <li class="breadcrumb-item"><a href="#!">Client</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-xl-6 col-sm-6 col-lg-6">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="startMonth">Start Month</label>
                                <input type="month" id="startMonth" class="form-control" value="<?= $startMonth ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="endMonth">End Month</label>
                                <input type="month" id="endMonth" class="form-control" value="<?= $endMonth ?>">
                            </div>
                            <div class="col-md-2 align-self-end d-flex gap-2">
                                <button id="printBtn" style="height: 50px;" class="btn btn-primary">Print</button>
                                <button id="analyticsBtn" style="height: 50px;" class="btn btn-info">Analytics</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="printMarchart">
            <?php if (!empty($months)): ?>
                <?php foreach ($months as $monthKey => $monthDates): ?>
                    <div class="card table-card month-card mb-4">
                        <div class="card-header">
                            <h5><?= date('F Y', strtotime($monthDates[0])) ?></h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-left mb-0">
                                    <thead>
                                        <tr>
                                            <th>Medication Name</th>
                                            <?php foreach ($monthDates as $date_key): ?>
                                                <th><?= date('j', strtotime($date_key)) ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($medications as $med_name => $med_dates): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($med_name) ?></td>
                                                <?php foreach ($monthDates as $date_key): ?>
                                                    <td class="text-center">
                                                        <?php
                                                        if (isset($med_dates[$date_key])) {
                                                            $sorted_doses = [];
                                                            foreach ($dose_order as $label) {
                                                                foreach ($med_dates[$date_key] as $entry) {
                                                                    if ($entry['care_calls'] === $label) $sorted_doses[] = $entry;
                                                                }
                                                            }
                                                            foreach ($sorted_doses as $entry) {
                                                                $status = $entry['outcome'];
                                                                $colorClass = ($status === "Fully taken") ? "green-circle" : (($status === "Not taken") ? "red-circle" : "grey-circle");
                                                                echo '<span title="' . $entry['care_calls'] . ' - ' . $status . '" class="' . $colorClass . '" style="cursor:pointer;" ' .
                                                                    'data-med_date="' . $entry['med_date'] . '" ' .
                                                                    'data-task_timeIn="' . $entry['task_timeIn'] . '" ' .
                                                                    'data-task_note="' . htmlspecialchars($entry['task_note'], ENT_QUOTES) . '" ' .
                                                                    'data-col_dosage="' . htmlspecialchars($entry['col_dosage'], ENT_QUOTES) . '" ' .
                                                                    'data-care_calls="' . htmlspecialchars($entry['care_calls'], ENT_QUOTES) . '" ' .
                                                                    'data-toggle="modal" data-target="#medDetailModal"></span> ';
                                                            }
                                                        } else {
                                                            $circleClass = ($date_key < $today_date) ? 'red-circle' : 'grey-circle';
                                                            $title = ($date_key < $today_date) ? 'Missed' : 'Pending';
                                                            echo '<span title="' . $title . '" class="' . $circleClass . '"></span>';
                                                        }
                                                        ?>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No medication records found for the selected range.</p>
            <?php endif; ?>
        </div>

        <!-- Medication Detail Modal -->
        <div class="modal fade" id="medDetailModal" tabindex="-1" role="dialog" aria-labelledby="medDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="medDetailModalLabel">Medication Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered justify-start items-start text-start">
                            <tr>
                                <th>Med Date</th>
                                <td id="modal-med-date"></td>
                            </tr>
                            <tr>
                                <th>Dose Label</th>
                                <td id="modal-dose-label"></td>
                            </tr>
                            <tr>
                                <th>Time In</th>
                                <td id="modal-task-timeIn"></td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td id="modal-task-note"></td>
                            </tr>
                            <tr>
                                <th>Dosage</th>
                                <td id="modal-col-dosage"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Modal -->
        <div class="modal fade" id="analyticsModal" tabindex="-1" role="dialog" aria-labelledby="analyticsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="analyticsModalLabel">Medication Analytics <br>
                            <small><?php echo htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') . "'s medication analytics."; ?></small>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <canvas id="medAnalyticsChart" height="300"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="printChartBtn">Print</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>

<script>
    let analyticsChart = null;

    // Medication detail modal
    $('#medDetailModal').on('show.bs.modal', function(event) {
        const span = $(event.relatedTarget);
        $('#modal-med-date').text(span.data('med_date'));
        $('#modal-dose-label').text(span.data('care_calls'));
        $('#modal-task-timeIn').text(span.data('task_timeIn')); // Fixed capitalization
        $('#modal-task-note').text(span.data('task_note'));
        $('#modal-col-dosage').text(span.data('col_dosage'));
    });

    // Close buttons
    $('.modal .btn-close, .modal .close').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    // Month filter
    document.getElementById('startMonth').addEventListener('change', updateURL);
    document.getElementById('endMonth').addEventListener('change', updateURL);

    function updateURL() {
        const start = document.getElementById('startMonth').value;
        const end = document.getElementById('endMonth').value;
        window.location.href = window.location.pathname + '?uryyToeSS4=<?= urlencode($uryyToeSS4) ?>&startMonth=' + start + '&endMonth=' + end;
    }

    // Analytics modal
    document.getElementById('analyticsBtn').addEventListener('click', function() {
        const ctx = document.getElementById('medAnalyticsChart').getContext('2d');

        if (analyticsChart) analyticsChart.destroy();

        document.getElementById('medAnalyticsChart').height = 400;

        analyticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($analyticsData['months']) ?>,
                datasets: [{
                        label: 'Fully Taken',
                        data: <?= json_encode($analyticsData['taken']) ?>,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0,255,0,0.1)',
                        fill: true,
                        tension: 0.2
                    },
                    {
                        label: 'Not Taken',
                        data: <?= json_encode($analyticsData['notTaken']) ?>,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255,0,0,0.1)',
                        fill: true,
                        tension: 0.2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        font: {
                            weight: 'bold'
                        },
                        color: ctx => ctx.dataset.borderColor,
                        formatter: value => value
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        $('#analyticsModal').modal('show');
    });

    document.getElementById('printBtn').addEventListener('click', function() {
        const printDiv = document.getElementById('printMarchart');
        const clone = printDiv.cloneNode(true);
        const printWindow = window.open('', '', 'height=900,width=1400');

        printWindow.document.write('<html><head><title>Print eMarchart</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">');
        printWindow.document.write('<style>');
        printWindow.document.write('@page { size: landscape; margin: 5mm; }');
        printWindow.document.write('body { -webkit-print-color-adjust: exact; font-family: Arial, sans-serif; margin: 0; padding: 0; }');
        printWindow.document.write('.green-circle, .red-circle, .grey-circle { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin: 0 1px; }');
        printWindow.document.write('.green-circle { background-color: green; }');
        printWindow.document.write('.red-circle { background-color: red; }');
        printWindow.document.write('.grey-circle { background-color: grey; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; font-size: 9px; table-layout: auto; }');
        printWindow.document.write('th:first-child, td:first-child { width: 200px; text-align: left; }');
        printWindow.document.write('th:not(:first-child), td:not(:first-child) { width: auto; }');
        printWindow.document.write('th, td { padding: 2px; text-align: center; word-wrap: break-word; }');
        printWindow.document.write('tr { page-break-inside: avoid; page-break-after: auto; }');
        printWindow.document.write('.month-card { page-break-inside: avoid; page-break-after: auto; margin-bottom: 5px; }');
        printWindow.document.write('h5.fw-semibold { page-break-inside: avoid; margin-bottom: 5px; text-align: center; }');
        printWindow.document.write('</style></head><body>');
        printWindow.document.write(clone.outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.onload = () => {
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 300);
        };
    });

    document.getElementById('printChartBtn').addEventListener('click', function() {
        if (!analyticsChart) return;

        const chartCanvas = document.getElementById('medAnalyticsChart');
        const chartImage = chartCanvas.toDataURL('image/png');

        const printWindow = window.open('', '', 'height=600,width=900');

        printWindow.document.write('<html><head><title>Print eMarchart</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">');
        printWindow.document.write('<style>body{padding:20px;} h5{margin-bottom:20px;}</style>');
        printWindow.document.write('</head><body>');

        printWindow.document.write('<div class="text-center mb-3">');
        printWindow.document.write('<h5>Medication Analytics</h5>');
        printWindow.document.write('<small><?php echo htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') . "\'s medication analytics."; ?></small>');
        printWindow.document.write('</div>');

        printWindow.document.write('<div class="text-center">');
        printWindow.document.write('<img src="' + chartImage + '" style="max-width:100%; height:auto;">');
        printWindow.document.write('</div>');

        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();

        setTimeout(function() {
            printWindow.print();
            printWindow.close();
        }, 500);
    });
</script>


<?php include('footer-contents.php'); ?>