<?php
include('client-header-contents.php');

// Get selected month, year, and uryyToeSS4 from URL parameters
$selected_month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$selected_year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$uryyToeSS4 = isset($_GET['uryyToeSS4']) ? $_GET['uryyToeSS4'] : '';

if (empty($uryyToeSS4)) {
    die("Error: Missing authentication token.");
}
$uryyToeSS4 = $conn->real_escape_string($uryyToeSS4);
$varCompanyId = $_SESSION['usr_compId'];

// Define dose order
$dose_order = [
    'Morning',
    'EM morning call',
    'Lunch',
    'EL lunch call',
    'Tea',
    'ET tea call',
    'Bed',
    'EB bed call'
];

// Fetch medications with all required columns
$sql = "SELECT task_name, med_date, task_timeIn, task_note, col_dosage, care_calls, col_outcome 
        FROM tbl_finished_meds 
        WHERE uryyToeSS4 = ? 
        AND MONTH(med_date) = ? 
        AND YEAR(med_date) = ? 
        AND col_company_Id = ?
        ORDER BY med_date ASC, task_timeIn ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siis", $uryyToeSS4, $selected_month, $selected_year, $varCompanyId);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query Error: " . $stmt->error);
}

$medications = [];
$dates = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $med_name = $row['task_name'];
        $med_date = $row['med_date'];

        // Store multiple doses in an array
        $medications[$med_name][$med_date][] = [
            'med_date'   => $row['med_date'],
            'task_timeIn' => $row['task_timeIn'],
            'task_note'  => $row['task_note'],
            'col_dosage' => $row['col_dosage'],
            'care_calls' => $row['care_calls'], // used as dose label
            'outcome'    => $row['col_outcome']
        ];

        $dates[$med_date] = date("jS M", strtotime($row['med_date']));
    }
}

