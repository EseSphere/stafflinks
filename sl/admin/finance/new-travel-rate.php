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
                                New travel rate <br>
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
                    <form action="./new-travel-rate" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Travel rate already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Travel pay rate name<span style="color: red;"> *</span></label>
                                    <input type="text" name="txtName" placeholder="Travel pay rate name" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hourly rate<span style="color: red;"> *</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">£</div>
                                        </div>
                                        <input type="text" class="form-control" name="txtHourlyRate" id="inlineFormInputGroupUsername" placeholder="11.44">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mileage rate<span style="color: red;"> *</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">£</div>
                                        </div>
                                        <input type="text" class="form-control" name="txtMileageRate" id="inlineFormInputGroupUsername" placeholder="0.25">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Break<span style="color: red;"> *</span></label>
                                <input type="number" name="txtBreak" placeholder="60 mins or more..." required class="form-control" id="exampleInputPassword1" />
                            </div>
                            <div class="col-md-12">
                                <br>
                                <label for="exampleInputPassword1">Pay waiting time<span style="color: red;"> *</span></label>
                                <select name="txtPayWaitingTime" required class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />
                            <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">
                            <div class="form-group">
                                <input type="submit" name="btnAddNewTravelRate" class="btn btn-small btn-info" value="Save data" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-xl-8 col-md-8">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Travel rates</h5>
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
                                        <th>Name</th>
                                        <th>Hourly rate</th>
                                        <th>Mileage rate</th>
                                        <th>Break</th>
                                        <th>Pay waiting time</th>
                                        <th>Last updated</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_travel_rate WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                        echo "
                                                    <tr>
                                                        <td>" . $getholdof_rows['col_name'] . "</td>
                                                        <td>" . $getholdof_rows['col_hourly_rate'] . "</td>
                                                        <td>" . $getholdof_rows['col_mileage_rate'] . "</td>
                                                        <td>" . $getholdof_rows['col_break'] . "</td>
                                                        <td>" . $getholdof_rows['col_pay_waiting_time'] . "</td>
                                                        <td>" . $getholdof_rows['col_date'] . "</td>
                                                        <td>
                                                            <a href='./edit-travel-rate?col_special_Id=" . $getholdof_rows['col_special_Id'] . "'>
                                                                <button title='View client task' type='button' class='btn  btn-primary btn-sm'><i class='feather mr-2 icon-edit'></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                
                                                ";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th>Name</th>
                                    <th>Hourly rate</th>
                                    <th>Mileage rate</th>
                                    <th>Break</th>
                                    <th>Pay waiting time</th>
                                    <th>Last updated</th>
                                    <th>Edit</th>
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