<?php include('header-contents.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Confirm visits</h4>
                            <p>Review, confirm or update visits before they're added to timesheets and/or invoices</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div style="padding: 0;" class="col-md-3">
                <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <form action="./set-dashboard-cookie" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Period Start<span style="color: red;"> *</span></label>
                                    <input type="date" value="<?php print $txtStartDate; ?>" name="txtPeriodStart" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Period End<span style="color: red;"> *</span></label>
                                    <input type="date" name='txtCVPeriodEnd' onchange='this.form.submit()' value="<?php print $txtEndDate; ?>" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Care recipient<span style="color: red;"></span></label>
                                    <select name="txtCareRecipient" class="form-control" id="exampleFormControlSelect1">
                                        <option value='<?php print $txtCareRecipient; ?>' selected='selected'>Select...</option>
                                        <option value='Checked in'>All</option>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM tbl_daily_shift_records WHERE shift_date BETWEEN ? AND ? AND col_company_id = ? GROUP BY client_name ASC");
                                        $stmt->bind_param("sss", $txtStartDate, $txtEndDate, $_SESSION['usr_compId']);
                                        $stmt->execute();
                                        $getCareRecipient = $stmt->get_result();
                                        while ($fetchData = $getCareRecipient->fetch_array()) {

                                            echo "
                                            <option value='" . $fetchData['uryyToeSS4'] . "'>" . $fetchData['client_name'] . "</option>
                                        ";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Caregiver<span style="color: red;"></span></label>
                                <select name="txtCareGiver" class="form-control" id="exampleFormControlSelect1">
                                    <option value="<?php print $txtCareGiver; ?>" selected="selected" disabled="disabled">Select...</option>
                                    <option value='Checked in'>All</option>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_daily_shift_records WHERE shift_date >= ? 
                                    AND shift_date <= ? AND col_company_id = ? GROUP BY carer_Name ASC");
                                    $stmt->bind_param("ssi", $txtStartDate, $txtEndDate, $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $getCareRecipient = $stmt->get_result();
                                    while ($fetchData = $getCareRecipient->fetch_array()) {
                                        echo "
                                            <option value='" . $fetchData['col_carer_Id'] . "'>" . $fetchData['carer_Name'] . "</option>
                                        ";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="txtCompanyId" value="<?php print $_SESSION['usr_compId']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="btnFetchConfirmVisitData" class="btn btn-small btn-info" value="Fetch data" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-9">
                <?php include_once('fetch-visits-statistics.php'); ?>
                <form action="./processing-confirm-visits" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2 col-xl-2"></div>
                            <div class="col-md-2 col-xl-2"></div>
                            <div class="col-md-2 col-xl-2"></div>
                            <div class="col-md-2 col-xl-2"></div>
                            <div style="padding: 0;" class="col-md-2 col-xl-2">
                                <div style="width: 100%; height:auto; padding:2px; text-align:right;">
                                    <!--<button style="width: 100px;" class="btn btn-secondary btn-small"></button>-->
                                </div>
                            </div>
                            <div style="padding: 0;" class="col-md-2 col-xl-2">
                                <div style="width: 100%; height:auto; padding:2px; text-align:right;">
                                    <button type="submit" name="btnCreatePayRun" style="width: 130px;" class="btn btn-info btn-small">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllCheckbox"></th>
                                        <th>Date</th>
                                        <th>Carer name</th>
                                        <th>Planned time</th>
                                        <th style="color:rgba(192, 57, 43,1.0);">Actual time</th>
                                        <th>Paid time</th>
                                        <th class="text-left">Invoiced time</th>
                                        <th>Tags</th>
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
                                    WHERE ((shift_date >= '$txtStartDate' AND shift_date <= '$txtEndDate') AND (uryyToeSS4 = '$txtCareRecipient' 
                                    OR shift_status = 'Checked in') AND (col_carer_Id = '$txtCareGiver' OR shift_status = 'Checked in') 
                                    AND col_visit_confirmation = 'Unconfirmed' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total page minus 1

                                    $result = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE ((shift_date >= '$txtStartDate' 
                                    AND shift_date <= '$txtEndDate') AND (uryyToeSS4 = '$txtCareRecipient' OR shift_status = 'Checked in') 
                                    AND (col_carer_Id = '$txtCareGiver' OR shift_status = 'Checked in') AND col_visit_confirmation = 'Unconfirmed' 
                                    AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') GROUP BY carer_Name LIMIT $offset, $total_records_per_page");
                                    while ($row = mysqli_fetch_array($result)) {
                                        $varCarerId = $row['col_carer_Id'];
                                        echo "<tr>
                                    <td>
                                    <input type='checkbox' class='checkboxes' name='txtConfirmId[]' value='" . $varCarerId . "' />
                                    <input type='hidden' name='txtCompanyId' value='" . $_SESSION['usr_compId'] . "'>
                                    <input type='hidden' name='txtPeriodStart_$varCarerId' value='$txtStartDate'>
                                    <input type='hidden' name='txtPeriodEnd_$varCarerId' value='$txtEndDate'>
                                    <input type='hidden' name='txtCareGiver_$varCarerId' value='$txtCareGiver'>
                                    </td>
                                    <td>" . $row['shift_date'] . "</td>
                                    <td>" . $row['carer_Name'] . "</td>
                                    <td>" . $row['planned_timeIn'] . "  &rarr; " . $row['planned_timeOut'] . "</td>
                                    <td style='color:rgba(192, 57, 43,1.0);'>" . $row['shift_end_time'] . "  &rarr; " . $row['shift_start_time'] . "</td>
                                    <td>" . $row['planned_timeIn'] . "  &rarr; " . $row['planned_timeOut'] . "</td>
                                    <td>" . $row['planned_timeIn'] . "  &rarr; " . $row['planned_timeOut'] . "</td>
                                    <td> -- </td>
                                    </tr>";
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
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
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>