<?php
include('header-contents.php');
include('fetching-pay-dashboard-data.php');
?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Pay dashboard</h4>
                            <p>Select a date range and filters to run payroll</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <form action="./set-dashboard-cookie" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Period Start<span style="color: red;">*</span></label>
                                    <input type="date" name="txtPeriodStart" value="<?php print $txtStartDate; ?>" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Period End<span style="color: red;">*</span></label>
                                    <input type="date" name='txtPDPeriodEnd' onchange='this.form.submit()' value="<?php print $txtEndDate; ?>" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <label for="exampleInputPassword1">Caregiver<span style="color: red;"></span></label>
                                <select name="txtCareGiver" class="form-control" id="exampleFormControlSelect1">
                                    <option value='<?php print $txtCareGiver; ?>' selected='selected'>Select...</option>
                                    <option value='Checked in'>All</option>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_daily_shift_records WHERE shift_date BETWEEN ? AND ? AND col_company_id = ? GROUP BY carer_Name ASC");
                                    $stmt->bind_param("ssi", $txtStartDate, $txtEndDate, $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $getCareRecipient = $stmt->get_result();
                                    while ($fetchData = $getCareRecipient->fetch_array()) {
                                        echo "
                                            <option value='" . $fetchData['col_carer_Id'] . "'>" . $fetchData['carer_Name'] . "</option>
                                        ";
                                    }
                                    ?>
                                    <!--<option value='Null'>Select all</option>-->
                                </select>
                                <input type="hidden" name="txtCompanyId" value="<?php print $_SESSION['usr_compId']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-12">
                            <br>
                            <div class="form-group">
                                <input type="submit" name="btnFetchPayDashData" class="btn btn-small btn-info" value="Fetch data" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-9 col-md-9">
                <div class="row">
                    <div class="col-xl-4 col-md-4">
                        <div class="card flat-card widget-primary-card">
                            <div class="row-table">
                                <div class="col-sm-3 card-body">
                                    <i class="feather icon-credit-card"></i>
                                </div>
                                <div class="col-sm-9">
                                    <h4> <?php echo '£' . $total_payment; ?></h4>
                                    <p style="font-size:16px; font-weight:600;"> Balance </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card flat-card widget-purple-card">
                            <div class="row-table">
                                <div class="col-sm-3 card-body">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="col-sm-9">
                                    <h4><?php echo $formatted_time; ?></h4>
                                    <p style="font-size:16px; font-weight:600;">Hour</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div style="background-color:rgba(52, 152, 219,1.0); color:#fff;" class="card flat-card widget-blue-card">
                            <div class="row-table">
                                <div style="background-color:rgba(41, 128, 185,1.0); color:#fff;" class="col-sm-3 card-body">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-9">
                                    <h4>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM tbl_daily_shift_records WHERE (shift_date BETWEEN ? AND ?) AND (col_carer_Id = ? OR shift_status = ?) AND col_visit_confirmation = 'Confirmed' AND col_company_id = ?");
                                        $stmt->bind_param("sssss", $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $_SESSION['usr_compId']);
                                        $stmt->execute();
                                        $result_get_total_visits = $stmt->get_result();
                                        $rowcount = $result_get_total_visits->num_rows;
                                        printf($rowcount);
                                        $result_get_total_visits->free();
                                        $stmt->close();
                                        ?>
                                        <p style="font-size:16px; font-weight:600;"> Visit </p>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="./processing-pay-dashboard-run" id="CPR" method="post" enctype="multipart/form-data" autocomplete="off"></form>
                <form action="./export-pay-dashboard" id="ExPD" method="post" enctype="multipart/form-data" autocomplete="off"></form>

                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2 col-xl-2"></div>
                        <div class="col-md-2 col-xl-2"></div>
                        <div class="col-md-2 col-xl-2"></div>
                        <div style="padding: 0;" class="col-md-1 col-xl-1">
                            <div style="width: 100%; height:auto; padding:2px; text-align:right;">
                                <input type="hidden" form="ExPD" name="txtPeriodStart" value="<?php print $txtStartDate; ?>" />
                                <input type="hidden" form="ExPD" name='txtPeriodEnd' value="<?php print $txtEndDate; ?>" />
                                <input type="hidden" form="ExPD" name='txtCaregiver' value="<?php print $txtCareGiver; ?>" />

                                <input type="hidden" form="CPR" name="txtCompanyId" value="<?php print $_SESSION['usr_compId']; ?>">
                                <input type="hidden" form="CPR" name="txtPeriodStart" value="<?php print $txtStartDate; ?>">
                                <input type="hidden" form="CPR" name="txtPeriodEnd" value="<?php print $txtEndDate; ?>">
                                <input type="hidden" form="CPR" name="txtCareGiver" value="<?php print $txtCareGiver; ?>">
                            </div>
                        </div>
                        <div style="padding: 0;" class="col-md-4 col-xl-4">
                            <div style="width: 100%; height:auto; padding:2px; text-align:right;">
                                <button type="submit" style="width: 100px;" form="ExPD" name="btnExportPayDash" class="btn btn-secondary btn-small">Export</button>
                                <button type="submit" form="CPR" name="btnCreatePayRun" class="btn btn-info btn-small">Create pay run</button>
                            </div>
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
                                    <th>Planned</th>
                                    <th>Mileage</th>
                                    <th>Expenses</th>
                                    <th class="text-left">Total</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                                    $page_no = $_GET['page_no'];
                                } else {
                                    $page_no = 1;
                                }
                                $number_displayed_per_page = 20;
                                $total_records_per_page = $number_displayed_per_page;
                                $offset = ($page_no - 1) * $total_records_per_page;
                                $previous_page = $page_no - 1;
                                $next_page = $page_no + 1;
                                $adjacents = "2";

                                $result_count = mysqli_query($conn, "SELECT COUNT(DISTINCT carer_Name) As total_records FROM tbl_daily_shift_records 
                                WHERE ((shift_date >= '$txtStartDate' AND shift_date <= '$txtEndDate') AND (col_carer_Id = '$txtCareGiver' 
                                OR shift_status = '$txtCareGiver') AND col_visit_confirmation = 'Confirmed' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                $total_records = mysqli_fetch_array($result_count);
                                $total_records = $total_records['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                $second_last = $total_no_of_pages - 1; // total page minus 1

                                $result = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE ((shift_date >= '$txtStartDate' 
                                AND shift_date <= '$txtEndDate') AND (col_carer_Id = '$txtCareGiver' OR shift_status = '$txtCareGiver') 
                                AND col_visit_confirmation = 'Confirmed' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') 
                                GROUP BY carer_Name LIMIT $offset, $total_records_per_page ");
                                while ($row = mysqli_fetch_array($result)) {
                                    $carer_specialId = $row['col_carer_Id'];

                                    $sql_total_balance = mysqli_query($conn, "SELECT SUM(`col_carecall_rate`) AS total_payment FROM `tbl_daily_shift_records` 
                                    WHERE ((shift_date BETWEEN '$txtStartDate' AND '$txtEndDate') AND col_carer_Id = '$carer_specialId' 
                                    AND col_visit_confirmation = 'Confirmed' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                    $row_total_balance = mysqli_fetch_array($sql_total_balance, MYSQLI_ASSOC);
                                    $total_carerPayment = number_format((float)$row_total_balance['total_payment'], 2, '.', '');

                                    $sql_total_hour = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) 
                                    AS total_worked_hours FROM `tbl_daily_shift_records` WHERE ((shift_date BETWEEN '$txtStartDate' AND '$txtEndDate') 
                                    AND (col_carer_Id = '$carer_specialId') AND col_visit_confirmation = 'Confirmed' 
                                    AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                    $row_total_hour = mysqli_fetch_array($sql_total_hour, MYSQLI_ASSOC);
                                    $total_hours = $row_total_hour['total_worked_hours'];
                                    list($hours, $minutes, $seconds) = explode(':', $total_hours);
                                    $total_seconds = $hours * 3600 + $minutes * 60 + $seconds; // Outputs: 9045
                                    $hours = floor($total_seconds / 3600);
                                    $minutes = floor(($total_seconds % 3600) / 60);
                                    $seconds = $total_seconds % 60;
                                    $formatted_Carertime = sprintf('%02d:%02d', $hours, $minutes, $seconds);

                                    $sql_total_mileage = mysqli_query($conn, "SELECT SUM(`col_mileage`) AS total_mileage FROM `tbl_daily_shift_records` WHERE (col_carer_Id = '$carer_specialId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                    $row_total_mileage = mysqli_fetch_array($sql_total_mileage, MYSQLI_ASSOC);
                                    $total_carerMileage = number_format((float)$row_total_mileage['total_mileage'], 2, '.', '');
                                    $varTotalMiles = $total_carerMileage / 0.25;

                                    $varTotalAmount = $total_carerPayment + $total_carerMileage;

                                    echo "<tr>
                                    <td>" . $row['carer_Name'] . "</td>
                                    <td>£$total_carerPayment<br><span style='color:rgba(44, 62, 80,.9);'>$formatted_Carertime hours</span></td>
                                    <td>" . $row['planned_timeIn'] . " &rarr; " . $row['planned_timeOut'] . "</td>
                                    <td>£$total_carerMileage<br><span style='color:rgba(44, 62, 80,.9);'>$varTotalMiles Miles</span></td>
                                    <td>£0.00</td>
                                    <td>£" . $varTotalAmount . "</td>
                                    <td>
                                        <a href='./pay-run-brake-down?col_carer_Id=" . $row['col_carer_Id'] . "'>
                                            <button title='View pay dashboard visit brakedown' type='button' class='btn  btn-primary btn-sm'><i class='feather mr-2 icon-list'></i></button>
                                        </a>
                                    </td>
                                    </tr>";
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Caregiver</th>
                                    <th>Care delivery</th>
                                    <th>Planned</th>
                                    <th>Mileage</th>
                                    <th>Expenses</th>
                                    <th class="text-left">Total</th>
                                    <th>More</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <br>
                <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                    <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
                </div>

                <ul class="pagination">
                    <li <?php if ($page_no <= 1) {
                            echo "class='disabled'";
                        } ?>>
                        <a <?php if ($page_no > 1) {
                                echo "href='?page_no=$previous_page'";
                            } ?>>Previous</a>
                    </li>

                    <?php
                    if ($total_no_of_pages <= $number_displayed_per_page) {
                        for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a>$counter</a></li>";
                            } else {
                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                    } elseif ($total_no_of_pages > $number_displayed_per_page) {

                        if ($page_no <= 4) {
                            for ($counter = 1; $counter < 8; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='active'><a>$counter</a></li>";
                                } else {
                                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                            echo "<li><a>...</a></li>";
                            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                            echo "<li><a href='?page_no=1'>1</a></li>";
                            echo "<li><a href='?page_no=2'>2</a></li>";
                            echo "<li><a>...</a></li>";
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='active'><a>$counter</a></li>";
                                } else {
                                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                            echo "<li><a>...</a></li>";
                            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        } else {
                            echo "<li><a href='?page_no=1'>1</a></li>";
                            echo "<li><a href='?page_no=2'>2</a></li>";
                            echo "<li><a>...</a></li>";

                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='active'><a>$counter</a></li>";
                                } else {
                                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                        }
                    }
                    ?>

                    <li <?php if ($page_no >= $total_no_of_pages) {
                            echo "class='disabled'";
                        } ?>>
                        <a <?php if ($page_no < $total_no_of_pages) {
                                echo "href='?page_no=$next_page'";
                            } ?>>Next</a>
                    </li>
                    <?php if ($page_no < $total_no_of_pages) {
                        echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                    } ?>
                </ul>
            </div>
        </div>
        <div style="margin-top: 200px;"></div>
    </div>
</div>

<?php include('footer-contents.php'); ?>