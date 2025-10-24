<?php include('header-contents.php'); ?>
<?php include('processing-new-pay-rate.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">
                                New Pay rate <br>
                                <small>card details</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-4 col-md-4">
                <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <form action="./new-pay-rates" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Rate type already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Rate name<span style="color: red;"> *</span></label>
                                    <input type="text" name="txtName" placeholder="Rate name" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Day type<span style="color: red;"> *</span></label>
                                    <select name="txtdayType" class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected="selected" disabled="disabled">Select...</option>
                                        <option value="All">All</option>
                                        <option value="Weekday">Weekday</option>
                                        <option value="Weekend">Weekend</option>
                                        <option value="Holiday">Holiday</option>
                                        <option value="Custom...">Custom...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">When will this apply?<span style="color: red;"> *</span></label>
                                    <select name="txtWWTA" class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected="selected" disabled="disabled">Select...</option>
                                        <option value="Always">Always</option>
                                        <option value="Time of day">Time of day</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Rate type<span style="color: red;"> *</span></label>
                                <select name="txtRateType" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Single">Single</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Banded">Banded</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Hourly rate<span style="color: red;"> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                    </div>
                                    <input type="text" class="form-control" name="txtHourlyRate" id="inlineFormInputGroupUsername" placeholder="Hourly rate">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Select service type<span style="color: red;"></span></label>
                                <select name="txtSelectservicetype" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Personal Care">Personal Care</option>
                                    <option value="Complex Care">Complex Care</option>
                                    <option value="Companionship">Companionship</option>
                                    <option value="Sleeping Night">Sleeping Night</option>
                                    <option value="Waking Night">Waking Night</option>
                                    <option value="Live-in Care">Live-in Care</option>
                                    <option value="Supported Living">Supported Living</option>
                                    <option value="Home Help">Home Help</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />
                            <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">
                            <div class="form-group mt-3">
                                <input type="submit" name="btnAddData" class="btn btn-small btn-info" value="Save data" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-8 col-md-8">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Default visit rates</h5>
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
                                        <th>Rate name</th>
                                        <th>Day(s)</th>
                                        <th>Applies</th>
                                        <th>Type</th>
                                        <th>Bands</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_pay_rate WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                        echo "
                                                <tr>
                                                    <td>" . $getholdof_rows['col_name'] . "</td>
                                                    <td>" . $getholdof_rows['col_days'] . "</td>
                                                    <td>" . $getholdof_rows['col_applies'] . "</td>
                                                    <td>" . $getholdof_rows['col_type'] . "</td>
                                                    <td>Minute</td>
                                                    <td>£" . $getholdof_rows['col_rates'] . "</td>
                                                </tr>
                                                ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 200px;"></div>
    </div>
</div>

<?php include('footer-contents.php'); ?>