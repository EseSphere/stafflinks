<?php include('header-contents.php'); ?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Invoices</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12 col-md-12">
                <div class="card table-card tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-1">
                    <div class="card-header">
                        <div style="width: 100%; height:auto; padding:2px; text-align:right;">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="./export-invoices" id="ExPINV" method="post" enctype="multipart/form-data" autocomplete="off"></form>
                                <button form="ExPINV" type="submit" name="action" value="export" class="btn btn-secondary btn-small">Export</button>
                                <button form="ExPINV" type="submit" name="action" value="delete" class="btn btn-danger btn-small" onclick="return confirm('Are you sure you want to delete selected data?');">Delete</button>
                            </div>
                        </div>
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
                                        <th><input type="checkbox" id="selectAllCheckbox"></th>
                                        <th>Invoice#</th>
                                        <th>Payer</th>
                                        <th>Period</th>
                                        <th>Care recipient</th>
                                        <th>Amount</th>
                                        <th>Hours</th>
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

                                    $result_count = mysqli_query($conn, "SELECT COUNT(DISTINCT col_client_Id) As total_records 
                                    FROM tbl_invoices WHERE (`col_company_Id` = '" . $_SESSION['usr_compId'] . "')");
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total page minus 1
                                    $result = mysqli_query($conn, "SELECT * FROM tbl_invoices WHERE (`col_company_Id` = '" . $_SESSION['usr_compId'] . "') 
                                    GROUP BY col_client_Id ORDER BY userId DESC LIMIT $offset, $total_records_per_page");
                                    while ($row = mysqli_fetch_array($result)) {
                                        $varPayer = $row['col_payer'];
                                        $varInvoiceId = $row['col_invoice_Id'];
                                        $varClientId = $row['col_client_Id'];
                                        $varClientName = $row['col_care_recipient'];
                                        $varInvoices = $row['userId'];
                                        $varCarerId = $row['col_carer_Id'];
                                        $varCarerStartDate = $row['col_invoice_start_date'];
                                        $varCarerEndDate = $row['col_invoice_end_date'];
                                        $varStartDate = date('d M', strtotime("" . $row['col_invoice_start_date'] . ""));
                                        $varEndDate = date('d M, Y', strtotime("" . $row['col_invoice_end_date'] . ""));

                                        $sql_total_balance = mysqli_query($conn, "SELECT SUM(`col_payer_rate`) AS total_payment FROM `tbl_invoices` 
                                        WHERE (col_invoice_start_date = '$varCarerStartDate' AND col_invoice_end_date = '$varCarerEndDate' 
                                        AND col_client_Id = '$varClientId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                        $row_total_balance = mysqli_fetch_array($sql_total_balance, MYSQLI_ASSOC);
                                        $total_clientPayment = number_format((float)$row_total_balance['total_payment'], 2, '.', '');

                                        $sql_total_hour = mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`col_time_out`, `col_time_in`)))) 
                                        AS total_worked_hours FROM `tbl_invoices` WHERE (col_invoice_start_date = '$varCarerStartDate' 
                                        AND col_invoice_end_date = '$varCarerEndDate' AND col_client_Id = '$varClientId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
                                        $row_total_hour = mysqli_fetch_array($sql_total_hour, MYSQLI_ASSOC);
                                        $total_hours = $row_total_hour['total_worked_hours'];
                                        list($hours, $minutes, $seconds) = explode(':', $total_hours);
                                        $total_seconds = $hours * 3600 + $minutes * 60 + $seconds; // Outputs: 9045
                                        $hours = floor($total_seconds / 3600);
                                        $minutes = floor(($total_seconds % 3600) / 60);
                                        $seconds = $total_seconds % 60;
                                        $formatted_Carertime = sprintf('%02d:%02d', $hours, $minutes, $seconds);
                                        echo "<tr>
                                        <td>
                                        <input type='checkbox' form='ExPINV' class='checkboxes' name='selected_ids[]' value='" . $varInvoices . "' />
                                        </td>
                                        <td>00" . $varInvoices . "</td>
                                        <td>" . $varPayer . "</td>
                                        <td>" . $varStartDate . " &rarr; " . $varEndDate . "</td>
                                        <td>" . $varClientName . "</td>
                                        <td>£" . $total_clientPayment . "</td>
                                        <td>" . $formatted_Carertime . "</td>
                                        <td>
                                            <form id='vinv' action='./invoice-details' method='POST' autocomplete='off' enctype='multipart/form-data'>
                                                <input name='txtStartDateY' value='" . $varCarerStartDate . "' hidden>
                                                <input name='txtEndDateX' value='" . $varCarerEndDate . "' hidden>
                                                <input name='txtClientId' value='" . $varClientId . "' hidden>
                                                <button title='Invoice details' name='btnGetInfo' type='submit' class='btn btn-primary btn-sm'><i class='feather mr-2 icon-list'></i></button>
                                            </form>
                                        </td>
                                    </tr>";
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Invoice#</th>
                                        <th>Payer</th>
                                        <th>Period</th>
                                        <th>Care recipient</th>
                                        <th>Amount</th>
                                        <th>Hours</th>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const storageKey = "selected_invoices";
        let selectedInvoices = JSON.parse(localStorage.getItem(storageKey)) || [];
        document.querySelectorAll(".checkboxes").forEach(checkbox => {
            if (selectedInvoices.includes(checkbox.value)) {
                checkbox.checked = true;
            }
            checkbox.addEventListener("change", function() {
                if (this.checked) {
                    if (!selectedInvoices.includes(this.value)) {
                        selectedInvoices.push(this.value);
                    }
                } else {
                    selectedInvoices = selectedInvoices.filter(id => id !== this.value);
                }
                localStorage.setItem(storageKey, JSON.stringify(selectedInvoices));
            });
        });

        const selectAllCheckbox = document.getElementById("selectAllCheckbox");
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener("change", function() {
                document.querySelectorAll(".checkboxes").forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                    if (checkbox.checked) {
                        if (!selectedInvoices.includes(checkbox.value)) {
                            selectedInvoices.push(checkbox.value);
                        }
                    } else {
                        selectedInvoices = selectedInvoices.filter(id => id !== checkbox.value);
                    }
                });
                localStorage.setItem(storageKey, JSON.stringify(selectedInvoices));
            });
        }
        const exportForm = document.querySelector("form#ExPINV");
        if (exportForm) {
            exportForm.addEventListener("submit", function() {
                document.getElementById("all_selected_ids").value = selectedInvoices.join(",");
            });
        }
    });
</script>


<?php include('footer-contents.php'); ?>