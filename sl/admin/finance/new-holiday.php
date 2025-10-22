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
                                Holiday<br>
                                <small>Holiday day rate</small>
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
                    <form action="./new-holiday" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Holiday already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description<span style="color: red;"> *</span></label>
                                    <select name="txtone" required class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected="selected" disabled="disabled">Select...</option>
                                        <option value="Good Friday">Good Friday</option>
                                        <option value="Chrismas Day">Chrismas Day</option>
                                        <option value="Boxing Day">Boxing Day</option>
                                        <option value="New Year's Day">New Year's Day</option>
                                        <option value="Mother's Day">Mother's Day</option>
                                        <option value="Father's Day">Father's Day</option>
                                        <option value="Teacher's Day">Teacher's Day</option>
                                        <option value="Worker's Day">Worker's Day</option>
                                        <option value="Early May Bank Holiday">Early May Bank Holiday</option>
                                        <option value="Spring Bank Holiday">Spring Bank Holiday</option>
                                        <option value="Summer Bank Holiday">Summer Bank Holiday</option>
                                        <option value="Easter Day">Easter Day</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date<span style="color: red;"> *</span></label>
                                    <input type="date" name="txttwo" placeholder="Rate name" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Pay multiplier<span style="color: red;"> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                    </div>
                                    <input type="tel" class="form-control" name="txtthree" id="inlineFormInputGroupUsername" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <label for="exampleInputPassword1">Charge multiplier<span style="color: red;"> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                    </div>
                                    <input type="tel" class="form-control" name="txtfour" id="inlineFormInputGroupUsername" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />
                            <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">
                            <div class="form-group">
                                <input type="submit" name="btnAddNewHolidayData" class="btn btn-small btn-info" value="Save data" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-xl-8 col-md-8">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Holiday calendar</h5>
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
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Pay multiplier</th>
                                        <th>Charge multiplier</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_holiday WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                        echo "
                                                <tr>
                                                    <td>" . $getholdof_rows['col_description'] . "</td>
                                                    <td>" . $getholdof_rows['col_holiday_date'] . "</td>
                                                    <td>" . $getholdof_rows['col_pay_multiplier'] . "</td>
                                                    <td>£" . $getholdof_rows['col_charge_multiplier'] . "</td>
                                                    <td><a href='./edit-holiday?col_special_Id=" . $getholdof_rows['col_special_Id'] . "'>
                                                        <button title='View client task' type='button' class='btn  btn-primary btn-sm'><i class='feather mr-2 icon-edit'></i></button>
                                                    </a></td>
                                                </tr>
                                            
                                                ";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Pay multiplier</th>
                                        <th>Charge multiplier</th>
                                        <th>Edit</th>
                                    </tr>
                                </tfoot>
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