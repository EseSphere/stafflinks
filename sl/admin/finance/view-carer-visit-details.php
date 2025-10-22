<?php include('header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Visit details</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        $varCarerrRunId = $_GET['userId'];
                        $result = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE (userId = '$varCarerrRunId' AND col_visit_confirmation = 'Confirmed'  AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                        while ($row = mysqli_fetch_array($result)) {
                            $varClientId = $row['uryyToeSS4'];
                            $varCareCallType = $row['col_care_call'];
                            $varShiftDate = $row['shift_date'];
                            $varConvertDate = date('d M, Y', strtotime("" . $varShiftDate . ""));
                        ?>
                            <div style="width: 100%; height:auto; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; font-size:18px;">
                                <div style="width: 100%; height:auto; padding:10px; background-color:rgba(44, 62, 80,1.0); color:white;">
                                    <h5><?php echo "" . $row['carer_Name'] . ""; ?>
                                        <br>
                                        <small>
                                            Payroll details
                                        </small>
                                    </h5>
                                </div>
                                <div style="width: 100%; padding:22px;">
                                    <div class="row">
                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit date</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $varConvertDate . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5>Planned</h5>
                                        </div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit start @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['planned_timeIn'] . ""; ?></div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit end @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['planned_timeOut'] . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5>Actual</h5>
                                        </div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit start @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['shift_start_time'] . ""; ?></div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit end @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['shift_end_time'] . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5>Care call</h5>
                                        </div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Type</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['col_care_call'] . " call"; ?></div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Area</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['client_group'] . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5 style="color: rgba(44, 62, 80,.5);">Note</h5>
                                            <hr>
                                            <?php echo "" . $row['task_note'] . ""; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                            $result = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE (uryyToeSS4 = '$varClientId' AND col_care_call = '$varCareCallType' AND shift_date = '$varShiftDate' AND userId != '$varCarerrRunId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                            while ($row = mysqli_fetch_array($result)) {
                                $varClientId = $row['uryyToeSS4'];
                                $varCareCallDate = $row['shift_date'];
                                $varCareCallType = $row['col_care_call'];
                                $varShiftDate = $row['shift_date'];
                                $varConvertDate = date('d M, Y', strtotime("" . $varShiftDate . ""));
                        ?>

                            <div style="width: 100%; height:auto; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; font-size:18px;">
                                <div style="width: 100%; height:auto; padding:10px; background-color:rgba(22, 160, 133,1.0); color:white;">
                                    <h5><?php echo "" . $row['carer_Name'] . ""; ?>
                                        <br>
                                        <small>
                                            Payroll details
                                        </small>
                                    </h5>
                                </div>
                                <div style="width: 100%; padding:22px;">
                                    <div class="row">
                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit date</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $varConvertDate . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5>Planned</h5>
                                        </div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit start @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['planned_timeIn'] . ""; ?></div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit end @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['planned_timeOut'] . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5>Actual</h5>
                                        </div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit start @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['shift_start_time'] . ""; ?></div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Visit end @</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['shift_end_time'] . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5>Care call</h5>
                                        </div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Type</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['col_care_call'] . " call"; ?></div>

                                        <div style="color: rgba(44, 62, 80,.5);" class="col-md-3 col-9">Area</div>
                                        <div class="col-md-3 col-9"><?php echo "" . $row['client_group'] . ""; ?></div>

                                        <div style="margin-top: 15px;" class="col-md-12">
                                            <h5 style="color: rgba(44, 62, 80,.5);">Note</h5>
                                            <hr>
                                            <?php echo "" . $row['task_note'] . ""; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
        <?php
                            }
                        }
                        mysqli_close($conn);
        ?>
            </div>

        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>

<?php include('footer-contents.php'); ?>