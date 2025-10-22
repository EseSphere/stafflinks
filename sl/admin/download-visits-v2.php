<?php
//include_once('download_visits_backend.php');
include_once('client-header-contents.php');
?>
<link rel="stylesheet" href="./css/download_visit.css" />
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row text-decoration-none mt-0 p-0 w-100 h-auto">
            <div style="margin-top: -30px;" class="col-md-6 col-sm-6 col-xl-6 col-lg-6">
                <h4>Care Logs</h4>
                <p>Download or print Anthea Davies care logs.</p>
            </div>
            <div style="margin-top: -30px;" class="col-md-6 col-sm-6 col-xl-6 col-lg-6 text-end">
                <button class="print-btn" onclick="printContainer()">Print</button>
            </div>
        </div>
        <hr>
        <div class="row text-decoration-none mt-0 p-0 w-100 h-auto">
            <div class="col-md-3 col-sm-3 col-xl-3 col-lg-3">
                <header class="w-100 h-auto flex justify-start items-start text-start">
                    <h4>Filter care logs</h4>
                    <p class="w-75">Filter care logs by date.</p>
                </header>
                <div class="card shadow-sm mb-4">
                    <div class="card-body flex justify-start items-start text-start">
                        <p class="text-muted mb-3">
                            <i class="fas fa-info-circle"></i> Use the form below to filter visits by selecting a start and end date.
                            <br>Both fields are required. You can reset the filter to view all visits.
                        </p>
                        <form method="GET" class="date-filter">
                            <input type="hidden" name="uryyToeSS4" value="<?php echo htmlspecialchars($uryyToeSS4); ?>">

                            <div class="form-group mb-3 flex justify-start items-start text-start">
                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="<?php echo htmlspecialchars($start_date); ?>" required>
                                <small class="form-text text-muted">Select the earliest date of visits you want to view.</small>
                            </div>

                            <div class="form-group mb-3 flex justify-start items-start text-start">
                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="<?php echo htmlspecialchars($end_date); ?>" required>
                                <small class="form-text text-muted">Select the latest date of visits you want to view.</small>
                            </div>

                            <div class="form-group mb-3 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter"></i> Apply Filter
                                </button>
                                <a href="?uryyToeSS4=<?php echo urlencode($uryyToeSS4); ?>" class="btn btn-secondary w-100">
                                    <i class="fas fa-undo"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xl-9 col-lg-9">
                <div class="w-100 h-auto m-0 p-0" id="printContainer">
                    <header class="w-100 h-auto flex justify-start items-start text-start">
                        <h4>Care Logs</h4>
                        <p class="w-75">Clear overview of care, visits, assigned carers, tasks, medications, and observations. Easy monitoring, tracking, and updating of all essential care activities in one place.</p>
                    </header>
                    <?php
                    // Database connection
                    $servername = "localhost";
                    $username   = "root";
                    $password   = "";
                    $dbname     = "geosoft";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Get unique ID from URL
                    $uryyToeSS4 = isset($_GET['uryyToeSS4']) ? $_GET['uryyToeSS4'] : '';

                    // Get start and end dates from form
                    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                    $end_date   = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                    // Helper functions
                    function formatTime($time)
                    {
                        return date("g:i A", strtotime($time));
                    }

                    function timeSpent($start, $end)
                    {
                        $diff = strtotime($end) - strtotime($start);
                        $hours = floor($diff / 3600);
                        $minutes = floor(($diff % 3600) / 60);
                        return ($hours > 0 ? $hours . "h " : "") . ($minutes > 0 ? $minutes . "m" : ($hours == 0 ? "0m" : ""));
                    }

                    if ($uryyToeSS4 != '') {
                        // SQL queries
                        $visits_sql = "SELECT * FROM tbl_daily_shift_records WHERE uryyToeSS4 = ?";
                        $tasks_sql  = "SELECT * FROM tbl_finished_tasks WHERE uryyToeSS4 = ?";
                        $med_sql    = "SELECT * FROM tbl_finished_meds WHERE uryyToeSS4 = ?";

                        $params = [$uryyToeSS4];

                        if ($start_date && $end_date) {
                            $visits_sql .= " AND shift_date BETWEEN ? AND ?";
                            $tasks_sql  .= " AND task_date BETWEEN ? AND ?";
                            $med_sql    .= " AND med_date BETWEEN ? AND ?";
                            $params = [$uryyToeSS4, $start_date, $end_date];
                        }

                        $visits_sql .= " ORDER BY shift_date ASC, planned_timeIn ASC";
                        $tasks_sql  .= " ORDER BY task_date ASC";
                        $med_sql    .= " ORDER BY med_date ASC";

                        // Prepare and execute visits
                        $stmt_visits = $conn->prepare($visits_sql);
                        if ($start_date && $end_date) {
                            $stmt_visits->bind_param("sss", ...$params);
                        } else {
                            $stmt_visits->bind_param("s", $uryyToeSS4);
                        }
                        $stmt_visits->execute();
                        $visits_result = $stmt_visits->get_result();

                        // Prepare and execute tasks
                        $stmt_tasks = $conn->prepare($tasks_sql);
                        if ($start_date && $end_date) {
                            $stmt_tasks->bind_param("sss", ...$params);
                        } else {
                            $stmt_tasks->bind_param("s", $uryyToeSS4);
                        }
                        $stmt_tasks->execute();
                        $tasks_result = $stmt_tasks->get_result();

                        // Prepare and execute medications
                        $stmt_med = $conn->prepare($med_sql);
                        if ($start_date && $end_date) {
                            $stmt_med->bind_param("sss", ...$params);
                        } else {
                            $stmt_med->bind_param("s", $uryyToeSS4);
                        }
                        $stmt_med->execute();
                        $med_result = $stmt_med->get_result();

                        // Group visits by date
                        $visits_by_date = [];
                        while ($visit = $visits_result->fetch_assoc()) {
                            $visits_by_date[$visit['shift_date']][] = $visit;
                        }

                        // Group tasks by date
                        $tasks_by_date = [];
                        while ($task = $tasks_result->fetch_assoc()) {
                            $tasks_by_date[$task['task_date']][] = $task;
                        }

                        // Group medications by date
                        $med_by_date = [];
                        while ($med = $med_result->fetch_assoc()) {
                            $med_by_date[$med['med_date']][] = $med;
                        }
                    }

                    // Display dashboard
                    if (!empty($visits_by_date)):
                        foreach ($visits_by_date as $date => $visits):
                    ?>
                            <div class="dashboard">
                                <div class="left-column">
                                    <div class="card">
                                        <h3><?php echo date('jS M, Y', strtotime($date)); ?></h3>
                                        <?php $first_visit = $visits[0]; ?>
                                        <table class="mb-3">
                                            <tr>
                                                <th>Full Name</th>
                                                <td><?php echo htmlspecialchars($first_visit['client_name']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Planned Time In</th>
                                                <td><?php echo formatTime($first_visit['planned_timeIn']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Planned Time Out</th>
                                                <td><?php echo formatTime($first_visit['planned_timeOut']); ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="card">
                                        <h3>Carers</h3>
                                        <div class="carers-container">
                                            <?php foreach ($visits as $visit):
                                                if ($visit['carer_Name']):
                                            ?>
                                                    <div class="carer-card">
                                                        <div style="font-weight:bold; margin-bottom:5px;"><?php echo htmlspecialchars($visit['carer_Name']); ?></div>
                                                        <div style="margin-bottom:5px;">
                                                            <?php echo formatTime($visit['shift_start_time']) . " → " . formatTime($visit['shift_end_time']); ?>
                                                        </div>
                                                        <div style="color:#555;">
                                                            <?php echo timeSpent($visit['shift_start_time'], $visit['shift_end_time']); ?>
                                                        </div>
                                                    </div>
                                            <?php endif;
                                            endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <h3>Observation</h3>
                                        <div class="note">
                                            <?php foreach ($visits as $visit):
                                                if ($visit['task_note']) echo htmlspecialchars($visit['task_note']) . "<br>";
                                            endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="right-column">
                                    <div class="card">
                                        <h3>Tasks & Medications</h3>
                                        <div class="tasks-medications-container">
                                            <div class="task-med-card">
                                                <h3>Tasks</h3>
                                                <ul>
                                                    <?php if (isset($tasks_by_date[$date])):
                                                        foreach ($tasks_by_date[$date] as $task):
                                                            $task_time = !empty($task['task_timeIn']) ? " – " . formatTime($task['task_timeIn']) : "";
                                                            echo "<li style='border-bottom:1px solid rgba(41, 128, 185,.2); font-size:15px;'>" . htmlspecialchars($task['task_name']) . $task_time . "</li>";
                                                        endforeach;
                                                    endif; ?>
                                                </ul>
                                            </div>
                                            <div class="task-med-card">
                                                <h3>Medications</h3>
                                                <ul>
                                                    <?php if (isset($med_by_date[$date])):
                                                        foreach ($med_by_date[$date] as $med):
                                                            $med_time = !empty($med['task_timeIn']) ? " – " . formatTime($med['task_timeIn']) : "";
                                                            echo "<li style='border-bottom:1px solid rgba(41, 128, 185,.2); font-size:15px;'>" . htmlspecialchars($med['task_name']) . $med_time . "</li>";
                                                        endforeach;
                                                    endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    else:
                        echo "<p>No visits found for this client.</p>";
                    endif;
                    $conn->close();
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printContainer() {
        const printContents = document.getElementById('printContainer').outerHTML; // Use outerHTML to include the div itself
        const printWindow = window.open('', '', 'height=900,width=1400');

        printWindow.document.write('<html><head><title>Print Care Logs</title>');

        // Copy all stylesheets and style tags to preserve the design
        Array.from(document.querySelectorAll('link[rel="stylesheet"], style')).forEach(node => {
            printWindow.document.write(node.outerHTML);
        });

        // Additional inline style for printing to ensure layout doesn't break
        printWindow.document.write(`
        <style>
            @media print {
                body {
                    margin: 0;
                    padding: 0;
                    background: #fff;
                    -webkit-print-color-adjust: exact;
                    color-adjust: exact;
                    font-size: 15px !important;
                }
                .print-btn {
                    display: none !important;
                }
                #printContainer {
                    width: 100% !important;
                }
                .dashboard, .carers-container, .tasks-medications-container {
                    flex-direction: row !important;
                    flex-wrap: nowrap !important;
                }
                .left-column, .right-column, .carer-card, .task-med-card {
                    min-width: auto !important;
                    flex: 1 !important;
                }
                @page {
                    size: landscape;
                    margin: 10mm;
                }
            }
        </style>
    `);

        printWindow.document.write('</head><body>');
        printWindow.document.write(printContents);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script>

<?php include_once('footer-contents.php'); ?>