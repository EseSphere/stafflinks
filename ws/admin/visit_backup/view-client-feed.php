<?php include_once('feeds-header.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div style="width: 100%; height:auto;" id="printableArea">
            <div class="row">
                <?php
                $myIduser = $_GET['userId'];
                $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE userId = '$myIduser' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                while ($row = mysqli_fetch_array($result)) {
                    $varShiftDate = $row['Clientshift_Date'];
                    $varClientSpecialId = $row['uryyToeSS4'];
                    $clientVisitDate = date('d M, Y', strtotime("" . $row['Clientshift_Date'] . ""));

                ?>

                    <!-- Clients feed, team member start -->
                    <div class="col-xl-4">
                        <div class='card table-card'>
                            <div class='card-header'>
                                <h4 style="float: right;"><i class='feather mr-2 icon-users'></i></h4>
                                <br>
                                <p style="font-size: 22px;">
                                <h4><strong>Date</strong></h4>
                                <span style="font-size: 16px; font-weight:600;"><?php echo "" . $clientVisitDate . "" ?></span>
                                </p>
                                <hr>
                                <p style="font-size: 22px;">
                                <h4><strong>Name</strong></h4>
                                <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row['client_name'] . "" ?></span>
                                </p>
                                <hr>
                                <h4><strong>Status</strong></h4>
                                <span style="font-size: 16px; font-weight:600;">Completed</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class='card table-card'>
                            <div class='card-header'>
                                <?php
                                $result_finish_shift = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE (shift_date = '$varShiftDate' AND col_care_call = '$varClientCareCall' AND uryyToeSS4 = '$varClientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY userId DESC LIMIT 1");
                                while ($row_finish_shift = mysqli_fetch_array($result_finish_shift)) {
                                    $get_firstCarerid = $row_finish_shift['col_carer_Id'];
                                ?>
                                    <h4 style="float: right;"><i class='feather mr-2 icon-log-in'></i></h4>
                                    <h4><strong>Carer 1</strong><br>
                                        <small style=" font-weight:600;"><?php echo "" . $row_finish_shift['carer_Name'] . "" ?></small>
                                    </h4>
                                    <hr>
                                    <div style="padding: 12px;" class="row">
                                        <h4 style=" font-weight:600;">Planned time</h4>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time in</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['planned_timeIn'] . "" ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time out</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['planned_timeOut'] . "" ?></span>
                                        </div>
                                    </div>
                                    <div style="padding: 12px;" class="row">
                                        <h4 style=" font-weight:600;">Actual time</h4>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time in</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['shift_start_time'] . "" ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time out</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['shift_end_time'] . "" ?></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <?php
                                    $result_finish_shift = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE (col_carer_Id != '$get_firstCarerid' AND care_calls = '$varClientCareCall' AND shift_date = '$varShiftDate' AND uryyToeSS4 = '$varClientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')");
                                    while ($row_finish_shift = mysqli_fetch_array($result_finish_shift)) {
                    ?>
                        <div class="col-xl-4">
                            <div class='card table-card'>
                                <div class='card-header'>

                                    <h4 style="float: right;"><i class='feather mr-2 icon-log-in'></i></h4>
                                    <h4><strong>Carer 2</strong><br>
                                        <small style=" font-weight:600;"><?php echo "" . $row_finish_shift['carer_Name'] . "" ?></small>
                                    </h4>
                                    <hr>
                                    <div style="padding: 12px;" class="row">
                                        <h4 style=" font-weight:600;">Planned time</h4>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time in</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['planned_timeIn'] . "" ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time out</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['planned_timeOut'] . "" ?></span>
                                        </div>
                                    </div>
                                    <div style="padding: 12px;" class="row">
                                        <h4 style=" font-weight:600;">Actual time</h4>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time in</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['shift_start_time'] . "" ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 style=" font-weight:600;">Time out</h5>
                                            <br>
                                            <span style="font-size: 16px; font-weight:600;"><?php echo "" . $row_finish_shift['shift_end_time'] . "" ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php echo "";
                                    }
                                }
                            } ?>



            <div style="margin-top:50px; width:100%; height:auto; padding:22px; font-weight:600;">
                <div class="row">
                    <div class="col-xl-4">
                        <div class='card table-card'>
                            <div class='card-header'>
                                <h5 style="font-weight:600;">Medications</h5>
                            </div>
                            <?php
                            $result_med_details = mysqli_query($conn, "SELECT * FROM tbl_finished_meds WHERE (med_date = '$varShiftDate' AND care_calls = '$varClientCareCall' AND uryyToeSS4 = '$varClientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')");
                            while ($row_med_details = mysqli_fetch_array($result_med_details)) {
                                echo "
                        <div class='card-body'>
                            <div style='padding: 12px; width:100%; height:auto;'>
                                <span>" . $row_med_details['task_name'] . "</span>
                                <br>
                                <span style='color:rgba(127, 140, 141,1.0);'>" . $row_med_details['task_note'] . "</span>
                                <br>
                                <span style='float: right; font-size:14px; color:rgba(39, 174, 96,1.0);'><i class='feather mr-2 icon-clock'></i> " . $row_med_details['task_timeIn'] . "</span>
                                <br>
                                <hr>
                            </div>
                        </div>
                        ";
                            } ?>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class='card table-card'>
                            <div class='card-header'>
                                <h5 style="font-weight:600;">Task</h5>
                            </div>
                            <?php
                            $result_task_details = mysqli_query($conn, "SELECT * FROM tbl_finished_tasks WHERE (task_date = '$varShiftDate' AND care_calls = '$varClientCareCall' AND uryyToeSS4 = '$varClientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')");
                            while ($row_task_details = mysqli_fetch_array($result_task_details)) {
                                echo "
                        <div class='card-body'>
                            <div style='padding: 12px; width:100%; height:auto;'>
                                <span>" . $row_task_details['task_name'] . "</span>
                                <br>
                                <span style='color:rgba(127, 140, 141,1.0);'>" . $row_task_details['task_note'] . "</span>
                                <br>
                                <span style='float: right; font-size:14px; color:rgba(39, 174, 96,1.0);'><i class='feather mr-2 icon-clock'></i> " . $row_task_details['task_timeIn'] . "</span>
                                <br>
                                <hr>
                            </div>
                        </div>
                        ";
                            } ?>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class='card table-card'>
                            <div class='card-header'>
                                <h5 style="font-weight:600;">Observations</h5>
                            </div>
                            <div class='card-body'>
                                <div style="padding: 12px; width:100%; height:auto;">
                                    <?php
                                    $result_general_details = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE (shift_date = '$varShiftDate' AND care_calls = '$varClientCareCall' AND uryyToeSS4 = '$varClientSpecialId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')");
                                    while ($row_general_details = mysqli_fetch_array($result_general_details)) {
                                        echo "" . $row_general_details['task_note'] . "";
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="button" class="btn btn-secondary btn-large" style="width: 150px;" onclick="printDiv('printableArea')" value="Download file" />

            </div>
        </div>
        <div class="row">
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>
</div>






<?php include('footer-contents.php'); ?>