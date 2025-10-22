<?php include('header-contents.php'); ?>
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

        /* Added text color for better visibility */
    }
</style>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Pay dashboard
                                <br>
                                <small>
                                    Select a date range and filters to run payroll
                                </small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <hr>
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->

            <!-- table card-1 end -->

            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">

                <div class="col-md-12">
                    <form action="./pay-dashboard-result" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Period Start<span style="color: red;"> *</span></label>
                                    <input type="date" name="txtPeriodStart" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Period End<span style="color: red;"> *</span></label>
                                    <input type="date" name="txtPeriodEnd" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Caregiver<span style="color: red;"></span></label>
                                <select name="txtCareGiver" class="form-control" id="exampleFormControlSelect1">
                                    <option value='' selected='selected' disabled='disabled'>Select...</option>
                                    <?php
                                    $getCareRecipient = mysqli_query($conn, "SELECT * FROM tbl_general_team_form");
                                    while ($fetchData = mysqli_fetch_array($getCareRecipient)) {
                                        echo "
                                            <option value='" . $fetchData['team_first_name'] . " " . $fetchData['team_last_name'] . "'>" . $fetchData['team_first_name'] . " " . $fetchData['team_last_name'] . "</option>
                                        ";
                                    }
                                    ?>
                                    <!--<option value='Null'>Select all</option>-->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input style="float: right;" type="submit" name="btnFetchData" class="btn btn-small btn-info" value="Fetch data" />
                        </div>
                    </form>
                </div>
                <br>
                <hr>

                <br>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div style="width: 100%; height:auto; padding:32px; color:rgba(44, 62, 80,1.0); border:1px solid rgba(44, 62, 80,.2);">
                            <span>Balance</span>
                            <br>
                            <?php
                            if (isset($_POST['btnFetchData'])) {
                                $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
                                $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
                                $txtCareGiver = mysqli_real_escape_string($conn, $_POST['txtCareGiver']);

                                $txtPeriodStart = date('Y-m-01');
                                $txtPeriodEnd  = date('Y-m-t');
                                $result = mysqli_query($conn, "SELECT SUM(`col_carecall_rate`) AS total_payment FROM `tbl_daily_shift_records` WHERE `timesheet_date` >= '$txtPeriodStart' AND `timesheet_date` <= '$txtPeriodEnd' AND carer_Name = '$txtCareGiver' ");
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $total_payment = $row['total_payment'];

                                echo "<h5>£" . $total_payment . "</h5>";
                            } ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div style="width: 100%; height:auto; padding:32px; color:rgba(44, 62, 80,1.0); border:1px solid rgba(44, 62, 80,.2);">
                            <span>Hours</span>
                            <br>
                            <h5>
                                <?php
                                if (isset($_POST['btnFetchData'])) {
                                    $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
                                    $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
                                    $txtCareGiver = mysqli_real_escape_string($conn, $_POST['txtCareGiver']);

                                    $txtPeriodStart = date('Y-m-01');
                                    $txtPeriodEnd  = date('Y-m-t');
                                    $result = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) AS total_worked_hours FROM `tbl_daily_shift_records` WHERE `timesheet_date` >= '$txtPeriodStart' AND `timesheet_date` <= '$txtPeriodEnd' AND carer_Name = '$txtCareGiver' ");
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    $total_hours = $row['total_worked_hours'];

                                    $time = strtotime($total_hours);
                                    $round = 60;
                                    $rounded = round($time / $round) * $round;
                                    echo date("H:i", $rounded);
                                } ?>
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="tab-content pt-5" id="tab-content">
                    <div class="card table-card tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-1">
                        <div class="card-header">
                            <h5></h5>
                            <div class="card-header-right">

                                <div class="btn-group card-option">
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Caregiver</th>
                                            <th>Care delivery</th>
                                            <th>Planned time</th>
                                            <th>Date(From - To)</th>
                                            <th>Day(s)</th>
                                            <th>Expenses</th>
                                            <th class="text-left">Total</th>
                                            <th>Decision</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['btnFetchData'])) {
                                            $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
                                            $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
                                            $txtCareGiver = mysqli_real_escape_string($conn, $_POST['txtCareGiver']);

                                            $sqlSelection = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE `timesheet_date` >= '$txtPeriodStart' AND `timesheet_date` <= '$txtPeriodEnd' AND carer_Name = '$txtCareGiver' ");
                                            while ($rowResult = mysqli_fetch_array($sqlSelection)) {


                                                $sqlDaysel = mysqli_query($conn, "SELECT DATEDIFF(`timesheet_date`, `timesheet_date`)+1 AS `days` FROM `tbl_daily_shift_records`");
                                                $rowof_days = mysqli_fetch_array($sqlDaysel, MYSQLI_ASSOC);
                                                $total_days = $rowof_days['days'];

                                                $result = mysqli_query($conn, "SELECT SUM(`col_carecall_rate`) AS total_payment FROM `tbl_daily_shift_records` WHERE `timesheet_date` >= '$txtPeriodStart' AND `timesheet_date` <= '$txtPeriodEnd' AND carer_Name = '$txtCareGiver' ");
                                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                $total_payment = $row['total_payment'];

                                                $result1 = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) AS total_worked_hours FROM `tbl_daily_shift_records` WHERE `timesheet_date` >= '$txtPeriodStart' AND `timesheet_date` <= '$txtPeriodEnd' AND carer_Name = '$txtCareGiver' ");
                                                $row_total_hour = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                                                $total_hours = $row_total_hour['total_worked_hours'];

                                                $time = strtotime($total_hours);
                                                $round = 60;
                                                $rounded = round($time / $round) * $round;
                                                $totalHour = date("H:i", $rounded);

                                                echo "
                                            <tr>
                                                <td>" . $rowResult['carer_Name'] . "</td>
                                                <td>
                                                <span style='font-size:16px;'><strong>£$total_payment</strong></span>
                                                <br>
                                                <span style='font-size:16px;'><strong>$totalHour hours</strong></span>
                                                </td>
                                                <td>" . $rowResult['planned_timeIn'] . " - " . $rowResult['planned_timeOut'] . "</td>
                                                <td>$txtPeriodStart - $txtPeriodEnd</td>
                                                <td>$total_days days</td>
                                                <td>£0.00</td>
                                                <td><span style='font-size:16px; color:rgba(39, 174, 96,1.0);'><strong>£$total_payment</strong></span></td>
                                                <td><a href='./client-task?carer_Name=" . $rowResult['carer_Name'] . "'> <button title='View client task' type='button' class='btn  btn-primary btn-sm'><i class='feather mr-2 icon-list'></i></button></a></td>
                                            </tr>
                                            ";
                                            }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Caregiver</th>
                                            <th>Care delivery</th>
                                            <th>Planned time</th>
                                            <th>Date(From - To)</th>
                                            <th>Day(s)</th>
                                            <th>Expenses</th>
                                            <th class="text-left">Total</th>
                                            <th>Decision</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>

<?php include('footer-contents.php'); ?>