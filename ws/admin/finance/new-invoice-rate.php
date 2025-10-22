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
                            <h4 class="m-b-10">
                                New Invoice Rate<br>
                                <small>card details</small>
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
            <div class="col-xl-4 col-md-4">
                <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <form action="./new-invoice-rate" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Invoice rate already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Rate name<span style="color: red;"> *</span></label>
                                    <input type="text" name="txtone" placeholder="Rate name" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Day type<span style="color: red;"> *</span></label>
                                    <select name="txttwo" required class="form-control" id="exampleFormControlSelect1">
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
                                    <select name="txtthree" required class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected="selected" disabled="disabled">Select...</option>
                                        <option value="Always">Always</option>
                                        <option value="Time of day">Time of day</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Rate type<span style="color: red;"> *</span></label>
                                <select name="txtfour" required class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Single">Single</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Banded">Banded</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <label for="exampleInputPassword1">Hourly rate<span style="color: red;"> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                    </div>
                                    <input type="text" required class="form-control" name="txtfive" id="inlineFormInputGroupUsername" placeholder="Hourly rate">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <label for="exampleInputPassword1">Select service type<span style="color: red;"></span></label>
                                <select name="txtsix" required class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                    <option value="Nursing care">Nursing care</option>
                                    <option value="Dementia">Dementia</option>
                                    <option value="Palliative care">Palliative care</option>
                                    <option value="Assisted living">Assisted living</option>
                                    <option value="Companionship care">Companionship care</option>
                                    <option value="Mental health">Mental health</option>
                                    <option value="Disability care">Disability care</option>
                                    <option value="Domiciliary care">Domiciliary care</option>
                                    <option value="Informal">Informal</option>
                                    <option value="Health care">Health care</option>
                                    <option value="Residential care">Residential care</option>
                                    <option value="Personal care">Personal care</option>
                                    <option value="Child care">Child care</option>
                                    <option value="Retirement villages">Retirement villages</option>
                                    <option value="Dentist appointments">Dentist appointments</option>
                                    <option value="Find help when you need it">Find help when you need it</option>
                                    <option value="Nursing">Nursing</option>
                                    <option value="Medical social Services">Medical social Services</option>
                                    <option value="Shared Lives">Shared Lives</option>
                                    <option value="Community Health">Community Health</option>
                                    <option value="Overnight care">Overnight care</option>
                                    <option value="Convalescence care">Convalescence care</option>
                                    <option value="Home care">Home care</option>
                                    <option value="Respite care">Respite care</option>
                                    <option value="Sit-in Care">Sit-in Care</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div style="margin: 20px auto; border-bottom: 1px solid rgba(189, 195, 199,.5); padding:15px;">
                                <h5>Add new fee</h5>
                                Repeats every time a visit happens for as long as the client is active
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Fee name<span style="color: red;"></span></label>
                                    <input type="text" value="NON" name="txtseven" placeholder="e.g Visit fee" class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Fee rate<span style="color: red;"></span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                    </div>
                                    <input type="text" value="0.00" class="form-control" name="txteight" id="inlineFormInputGroupUsername" placeholder="11.44">
                                </div>
                            </div>
                        </div>
                        <br>

                        <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />
                        <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">
                        <div class="form-group">
                            <input style="float: right;" type="submit" name="btnAddNewInvoiceData" class="btn btn-small btn-info" value="Save data" />
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-xl-8 col-md-8">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Invoice rates</h5>
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
                                        <th>Rate Name</th>
                                        <th>Day(s)</th>
                                        <th>Applies</th>
                                        <th>Type</th>
                                        <th>Bands</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
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
    <!-- Latest Customers end -->
</div>
<!-- [ Main Content ] end -->

<?php include('footer-contents.php'); ?>