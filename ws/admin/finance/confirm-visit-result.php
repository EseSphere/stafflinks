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
                            <h4 class="m-b-10">Confirm visits
                                <br>
                                <small>
                                    Review, confirm or update visits before they're added to timesheets and/or invoices
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
                    <form action="./confirm-visit-result" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
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
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Care recipient<span style="color: red;"></span></label>
                                    <select name="txtCareRecipient" class="form-control" id="exampleFormControlSelect1">
                                        <option value='' selected='selected' disabled='disabled'>Select...</option>
                                        <?php
                                        $getCareRecipient = mysqli_query($conn, "SELECT * FROM tbl_general_client_form");
                                        while ($fetchData = mysqli_fetch_array($getCareRecipient)) {
                                            echo "
                                            <option value='" . $fetchData['client_first_name'] . " " . $fetchData['client_last_name'] . "'>" . $fetchData['client_first_name'] . " " . $fetchData['client_last_name'] . "</option>
                                        ";
                                        }
                                        ?>
                                        <option value='Null'>Select all</option>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="col-md-4">
                                <label for="exampleInputPassword1">Caregiver<span style="color: red;"></span></label>
                                <select name="txtCareGiver" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Null">Select all</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Visit completed<span style="color: red;"></span></label>
                                <select name="txtVisitCompleted" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Null">No options</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Timings edited<span style="color: red;"></span></label>
                                <select name="txtTimingEdited" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Null">No options</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Discrepancy<span style="color: red;"></span></label>
                                <select name="txtDiscrepancy" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Null">No options</option>
                                </select>
                            </div>-->
                        </div>
                        <div class="form-group">
                            <input style="float: right;" type="submit" name="btnFetchData" class="btn btn-small btn-info" value="Fetch data" />
                        </div>
                    </form>
                </div>
                <br>
                <hr>

                <br>

                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a style="color:#000;" class="nav-link active" id="justified-tab-0" data-bs-toggle="tab" href="#justified-tabpanel-0" role="tab" aria-controls="justified-tabpanel-0" aria-selected="true"><strong>Schedule</strong></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a style="color:#000;" class="nav-link" id="justified-tab-1" data-bs-toggle="tab" href="#justified-tabpanel-1" role="tab" aria-controls="justified-tabpanel-1" aria-selected="false"><strong>Unschedule</strong></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a style="color:#000;" class="nav-link" id="justified-tab-2" data-bs-toggle="tab" href="#justified-tabpanel-2" role="tab" aria-controls="justified-tabpanel-2" aria-selected="false"><strong>Discarded from payroll</strong></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a style="color:#000;" class="nav-link" id="justified-tab-3" data-bs-toggle="tab" href="#justified-tabpanel-3" role="tab" aria-controls="justified-tabpanel-3" aria-selected="false"><strong>Discarded from invoicing</strong></a>
                    </li>
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="card table-card tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-1">
                        <div class="card-header">
                            <h5>Schedule</h5>
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
                                            <th>Carer name</th>
                                            <th>Planned time</th>
                                            <th>Actual time</th>
                                            <th>Paid time</th>
                                            <th class="text-left">Invoiced time</th>
                                            <th>Tags</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['btnFetchData'])) {
                                            $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
                                            $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
                                            $txtCareRecipient = mysqli_real_escape_string($conn, $_POST['txtCareRecipient']);

                                            $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE timesheet_date = '$txtPeriodStart' AND timesheet_date = '$txtPeriodEnd' AND client_name = '$txtCareRecipient'");
                                            while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                                echo "
                                                <tr>
                                                    <td>" . $getholdof_rows['shift_date'] . "</td>
                                                    <td>" . $getholdof_rows['client_name'] . " <br> " . $getholdof_rows['carer_Name'] . "</td>
                                                    <td>" . $getholdof_rows['planned_timeIn'] . " - " . $getholdof_rows['planned_timeOut'] . "</td>
                                                    <td>" . $getholdof_rows['shift_start_time'] . " - " . $getholdof_rows['shift_end_time'] . "</td>
                                                    <td>" . $getholdof_rows['planned_timeIn'] . " - " . $getholdof_rows['planned_timeOut'] . "</td>
                                                    <td>" . $getholdof_rows['planned_timeIn'] . " - " . $getholdof_rows['planned_timeOut'] . "</td>
                                                    <td>--</td>
                                                </tr>
                                            
                                                ";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="card tab-pane" id="justified-tabpanel-1" role="tabpanel" aria-labelledby="justified-tab-1">
                        <div class="card-header">
                            <h5>Unschedule</h5>
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
                                            <th>Carer name</th>
                                            <th>Actual time</th>
                                            <th>Paid time</th>
                                            <th class="text-left">Invoiced time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['btnFetchData'])) {
                                            $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
                                            $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
                                            $txtCareRecipient = mysqli_real_escape_string($conn, $_POST['txtCareRecipient']);

                                            $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE timesheet_date = '$txtPeriodStart' AND timesheet_date = '$txtPeriodEnd' AND client_name = '$txtCareRecipient'");
                                            while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                                echo "
                                                <tr>
                                                    <td>" . $getholdof_rows['shift_date'] . "</td>
                                                    <td>" . $getholdof_rows['client_name'] . " <br> " . $getholdof_rows['carer_Name'] . "</td>
                                                    <td>" . $getholdof_rows['shift_start_time'] . " - " . $getholdof_rows['shift_end_time'] . "</td>
                                                    <td>" . $getholdof_rows['shift_start_time'] . " - " . $getholdof_rows['shift_end_time'] . "</td>
                                                    <td>N/A</td>
                                                </tr>
                                            
                                                ";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="card tab-pane" id="justified-tabpanel-2" role="tabpanel" aria-labelledby="justified-tab-2">
                        <div class="card-header">
                            <h5>Discarded from payroll</h5>
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
                                            <th>Carer name</th>
                                            <th>Planned time</th>
                                            <th>Actual time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['btnFetchData'])) {
                                            $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
                                            $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
                                            $txtCareRecipient = mysqli_real_escape_string($conn, $_POST['txtCareRecipient']);

                                            $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE timesheet_date = '$txtPeriodStart' AND timesheet_date = '$txtPeriodEnd' AND client_name = '$txtCareRecipient'");
                                            while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                                echo "
                                                <tr>
                                                    <td>" . $getholdof_rows['shift_date'] . "</td>
                                                    <td>" . $getholdof_rows['client_name'] . " <br> " . $getholdof_rows['carer_Name'] . "</td>
                                                    <td>" . $getholdof_rows['planned_timeIn'] . " - " . $getholdof_rows['planned_timeOut'] . "</td>
                                                    <td>N/A</td>
                                                </tr>
                                            
                                                ";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                        <div class="card-header">
                            <h5>Discarded from invoicing</h5>
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
                                            <th>Carer name</th>
                                            <th>Planned time</th>
                                            <th>Actual time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['btnFetchData'])) {
                                            $txtPeriodStart = mysqli_real_escape_string($conn, $_POST['txtPeriodStart']);
                                            $txtPeriodEnd = mysqli_real_escape_string($conn, $_POST['txtPeriodEnd']);
                                            $txtCareRecipient = mysqli_real_escape_string($conn, $_POST['txtCareRecipient']);

                                            $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE timesheet_date = '$txtPeriodStart' AND timesheet_date = '$txtPeriodEnd' AND client_name = '$txtCareRecipient'");
                                            while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                                echo "
                                                <tr>
                                                    <td>" . $getholdof_rows['shift_date'] . "</td>
                                                    <td>" . $getholdof_rows['client_name'] . " <br> " . $getholdof_rows['carer_Name'] . "</td>
                                                    <td>" . $getholdof_rows['planned_timeIn'] . " - " . $getholdof_rows['planned_timeOut'] . "</td>
                                                    <td>" . $getholdof_rows['shift_start_time'] . " - " . $getholdof_rows['shift_end_time'] . "</td>
                                                </tr>
                                            
                                                ";
                                            }
                                        }
                                        ?>
                                    </tbody>
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