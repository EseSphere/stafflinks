<?php
include('client-header-contents.php');

if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}

$selected_month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$selected_year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$uryyToeSS4 = isset($_GET['uryyToeSS4']) ? $_GET['uryyToeSS4'] : '';

if (empty($uryyToeSS4)) {
    die("Error: Missing authentication token.");
}
$uryyToeSS4 = $conn->real_escape_string($uryyToeSS4);
$varCompanyId = $_SESSION['usr_compId'];

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

// Fetch grouped medications
$sql = "SELECT med_date, care_calls, 
        GROUP_CONCAT(task_name SEPARATOR ',') AS tasks,
        GROUP_CONCAT(col_outcome SEPARATOR '||') AS outcomes,
        GROUP_CONCAT(task_note SEPARATOR '||') AS notes,
        GROUP_CONCAT(col_carername SEPARATOR '||') AS carers,
        GROUP_CONCAT(col_dosage SEPARATOR '||') AS dosages,
        GROUP_CONCAT(med_Id SEPARATOR '||') AS med_ids
        FROM tbl_finished_meds
        WHERE uryyToeSS4 = ? AND MONTH(med_date) = ? AND YEAR(med_date) = ? AND col_company_Id = ?
        GROUP BY med_date, care_calls
        ORDER BY med_date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siis", $uryyToeSS4, $selected_month, $selected_year, $varCompanyId);
$stmt->execute();
$result = $stmt->get_result();

$groupedMeds = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $groupedMeds[] = $row;
    }
}
?>
<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }

    .multipleSelection {
        width: 200px;
        background-color: rgba(189, 195, 199, 1.0);
        font-size: 16px;
        position: absolute;
        z-index: 1000;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        padding: 5px;
        font-weight: bold;
        font-size: 16px;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkBoxes {
        display: none;
        border: 1px #8DF5E4 solid;
        height: auto;
        padding: 8px;
    }

    #checkBoxes label {
        display: block;
        padding: 5px;
    }

    #checkBoxes label:hover {
        background-color: #4F615E;
        color: white;
    }

    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }

    .multipleSelection {
        width: 200px;
        background-color: rgba(189, 195, 199, 1.0);
        font-size: 16px;
        position: absolute;
        z-index: 1000;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        padding: 5px;
        font-weight: bold;
        font-size: 16px;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkBoxes {
        display: none;
        border: 1px #8DF5E4 solid;
        height: auto;
        padding: 8px;
    }

    #checkBoxes label {
        display: block;
        padding: 5px;
    }

    #checkBoxes label:hover {
        background-color: #4F615E;
        color: white;
    }

    /* New: table text wrapping and max width */
    table.table td,
    table.table th {
        max-width: 350px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">
                                <?php
                                $sqlResult = mysqli_query($conn, "SELECT * FROM tbl_general_client_form 
                                    WHERE uryyToeSS4 = '$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                if ($showRows = mysqli_fetch_assoc($sqlResult)) {
                                    echo $showRows['client_first_name'] . "'s MarChart";
                                }
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
                            <div class="col-md-4 col-xl-4 col-sm-4 col-lg-4">
                                <div class="btn-group" role="group">
                                    <a class="btn btn-primary text-decoration-none" href="../client-medication?uryyToeSS4=<?php echo $uryyToeSS4; ?>">
                                        <i class="feather mr-2 icon-plus"></i> Add Meds
                                    </a>
                                    <a class="btn btn-danger text-decoration-none" href="./eMarChart?uryyToeSS4=<?php echo $uryyToeSS4; ?>">
                                        <i class="feather mr-2 icon-eye"></i>eMarChart
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
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover justify-start items-start text-start mb-0">
                                <thead>
                                    <tr>
                                        <th>Medication Name</th>
                                        <th>Outcome</th>
                                        <th style="width: 300px !important;">Reason</th>
                                        <th>Date & Time</th>
                                        <th>Carer</th>
                                        <th>Dose</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($groupedMeds as $group) {
                                        $tasks = explode(',', $group['tasks']);
                                        $outcomes = explode('||', $group['outcomes']);
                                        $notes = explode('||', $group['notes']);
                                        $carers = explode('||', $group['carers']);
                                        $dosages = explode('||', $group['dosages']);
                                        $med_ids = explode('||', $group['med_ids']);

                                        $med_date_display = date('d M, Y', strtotime($group['med_date']));

                                        foreach ($tasks as $i => $task_name) {
                                            $outcome = $outcomes[$i] ?? '';
                                            $note = $notes[$i] ?? '';
                                            $carer = $carers[$i] ?? '';
                                            $dosage = $dosages[$i] ?? '';
                                            $med_id = $med_ids[$i] ?? '';

                                            echo "<tr>
                                                <td><h6>{$task_name}</h6></td>
                                                <td style='font-weight:600;'>{$outcome}</td>
                                                <td style='font-weight:600; width: 300px !important;'>{$note}</td>
                                                <td style='font-weight:600;'>{$med_date_display}</td>
                                                <td style='font-weight:600;'>{$carer}</td>
                                                <td style='font-weight:600;'>{$dosage}</td>
                                                <td>
                                                    <a style='text-decoration:none;' href='./edith-client-marchart?med_Id={$med_id}'>
                                                        <button title='Edit client medication' type='button' class='btn btn-primary btn-sm'>Edit</button>
                                                    </a>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    let names = [];
    let sortedNames = names.sort();
    let input = document.getElementById("input");
    input?.addEventListener("keyup", (e) => {
        removeElements();
        for (let i of sortedNames) {
            if (i.toLowerCase().startsWith(input.value.toLowerCase()) && input.value != "") {
                let listItem = document.createElement("li");
                listItem.classList.add("list-items");
                listItem.style.cursor = "pointer";
                listItem.setAttribute("onclick", "displayNames('" + i + "')");
                let word = "<b>" + i.substr(0, input.value.length) + "</b>" + i.substr(input.value.length);
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
        document.querySelectorAll(".list-items").forEach(item => item.remove());
    }

    let show = true;

    function showCheckboxes() {
        let checkboxes = document.getElementById("checkBoxes");
        checkboxes.style.display = show ? "block" : "none";
        show = !show;
    }
</script>

<?php include('footer-contents.php'); ?>