// Sort dates in ascending order
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
?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">
                                <?php
                                $myuryyToeSS4 = $uryyToeSS4;
                                $stmt = $conn->prepare("SELECT client_first_name FROM tbl_general_client_form 
                                                        WHERE uryyToeSS4 = ? AND col_company_Id = ?");
                                $stmt->bind_param("ss", $myuryyToeSS4, $_SESSION['usr_compId']);
                                $stmt->execute();
                                $stmt->bind_result($clientFirstName);
                                $stmt->fetch();
                                echo htmlspecialchars($clientFirstName, ENT_QUOTES, 'UTF-8') . "'s MarChart";
                                $stmt->close();
                                ?>
                            </h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i>Home</a></li>
                            <li class="breadcrumb-item"><a href="#!">Client</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5></h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>

                        <div style="margin-top: 15px;" class="row">
                            <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-primary text-decoration-none" href="../client-medication?uryyToeSS4=<?php echo $myuryyToeSS4; ?>">
                                        <i class="feather mr-2 icon-plus"></i> Add Meds
                                    </a>
                                    <a class="btn btn-info text-decoration-none" href="./marchart?uryyToeSS4=<?php echo $myuryyToeSS4; ?>" style="text-decoration:none;">
                                        <i class="feather mr-2 icon-list"></i>MarChart
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3">
                                <div style="text-align: center; margin-bottom: 20px;">
                                    <a class="text-decoration-none btn btn-sm btn-info" href="?uryyToeSS4=<?php echo urlencode($uryyToeSS4); ?>&month=<?php echo $prev_month; ?>&year=<?php echo $prev_year; ?>">&#9665;</a>
                                    <strong><?php echo date("F Y", mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?></strong>
                                    <a class="text-decoration-none btn btn-sm btn-info" href="?uryyToeSS4=<?php echo urlencode($uryyToeSS4); ?>&month=<?php echo $next_month; ?>&year=<?php echo $next_year; ?>">&#9655;</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6 col-sm-6 col-lg-6 text-right">
                                <a href="./download-marchart?uryyToeSS4=<?= $uryyToeSS4 ?>" class="btn btn-primary" title="Download March Chart">Download</a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <?php
                                $current_year = date('Y');
                                $current_month = date('m');
                                $days_in_month = date('t');
                                $dates = [];
                                for ($day = 1; $day <= $days_in_month; $day++) {
                                    $date_key = date('Y-m-d', strtotime("$current_year-$current_month-$day"));
                                    $dates[$date_key] = $day;
                                }
                                $today_date = date('Y-m-d');

                                if (!empty($medications)) { ?>
                                    <table class="table table-striped table-hover text-left mb-0">
                                        <thead>
                                            <tr>
                                                <th>Medication Name</th>
                                                <?php foreach ($dates as $date_key => $day_number) {
                                                    echo "<th>$day_number</th>";
                                                } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($medications as $med_name => $med_dates) { ?>
                                                <tr>
                                                    <td class="text-left"><?php echo htmlspecialchars($med_name); ?></td>
                                                    <?php foreach ($dates as $date_key => $day_number) { ?>
                                                        <td class="text-center">
                                                            <?php
                                                            if (isset($med_dates[$date_key])) {
                                                                // Sort doses according to $dose_order
                                                                $sorted_doses = [];
                                                                foreach ($dose_order as $label) {
                                                                    foreach ($med_dates[$date_key] as $entry) {
                                                                        if ($entry['care_calls'] === $label) {
                                                                            $sorted_doses[] = $entry;
                                                                        }
                                                                    }
                                                                }

                                                                // Render circles
                                                                foreach ($sorted_doses as $entry) {
                                                                    $status = $entry['outcome'];
                                                                    $colorClass = ($status === "Fully taken") ? "green-circle" : (($status === "Not taken") ? "red-circle" : "grey-circle");
                                                                    $title = $entry['care_calls'] . " - " . $status;

                                                                    echo '<span title="' . $title . '" class="' . $colorClass . '" style="cursor:pointer;" ' .
                                                                        'data-med_date="' . $entry['med_date'] . '" ' .
                                                                        'data-task_timeIn="' . $entry['task_timeIn'] . '" ' .
                                                                        'data-task_note="' . htmlspecialchars($entry['task_note'], ENT_QUOTES) . '" ' .
                                                                        'data-col_dosage="' . htmlspecialchars($entry['col_dosage'], ENT_QUOTES) . '" ' .
                                                                        'data-care_calls="' . htmlspecialchars($entry['care_calls'], ENT_QUOTES) . '" ' .
                                                                        'data-toggle="modal" data-target="#medDetailModal"></span> ';
                                                                }
                                                            } else {
                                                                if ($date_key < $today_date) {
                                                                    echo '<span title="Missed" class="red-circle"></span>';
                                                                } else {
                                                                    echo '<span title="Pending" class="grey-circle"></span>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else {
                                    echo "<p>No medication records found for the selected month and year.</p>";
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
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

    </div>
</div>

<script type="text/javascript">
    $('#medDetailModal').on('show.bs.modal', function(event) {
        var span = $(event.relatedTarget);
        $('#modal-med-date').text(span.data('med_date'));
        $('#modal-dose-label').text(span.data('care_calls'));
        $('#modal-task-timeIn').text(span.data('task_timein'));
        $('#modal-task-note').text(span.data('task_note'));
        $('#modal-col-dosage').text(span.data('col_dosage'));
    });

    // Search input and checkboxes JS
    let names = [];
    let sortedNames = names.sort();
    let input = document.getElementById("input");
    input.addEventListener("keyup", (e) => {
        removeElements();
        for (let i of sortedNames) {
            if (i.toLowerCase().startsWith(input.value.toLowerCase()) && input.value != "") {
                let listItem = document.createElement("li");
                listItem.classList.add("list-items");
                listItem.style.cursor = "pointer";
                listItem.setAttribute("onclick", "displayNames('" + i + "')");
                let word = "<b>" + i.substr(0, input.value.length) + "</b>";
                word += i.substr(input.value.length);
                listItem.innerHTML = word;
                document.querySelector(".list").appendChild(listItem);
            }
        }
    });

    function displayNames(value) {
        input.value = value;
        removeElements();
    }

    function removeElements() {
        let items = document.querySelectorAll(".list-items");
        items.forEach((item) => {
            item.remove();
        });
    }
    let show = true;

    function showCheckboxes() {
        let checkboxes = document.getElementById("checkBoxes");
        if (show) {
            checkboxes.style.display = "block";
            show = false;
        } else {
            checkboxes.style.display = "none";
            show = true;
        }
    }
</script>

<?php include('footer-contents.php'); ?>