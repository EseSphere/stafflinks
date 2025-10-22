<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <?php
        if (isset($_GET['col_carer_Id'])) {
            $varCarerId = $_GET['col_carer_Id'];
        }
        $result = mysqli_query($conn, "SELECT * FROM tbl_pay_run WHERE (col_carer_Id = '$varCarerId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') GROUP BY col_carer_Id ");
        while ($row = mysqli_fetch_array($result)) {
            $varPayrollDate = date('d M, Y', strtotime("" . $row['dateTime'] . ""));
            $carer_specialId = $row['col_carer_Id'];
            $varCareCallRate = $row['col_work_rate'];
            $varStartTime = $row['col_Time_In'];
            $varEndTime = $row['col_Time_Out'];
            $varCareGiverName = $row['col_caregiver'];
            $total_carerMileage = $row['col_mileage_rate'];
        ?>
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">
                                    Pay run
                                    <br>
                                    <small><?php print $varCareGiverName; ?>'s paysheet</small>
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
                <!-- prject ,team member start -->
                <div class="col-xl-12 col-md-12">
                    <div class="card-header">
                        <div style="width: 100%; height:auto; padding:2px; text-align:right;">
                            <!-- <button style="width: 100px;" class="btn btn-secondary btn-small">Export</button>
                            <button style="width: 130px;" class="btn btn-info btn-small">Create pay run</button>-->
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th class="text-left">Total</th>
                                    </tr>
                                </thead>

                                <?php
                                $sql_total_hour = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`col_Time_Out`, `col_Time_In`)))) AS total_worked_hours FROM `tbl_pay_run` WHERE (col_carer_Id = '$varCarerId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                $row_total_hour = mysqli_fetch_array($sql_total_hour, MYSQLI_ASSOC);
                                $total_hours = $row_total_hour['total_worked_hours'];
                                // Split the time into hours, minutes, and seconds
                                list($hours, $minutes, $seconds) = explode(':', $total_hours);
                                // Convert the time into seconds
                                $total_seconds = $hours * 3600 + $minutes * 60 + $seconds; // Outputs: 9045

                                $hours = floor($total_seconds / 3600);
                                $minutes = floor(($total_seconds % 3600) / 60);
                                $seconds = $total_seconds % 60;

                                $formatted_Carertime = sprintf('%02d:%02d', $hours, $minutes, $seconds);

                                $sql_carer_rate = mysqli_query($conn, "SELECT col_pay_rate AS carer_rate FROM `tbl_general_team_form` WHERE (uryyTteamoeSS4 = '$varCarerId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                $row_carer_rate = mysqli_fetch_array($sql_carer_rate, MYSQLI_ASSOC);
                                $total_carer_rate = $row_carer_rate['carer_rate'];

                                $hours = '' . $formatted_Carertime;
                                $time = explode(':', $hours);
                                if (count($time) != 2)
                                    throw new Exception("Invalid value!");
                                $hr = $time[0] + ($time[1] / 60);

                                $price = '' . $total_carer_rate;
                                $varTAIH = $hr * $price;
                                $varTotalAmInHour = number_format((float)$varTAIH, 2, '.', '');

                                //$varTotalRateInHour = $formatted_Carertime * $total_carer_rate;
                                //$varTotalAmInHour = number_format(round($varTotalRateInHour));

                                $sql_total_mileage = mysqli_query($conn, "SELECT SUM(`col_mileage_rate`) AS total_mileage FROM `tbl_pay_run` WHERE (col_carer_Id = '$varCarerId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                $row_total_mileage = mysqli_fetch_array($sql_total_mileage, MYSQLI_ASSOC);
                                $total_carerMileage = number_format((float)$row_total_mileage['total_mileage'], 2, '.', '');

                                $varTotalMiles = $total_carerMileage / 0.25;
                                $varTotalInMiles = number_format(round($varTotalMiles));
                                $varAmountInMiles = $varTotalMiles * 0.25;

                                $varGrossPay = $varTotalAmInHour + $total_carerMileage;

                                ?>
                                <tbody>
                                    <tr>
                                        <td>Care delivery (Personal Care)</td>
                                        <td><?php echo $formatted_Carertime; ?> hours</td>
                                        <td>£<?php echo $total_carer_rate; ?></td>
                                        <td class="text-left">£<?php echo $varTotalAmInHour; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mileage</td>
                                        <td><?php echo $total_carerMileage; ?> miles</td>
                                        <td>£<?php echo $varTotalMiles; ?></td>
                                        <td class="text-left">£<?php echo $varAmountInMiles; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Waiting</td>
                                        <td>0 minutes</td>
                                        <td>£0.00</td>
                                        <td class="text-left">£0.00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th class="text-left">Total</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div style="margin-top: 30px; width: 100%; height:auto;">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Pay summary</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Gross pay</td>
                                                    <td>£<?php echo $varGrossPay; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total pay</td>
                                                    <td>£<?php echo $varGrossPay; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php
                        }
                        mysqli_close($conn);
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>

<?php include('footer-contents.php'); ?>