<?php include('event_details_backend.php'); ?>

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
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#changeTime">Time</button>
                            <a type="button" href="./cancel-client-care-call?userId=<?= $userId ?>&spec=<?= $myuryyToeSS4 ?>&name=<?= $clientFullName ?>&date=<?= $clientShiftDate ?>&visit=<?= $mycare_calls ?>" class="btn btn-outline-primary">Cancel</a>
                            <a type="button" href="roster/index?txtDate=<?= date('Y-m-d') ?>" class="btn btn-outline-secondary">Rota</a>
                            <button type="button" class="btn btn-outline-success" onclick="printSection()">Print</button>
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
                                <div class='col-4'>
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
                                <div class='col-4'>
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
                                <div class='col-4'>
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
                            $formatted_date = date("d F Y", strtotime($task['task_date']));
                            if ($task['col_outcome'] === 'Successful') {
                                $icon = "<i class='fas fa-check-circle' style='color:green;'></i>";
                            } else {
                                $icon = "<i class='fas fa-times-circle' style='color:red;'></i>";
                            }
                            echo "<div class='card mb-1'>
                                    <div class='card-body'>
                                        <h6 class='fw-bold fs-6'>{$task['task_name']} $icon</h6>
                                        {$task['col_outcome']} <span class='text-muted'>{$task['task_note']}</span>
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
                            if ($med['col_outcome'] === 'Fully taken') {
                                $icon = "<i class='fas fa-check-circle' style='color:green;'></i>";
                            } else {
                                $icon = "<i class='fas fa-times-circle' style='color:red;'></i>";
                            }

                            echo "<div class='card mb-1'>
                                    <div class='card-body'>
                                        <h6 class='fw-bold fs-6'>{$med['task_name']} $icon</h6>
                                        {$med['col_outcome']} <span class='text-muted'>{$med['task_note']}</span>
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
                            <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#changenote"><i class="fas fa-edit"></i></button>
                            <p class="fw-bold fs-6"><?= htmlspecialchars($firstCareNotes) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal change note -->
    <div class="modal fade" id="changenote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Care Notes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./update-care-notes" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <h5 class="fw-semibold fs-6">
                            Care note records daily support, activities, and observations to ensure consistent, quality care.
                            You can update the note anytime to keep information accurate and up to date.
                        </h5>
                        <input type="hidden" name="txtClientSpecId" value="<?= $uryyToeSS4 ?>" />
                        <input type="hidden" name="txtCareCalls" value="<?= $care_calls ?>" />
                        <input type="hidden" name="txtShiftDate" value="<?= $shiftDate2 ?>" />
                        <input type="hidden" name="txtCarerId" value="<?= $firstCarerId ?>" />
                        <textarea class="form-control mb-2" style="resize: none;" name="txtCareNotes" rows="4"><?= htmlspecialchars($firstCareNotes) ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal change time -->
    <div class="modal fade" id="changeTime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Visit time</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./update-care-time" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <h5 class="fw-semibold fs-6">
                            Change the visit time to ensure accurate records and billing.
                            You can update the time anytime to keep information accurate and up to date.
                        </h5>
                        <input type="hidden" name="txtClientUserId" value="<?= $userId ?>" />
                        <input type="hidden" name="txtCareCalls" value="<?= $mycare_calls ?>" />
                        <input type="hidden" name="txtClientSpecId" value="<?= $myuryyToeSS4 ?>" />
                        <input type="hidden" name="txtclientShiftDate" value="<?= $clientShiftDate ?>" />
                        <div class="mb-3">
                            <label for="txtTimeIn" class="form-label">Time In</label>
                            <input type="time" class="form-control" id="txtTimeIn" name="txtTimeIn" value="<?= date("H:i", strtotime($timeIn)) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="txtTimeOut" class="form-label">Time Out</label>
                            <input type="time" class="form-control" id="txtTimeOut" name="txtTimeOut" value="<?= date("H:i", strtotime($timeOut)) ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style="width: 120px;" name="btnCurTime" type="submit" class="btn btn-primary btn-sm">Current time</button>
                        <button style="width: 120px;" name="btnAllTimes" type="submit" class="btn btn-info btn-sm">All times</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <?php include('bottom-panel-block.php'); ?>
    </div>
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