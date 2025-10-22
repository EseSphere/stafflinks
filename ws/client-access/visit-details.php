<?php include('visit_details_backend.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div id="printContent">
            <div class="row text-decoration-none">
                <div class="col-md-4 col-sm-4 col-xl-4 col-lg-4">
                    <h5 class="fw-bold mb-3 fs-4">
                        Care Logs for <?= $clientFullName ?><br>
                        <small class="text-muted fs-6"><?= date("l, jS M Y", strtotime($clientShiftDate)) ?></small>
                    </h5>
                </div>
                <div class="col-md-8 col-sm-8 col-xl-8 col-lg-8">
                    <div class="d-flex justify-content-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success" onclick="printSection()">Print Visit</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row text-decoration-none mt-2 mb-2">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                    <div class='card mb-4'>
                        <div class='card-header bg-light'><strong class='fs-5'><?= $care_calls ?> Visit</strong></div>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <p class="fs-6"><strong>👤 Client:</strong>
                                        <br>
                                        <span style="font-size:23px; font-weight:800;"><?= $clientFullName ?></span>
                                    </p>
                                    <p class="fs-6"><strong>🕒 Planned Time:</strong>
                                        <br>
                                        <span style="font-size:16px; font-weight:800;"><?php echo date("h:ia", strtotime($timeIn)); ?> – <?php echo date("h:ia", strtotime($timeOut)); ?></span>
                                    </p>
                                    <?php
                                    if ($clientName == null || $clientName == '') {
                                        echo "
                                    <a href='./re-assign-care-call?userId=$userId&date=$clientShiftDate&location=scheduleRota' class='text-decoration-none btn btn-info btn-sm'>Re-assign visit</a>";
                                    }
                                    ?>
                                </div>
                                <div class='col-md-4'>
                                    <h4 class="badge bg-primary ms-2 fs-6">First Carer</h4>
                                    <div class='mb-3 border-bottom pb-2 fs-6'>
                                        <h6 class='fw-bold mb-1 fs-6'>
                                            <?= $varCarerName ?>
                                        </h6>
                                        <div class="fs-6"><strong>Check-in:</strong> <?php echo strtotime($firstCarActTimeIn) ? date("h:ia", strtotime($firstCarActTimeIn)) : "null"; ?></div>
                                        <div class="fs-6"><strong>Check-out:</strong> <?php echo strtotime($firstCarActTimeOut) ? date("h:ia", strtotime($firstCarActTimeOut)) : "null"; ?></div>
                                        <?php
                                        echo (strtotime($firstCarActTimeIn) && strtotime($firstCarActTimeOut))
                                            ? (function ($start, $end) {
                                                return $start->diff($end)->format('Time spent %hh %im');
                                            })(new DateTime($firstCarActTimeIn), new DateTime($firstCarActTimeOut))
                                            : "null";
                                        ?>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <h4 class="badge bg-primary ms-2 fs-6">Second Carer</h4>
                                    <div class='mb-3 border-bottom pb-2 fs-6'>
                                        <h6 class='fw-bold mb-1 fs-6'>
                                            <?= $varCarerName2 ?>
                                        </h6>
                                        <div class="fs-6"><strong>Check-in:</strong> <?php echo strtotime($firstCarActTimeIn2) ? date("h:ia", strtotime($firstCarActTimeIn2)) : "null"; ?></div>
                                        <div class="fs-6"><strong>Check-out:</strong> <?php echo strtotime($firstCarActTimeOut2) ? date("h:ia", strtotime($firstCarActTimeOut2)) : "null"; ?></div>
                                        <?php
                                        echo (strtotime($firstCarActTimeIn2) && strtotime($firstCarActTimeOut2))
                                            ? (function ($start, $end) {
                                                return $start->diff($end)->format('Time spent %hh %im');
                                            })(new DateTime($firstCarActTimeIn2), new DateTime($firstCarActTimeOut2))
                                            : "null";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <?php
                    if (mysqli_num_rows($tasks) > 0) {
                        while ($task = mysqli_fetch_assoc($tasks)) {
                            $formatted_date = date("d F Y", strtotime($task['task_date'])); // e.g., 21 July 2025
                            echo "<div class='card mb-4'>
                                <div class='card-body'>
                                    <h6 class='fw-bold fs-6'>{$task['task_name']}</h6>
                                    <p class='fs-6 fw-bold'>Status: {$task['col_outcome']}</p>
                                    <p class='text-muted fw-bold fs-6'>{$task['col_task_status']}
                                    <span style='font-size:13px;float:right;' class='text-muted fw-bold text-end'>{$task['task_timeIn']}<br> {$formatted_date}</span>
                                    </p>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<p class='text-muted fs-6'>No task records available for this date.</p>";
                    }
                    ?>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <?php
                    if (mysqli_num_rows($meds) > 0) {
                        while ($med = mysqli_fetch_assoc($meds)) {
                            $formattedDate = date("d F Y", strtotime($med['med_date']));
                            echo "<div class='card mb-4 fs-6'>
                            <div class='card-body'>
                                <h6 class='fw-bold fs-6'>{$med['task_name']}</h6>
                                <p class='fs-6 fw-bold'>Status: {$med['col_outcome']}</p>
                                <p class='text-muted fw-bold fs-6'>{$med['col_task_status']}
                                <span style='font-size:13px;float:right;' class='text-muted fw-bold text-end'>{$med['task_timeIn']}<br> {$formattedDate}</span>
                                </p>
                            </div>
                        </div>";
                        }
                    } else {
                        echo "<p class='text-muted fs-6'>No med records available for this date.</p>";
                    }
                    ?>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="fw-bold fs-6">Care Notes</h5>
                            <p class="fw-bold fs-6"><?= htmlspecialchars($firstCareNotes) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
</div>

<script>
    function printSection() {
        var content = document.getElementById("printContent").innerHTML;
        var printWindow = window.open('', '', 'width=900,height=650');
        printWindow.document.write(`
        <html>
        <head>
            <title><?= $clientFullName . ' Visit ' . date("l, jS M Y", strtotime($clientShiftDate)) ?></title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .card { page-break-inside: avoid; }
                
                /* Hide buttons and links styled as buttons when printing */
                button, a.btn {
                    display: none !important;
                }
            </style>
        </head>
        <body>
            ${content}
        </body>
        </html>
    `);
        printWindow.document.close();
        printWindow.focus();

        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    }
</script>


<?php include('footer-contents.php'); ?>