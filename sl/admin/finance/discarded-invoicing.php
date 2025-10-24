<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Discarded from invoicing
                                <br>
                                <small>
                                    Review, discarded payroll.
                                </small>
                            </h4>
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
                                    <input type="date" value="<?php print $txtEndDate; ?>" name="txtPeriodEnd" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Care recipient<span style="color: red;"></span></label>
                                    <select name="txtCareRecipient" class="form-control" id="exampleFormControlSelect1">
                                        <option value='' selected='selected' disabled='disabled'>Select...</option>
                                        <?php
                                        $getCareRecipient = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE (col_company_id = '" . $_SESSION['usr_compId'] . "') ORDER BY client_first_name ASC");
                                        while ($fetchData = mysqli_fetch_array($getCareRecipient)) {
                                            echo "
                                            <option value='" . $fetchData['uryyToeSS4'] . "'>" . $fetchData['client_first_name'] . " " . $fetchData['client_last_name'] . "</option>
                                        ";
                                        }
                                        ?>
                                        <option value='Checked in'>All</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Caregiver<span style="color: red;"></span></label>
                                <select name="txtCareGiver" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <?php
                                    $getCareRecipient = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE (col_company_id = '" . $_SESSION['usr_compId'] . "') ORDER BY team_first_name ASC");
                                    while ($fetchData = mysqli_fetch_array($getCareRecipient)) {
                                        echo "
                                            <option value='" . $fetchData['uryyTteamoeSS4'] . "'>" . $fetchData['team_first_name'] . " " . $fetchData['team_last_name'] . "</option>
                                        ";
                                    }
                                    ?>
                                    <option value='Checked in'>All</option>
                                </select>
                                <input type="hidden" name="txtCompanyId" value="<?php print $_SESSION['usr_compId']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="btnFetchDiscardedInvoiceData" class="btn btn-small btn-info" value="Fetch data" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-9">
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
                                    <th>Date</th>
                                    <th>Names</th>
                                    <th>Planned time</th>
                                    <th>Actual time</th>
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

                                $result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM tbl_schedule_calls WHERE ((Clientshift_Date >= '$txtStartDate') AND (Clientshift_Date <= '$txtEndDate') AND (uryyToeSS4 = '$txtCareRecipient') AND (first_carer_Id = '$txtCareGiver') AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                $total_records = mysqli_fetch_array($result_count);
                                $total_records = $total_records['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                $second_last = $total_no_of_pages - 1; // total page minus 1
                                $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE ((Clientshift_Date >= '$txtStartDate') AND (Clientshift_Date <= '$txtEndDate') AND (uryyToeSS4 = '$txtCareRecipient') AND (first_carer_Id = '$txtCareGiver') AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') GROUP BY client_name LIMIT $offset, $total_records_per_page");
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>
                                    <td>" . $row['Clientshift_Date'] . "</td>
                                    <td>" . $row['client_name'] . "</td>
                                    <td>" . $row['dateTime_in'] . "  &rarr; " . $row['dateTime_out'] . "</td>
                                    <td> N/A </td>
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
            </div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>