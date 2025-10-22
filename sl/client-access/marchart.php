<?php
include('client-header-contents.php');
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
                                WHERE uryyToeSS4 = '$myuryyToeSS4'");
                                while ($showRows = mysqli_fetch_assoc($sqlResult)) {
                                    echo "" . $showRows['client_first_name'] . "'s MarChart";
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
                            <div class="col-md-6 col-xl-6 col-sm-6 col-lg-6 col-5">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-danger text-decoration-none" href="./eMarChart?uryyToeSS4=<?php echo $myuryyToeSS4; ?>" style="text-decoration:none;">
                                        <i class="feather mr-2 icon-eye"></i>eMarChart
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3 col-7">
                                <div style="text-align: center; margin-bottom: 20px;">
                                    <a class="text-decoration-none btn btn-sm btn-info" href="?uryyToeSS4=<?php echo urlencode($uryyToeSS4); ?>&month=<?php echo $prev_month; ?>&year=<?php echo $prev_year; ?>">&#9665;</a>
                                    <strong><?php echo date("F Y", mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?></strong>
                                    <a class="text-decoration-none btn btn-sm btn-info" href="?uryyToeSS4=<?php echo urlencode($uryyToeSS4); ?>&month=<?php echo $next_month; ?>&year=<?php echo $next_year; ?>">&#9655;</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3"></div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Medication Name</th>
                                        <th>Outcome</th>
                                        <th>Reason</th>
                                        <th>Date & Time</th>
                                        <th>Carer</th>
                                        <th>Dose</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $firstDayOfMonth = date('Y-m-d', strtotime('first day of this month'));
                                    $lastDayOfMonth = date('Y-m-d', strtotime('last day of this month'));
                                    $result = mysqli_query($conn, "SELECT * FROM tbl_finished_meds 
                                        WHERE uryyToeSS4 = '$myuryyToeSS4' 
                                        AND (med_date BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth') 
                                        ORDER BY med_Id ASC");
                                    while ($trans = mysqli_fetch_array($result)) {
                                        $medVisitDate = date('d M, Y', strtotime("" . $trans['dateTime'] . ""));
                                        $medVisitTime = date('H:i', strtotime("" . $trans['dateTime'] . ""));
                                        echo "
                                            <tr>
                                                <td>
                                                    <div class='d-inline-block align-middle'>
                                                        <div class='d-inline-block'>
                                                            <h6> " . $trans['task_name'] . "</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style='font-weight:600;'>" . $trans['col_outcome'] . "</td>
                                                <td style='font-weight:600;'>" . $trans['task_note'] . "</td>
                                                <td style='font-weight:600;'>" . $medVisitDate . " @ " . $medVisitTime . "</td>
                                                <td style='font-weight:600;'>" . $trans['col_carername'] . "</td>
                                                <td style='font-weight:600;'>" . $trans['col_dosage'] . "</td>
                                                <td>
                                                <a style='text-decoration:none;' href='./edith-client-marchart?med_Id=" . $trans['med_Id'] . "'> <button title='Edit client medication' type='button' class='btn btn-primary btn-sm'>Edit</button> </a>
                                                </td>

                                            </tr>
                                            ";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    /**/
    let names = [

    ];
    let sortedNames = names.sort();
    let input = document.getElementById("input");
    input.addEventListener("keyup", (e) => {
        removeElements();
        for (let i of sortedNames) {

            if (
                i.toLowerCase().startsWith(input.value.toLowerCase()) &&
                input.value != ""
            ) {
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