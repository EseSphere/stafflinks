<?php
include_once('header-panel.php');
$txtDate = isset($_REQUEST['txtDate']) ? mysqli_real_escape_string($myConnection, $_REQUEST['txtDate']) : date('Y-m-d');
$rotaDateByDay = date('d l M, Y', strtotime($txtDate));
$currentDateRota = date('Y-m-d', strtotime($txtDate));
$viewRotaByDate = date('D m Y', strtotime($txtDate));
$_SESSION['currentDateRota'] = $currentDateRota;
$curRotaDay = $txtDate;
$currentRotaDay = date('l', strtotime($curRotaDay));
$_SESSION['currentRotaDay'] = $currentRotaDay;
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xl-4 col-lg-4">
                <form action="./cookie-cities" method="POST" enctype="multipart/form-data" name="areaForm" autocomplete="off">
                    <div class="form-group">
                        <form style="margin-top: 5px;" action="./cookie-cities" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="txtCurrentDate" value="<?php echo $currentDateRota; ?>">
                            <select onchange="this.form.submit()" name="Runfname" aria-placeholder=" --Select option--" class="form-control" id="txtSelectArea">
                                <option value="">
                                    <?php
                                    if (isset($_COOKIE['companyCity'])) {
                                        echo $_COOKIE["companyCity"];
                                    } else {
                                        echo "Select city...";
                                    } ?>
                                </option>
                                <option value="Wolverhampton">Wolverhampton</option>
                                <option value="Supported live in">Supported live in</option>
                                <option value="Stoke on Trent">Stoke on trent</option>
                            </select>
                        </form>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-sm-4 col-xl-4 col-lg-4">
                <div class="date-control">
                    <form style="margin-top: 5px;" action="./schedule-visits" method="GET" enctype="multipart/form-data" autocomplete="off">
                        <button style="font-size: 22px; cursor: pointer; background-color:inherit; border:none;font-size: 25px; color:red !important; font-weight:800;" id="decrement">&larr;</button>
                        <input name='txtDate' onchange='this.form.submit()' style="background-color: inherit; border:none;font-size: 20px; color:red !important; font-weight:600;" type="date" id="dateInput" value="<?php echo $currentDateRota; ?>">
                        <button style="font-size: 22px; cursor: pointer; background-color:inherit; border:none;font-size: 25px; color:red !important; font-weight:800;" id="increment">&rarr;</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xl-4 col-lg-4">
                <div class="btn-group flex justify-end items-end bg-dark w-100" role="group" aria-label="Group of buttons">
                    <a href="./" style="text-decoration: none; color: white; background-color:#E3C5B2; border:none; width:70px;" type="button" class="btn btn-info"><i class="fa-solid fa-clipboard-list"></i> View rota</a>
                    <a href="../dashboard" style="text-decoration: none; background-color:#EB6F46; border:none; width:70px;" type="button" class="btn btn-success"><i class="fa-solid fa-house"></i> Dashboard</a>
                    <a href="./schedule-visits?txtDate=<?php echo date('Y-m-d'); ?>" style="text-decoration: none; background-color:#A72218; border:none; width:70px;" type="button" class="btn btn-primary"><i class="fa-solid fa-users"></i> Plan roster</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <br>
        <h5 style="padding: 0px 0px 0px 25px;">Roster<br>
            <small>
                <?php
                echo date('l, F j, Y', strtotime($currentDateRota));
                $varCurrentDateInDay = date('l', strtotime($currentDateRota));
                ?>
            </small>
        </h5>
        <hr>
        <div class="scrolling-wrapper">
            <?php
            // Plan visits
            $sel_dist_att = mysqli_query($myConnection, "
    SELECT DISTINCT col_run_name, run_area_nameId 
    FROM tbl_manage_runs 
    WHERE col_run_name != '' 
      AND col_client_city = '" . mysqli_real_escape_string($myConnection, $_COOKIE["companyCity"]) . "' 
      AND col_company_Id = '" . mysqli_real_escape_string($myConnection, $_SESSION['usr_compId']) . "'
");

            while ($att_rw = mysqli_fetch_assoc($sel_dist_att)) {
                $db_run_name = $att_rw['col_run_name'];
                $run_area_nameId = $att_rw['run_area_nameId'];

                // Get the first_carer from schedule_calls (even if all visits are cancelled)
                $check_schedule = mysqli_query($myConnection, "
        SELECT first_carer 
        FROM tbl_schedule_calls 
        WHERE col_run_name = '" . mysqli_real_escape_string($myConnection, $db_run_name) . "' 
          AND Clientshift_Date = '$currentDateRota'
        LIMIT 1
    ");

                $hold_allocated_carer_name = '';
                $runColor = '#192a56';
                if (mysqli_num_rows($check_schedule) > 0) {
                    $row_schedule = mysqli_fetch_assoc($check_schedule);
                    $hold_allocated_carer_name = $row_schedule['first_carer'];
                    $runColor = 'rgba(22, 160, 133,1.0)';
                }

                // Weekday condition
                $weekdayCondition = implode(' OR ', array_map(function ($day) use ($varCurrentDateInDay) {
                    return "mr.$day = '$varCurrentDateInDay'";
                }, ['col_monday', 'col_tuesday', 'col_wednesday', 'col_thursday', 'col_friday', 'col_saturday', 'col_sunday']));

                // Select visits (including cancelled visits)
                // ✅ Added cc.cancelled_by to SELECT so we can show who cancelled
                $sel_dist_attr = mysqli_query($myConnection, "
        SELECT mr.*, cc.col_client_Id AS cancelled_client_id, cc.cancelled_by AS cancelled_by
        FROM tbl_manage_runs AS mr
        LEFT JOIN tbl_cancelled_call AS cc
            ON mr.uryyToeSS4 = cc.col_client_Id
            AND mr.care_calls = cc.col_care_call
            AND DATE(cc.col_date) = '" . mysqli_real_escape_string($myConnection, $currentDateRota) . "'
        LEFT JOIN tbl_client_status_records AS csr
            ON mr.uryyToeSS4 = csr.col_client_Id
            AND mr.col_company_Id = csr.col_company_Id
            AND (
                ('" . mysqli_real_escape_string($myConnection, $currentDateRota) . "' BETWEEN STR_TO_DATE(csr.col_start_date, '%Y-%m-%d') 
                                                                AND STR_TO_DATE(csr.col_end_date, '%Y-%m-%d'))
                OR
                ('" . mysqli_real_escape_string($myConnection, $currentDateRota) . "' > STR_TO_DATE(csr.col_start_date, '%Y-%m-%d') 
                 AND csr.col_end_date = 'TFN')
            )
        WHERE mr.col_run_name = '" . mysqli_real_escape_string($myConnection, $db_run_name) . "' 
          AND ($weekdayCondition)
           AND (col_monday = '$varCurrentDateInDay' OR col_tuesday = '$varCurrentDateInDay' OR col_wednesday = '$varCurrentDateInDay' 
                OR col_thursday = '$varCurrentDateInDay' OR col_friday = '$varCurrentDateInDay' OR col_saturday = '$varCurrentDateInDay' 
                OR col_sunday = '$varCurrentDateInDay')
          AND mr.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
          AND csr.col_client_Id IS NULL
        ORDER BY mr.dateTime_in ASC
    ");

                $links = [];
                while ($att_cor_rw = mysqli_fetch_assoc($sel_dist_attr)) {
                    $id = $att_cor_rw["id"];
                    $clientFullName = htmlspecialchars($att_cor_rw["client_name"]);
                    $myuryyToeSS4 = htmlspecialchars($att_cor_rw["uryyToeSS4"]);
                    $mycare_calls = htmlspecialchars($att_cor_rw["care_calls"]);
                    $dateTime = htmlspecialchars($att_cor_rw["dateTime_in"] . ' → ' . $att_cor_rw["dateTime_out"]);
                    $requiredCarers = htmlspecialchars($att_cor_rw["col_required_carers"]);

                    // Check if this visit is cancelled
                    $isCancelled = !empty($att_cor_rw['cancelled_client_id']);
                    $cancelDot = $isCancelled ? "<span style='color:red; font-weight:bold;'>&#9679;</span> " : "";

                    $cancelledBy = ($isCancelled && !empty($att_cor_rw['cancelled_by'])) ? htmlspecialchars($att_cor_rw['cancelled_by'], ENT_QUOTES) : '';
                    $tooltipOnA = ($isCancelled && $cancelledBy !== '') ? ' title="Cancelled by ' . $cancelledBy . '"' : '';

                    $visitStyle = $isCancelled
                        ? "background-color: #dcdcdc; color:#555;"
                        : "color:#000;";

                    // List of visits (tooltip applied to the <a> so hover on link shows it)
                    $links[] = "
<li style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis; 
           width: 150px; text-align:center; $visitStyle'>
    <a href='../change-client-run-567483-59956-847754?id=" . urlencode($id) . "&name=$clientFullName&spec=$myuryyToeSS4&visit=$mycare_calls&date=$currentDateRota&u7ye=$crackEncryptedbinary' " . $tooltipOnA . " 
    style='padding:5px 10px 9px 8px; text-decoration:none; color:#000; display:block;'>
        {$cancelDot}{$clientFullName}<br>
        <span>{$dateTime}</span> &nbsp; <span>{$requiredCarers}</span>
    </a>
</li>
        ";
                }

                if (!empty($links)) {
            ?>
                    <!-- List of run names -->
                    <div id='item-list'>
                        <div class='row'>
                            <div style='padding: 0;' class='col-md-2 col-sm-2 col-xl-2 col-lg-2 col-2'>
                                <a href="../assign-visits?run_area_nameId=<?= htmlspecialchars($run_area_nameId) ?>&u7ye=<?= $crackEncryptedbinary ?>" style="text-decoration: none; text-align:left;">
                                    <div style="color:white; background-color:<?= $runColor ?>;" id='left-panel-items'>
                                        <?= htmlspecialchars($db_run_name) ?>
                                        <?php if (!empty($hold_allocated_carer_name)) : ?>
                                            <br>
                                            <span style='font-size:13px; color:rgba(255, 255, 255,1.0); font-weight:600;'>
                                                <?= htmlspecialchars($hold_allocated_carer_name) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                            <div style='padding:8px; font-size:16px;' class='col-md-10 col-sm-10 col-xl-10 col-lg-10 col-10'>
                                <ul class='care-visit-list'>
                                    <?= implode('', $links) ?>
                                </ul>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </div>
    </div>
    <div class=" content-footer"></div>
</div>


<script>
    // Get date input and buttons
    const dateInput = document.getElementById("dateInput");
    const incrementButton = document.getElementById("increment");
    const decrementButton = document.getElementById("decrement");

    function adjustDate(days) {
        const currentDate = new Date(dateInput.value);
        currentDate.setDate(currentDate.getDate() + days);
        dateInput.value = currentDate.toISOString().split("T")[0];
    }
    incrementButton.addEventListener("click", () => adjustDate(1));
    decrementButton.addEventListener("click", () => adjustDate(-1));
</script>


</body>

</html>