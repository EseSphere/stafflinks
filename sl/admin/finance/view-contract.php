<?php
include('header-contents.php');
if (isset($_GET['col_special_Id'])) {
    $varPayerId = $_GET['col_special_Id'];
}
?>

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
                                View Contract<br>
                                <small>Payer contracts</small>
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
            <!-- prject ,team member start -->
            <div class="col-xl-4 col-md-4">
                <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <form action="./view-contract" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Contract already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="background-color: rgba(189, 195, 199,.4); border-radius:5px; font-weight:600; font-size:16px; width:100%; height:auto; padding:12px;">
                                    Add new contract
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Name<span style="color: red;"> *</span></label>
                                    <input type="text" name="txtone" placeholder="Name" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Payer<span style="color: red;"> *</span>
                                        <a href="./new-payer" style="text-decoration: none;">
                                            <button style="font-size: 10px;" type="button" class="btn btn-xs btn-secondary">Add Payer</button>
                                        </a></label>
                                    <select name="txttwo" class="form-control" id="exampleFormControlSelect1">
                                        <?php
                                        $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_payer WHERE (col_special_Id = '$varPayerId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')");
                                        $getholdof_rows = mysqli_fetch_array($SelectQuery, MYSQLI_ASSOC);
                                        echo "<option selected='selected' value='" . $getholdof_rows['col_special_Id'] . "'>" . $getholdof_rows['col_name'] . "</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Service type(s)<span style="color: red;"> *</span></label>
                                    <select name="txtthree" class="form-control" id="exampleFormControlSelect1">
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
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Rate card<span style="color: red;"> *</span></label>
                                <select name="txtfour" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <?php
                                    $getCareRecipient = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                    while ($fetchData = mysqli_fetch_array($getCareRecipient)) {
                                        echo "
                                            <option value='" . $fetchData['col_rates'] . "'>" . $fetchData['col_name'] . "</option>
                                        ";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <label for="exampleInputPassword1">Invoice format<span style="color: red;"> *</span></label>
                                <select name="txtfive" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Standard">Standard</option>
                                    <option value="NHS">NHS</option>
                                    <option value="Local authority">Local authority</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <label for="exampleInputPassword1">Invoice group<span style="color: red;"></span></label>
                                <select name="txtsix" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <?php
                                    $getCareRecipient = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                    while ($fetchData = mysqli_fetch_array($getCareRecipient)) {
                                        echo "
                                            <option value='" . $fetchData['col_name'] . "'>" . $fetchData['col_name'] . "</option>
                                        ";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>

                        <input type="hidden" value="<?php echo $varPayerId; ?>" name="mySpecialId" />
                        <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />
                        <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">
                        <div class="form-group">
                            <input style="float: right;" type="submit" name="btnAddNewContractData" class="btn btn-small btn-info" value="Save data" />
                        </div>
                    </form>
                </div>
            </div>



            <div class="col-xl-8 col-md-8">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Contract</h5>
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
                                        <th>Payer</th>
                                        <th>Service type</th>
                                        <th>Format</th>
                                        <th>Group</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_contract WHERE (col_payer_Id = '$varPayerId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {
                                        echo "
                                                    <tr>
                                                        <td>" . $getholdof_rows['col_name'] . "</td>
                                                        <td>" . $getholdof_rows['col_payer'] . "</td>
                                                        <td>" . $getholdof_rows['col_service_type'] . "</td>
                                                        <td>" . $getholdof_rows['col_invoice_format'] . "</td>
                                                        <td>" . $getholdof_rows['col_invoice_group'] . "</td>
                                                    </tr>
                                                
                                                ";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Payer</th>
                                        <th>Service type</th>
                                        <th>Format</th>
                                        <th>Group</th>
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
    <!-- Latest Customers end -->
</div>


<?php include('footer-contents.php'); ?>