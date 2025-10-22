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
                            <h4 class="m-b-10">Pay runs</h4>
                            <p>Pay runs 24 Mar - 23 Apr 2024</p>
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
                                        <th>Period</th>
                                        <th>Care delivery</th>
                                        <th>Planned</th>
                                        <th>Mileage</th>
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

                                    $result_count = mysqli_query($conn, "SELECT COUNT(DISTINCT col_start_date) As total_records FROM tbl_pay_run WHERE (`col_company_Id` = '" . $_SESSION['usr_compId'] . "')");
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total page minus 1

                                    $result = mysqli_query($conn, "SELECT * FROM tbl_pay_run WHERE (`col_company_Id` = '" . $_SESSION['usr_compId'] . "') GROUP BY col_start_date LIMIT $offset, $total_records_per_page");
                                    while ($row = mysqli_fetch_array($result)) {
                                        $varPayrunId = $row['col_pay_runId'];
                                        $total_carer_Id = $row['col_carer_Id'];
                                        $varStartDate = date('d M', strtotime("" . $row['col_start_date'] . ""));
                                        $varEndDate = date('d M, Y', strtotime("" . $row['col_end_date'] . ""));

                                        $sql_total_balance = mysqli_query($conn, "SELECT SUM(`col_work_rate`) AS total_payment FROM `tbl_pay_run` 
                                        WHERE (col_pay_runId = '$varPayrunId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                        $row_total_balance = mysqli_fetch_array($sql_total_balance, MYSQLI_ASSOC);
                                        $total_carerPayment = number_format((float)$row_total_balance['total_payment'], 2, '.', '');

                                        $sql_total_hour = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`col_Time_Out`, `col_Time_In`)))) 
                                        AS total_worked_hours FROM `tbl_pay_run` WHERE (col_pay_runId = '$varPayrunId' 
                                        AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
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
                                        // Split the time into hours, minutes, and seconds

                                        $sql_total_mileage = mysqli_query($conn, "SELECT SUM(`col_mileage_rate`) AS total_mileage FROM `tbl_pay_run` WHERE (col_pay_runId = '$varPayrunId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                        $row_total_mileage = mysqli_fetch_array($sql_total_mileage, MYSQLI_ASSOC);
                                        $total_carerMileage = number_format((float)$row_total_mileage['total_mileage'], 2, '.', '');
                                        $varTotalMiles = $total_carerMileage / 0.25;
                                        echo "<tr>
                                        <td>" . $varStartDate . "  &rarr; " . $varEndDate . "</td>
                                        <td>£$total_carerPayment<br><span style='color:rgba(44, 62, 80,.9);'>$formatted_Carertime hours</span></td>
                                        <td>" . $row['col_Time_In'] . " &rarr; " . $row['col_Time_Out'] . "</td>
                                        <td>£$total_carerMileage<br><span style='color:rgba(44, 62, 80,.9);'>$varTotalMiles Miles</span></td>
                                        <td>
                                        <a href='./pay-run-details?col_pay_runId=" . $varPayrunId . "'> 
                                            <button title='View more details' type='button' class='btn  btn-primary btn-sm'><i class='feather mr-2 icon-list'></i></button> 
                                        </a>
                                    </td>
                                    </tr>";
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Period</th>
                                        <th>Care delivery</th>
                                        <th>Planned</th>
                                        <th>Mileage</th>
                                        <th>More</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-xl-6">
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
                        <div class="col-md-6 col-xl-6"></div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>


<?php include('footer-contents.php'); ?>