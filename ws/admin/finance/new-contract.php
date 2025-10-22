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
                            <h4 class="m-b-10">
                                New Contract<br>
                                <small>Form details</small>
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
                    <form action="./new-contract" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Contract already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Name<span style="color: red;"> *</span></label>
                                    <input type="text" name="txtone" placeholder="Name" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Payer<span style="color: red;"> *</span>
                                        <a href="./new-payer" style="text-decoration: none;">
                                            <button style="font-size: 10px;" type="button" class="btn btn-xs btn-secondary">Add Payer</button>
                                        </a></label>
                                    <select name="txttwo" class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected="selected" disabled="disabled">Select...</option>
                                        <?php
                                        $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_payer WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                        while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {
                                            echo "<option value='" . $getholdof_rows['col_name'] . "'>" . $getholdof_rows['col_name'] . "</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Service type(s)<span style="color: red;"> *</span></label>
                                    <select name="txtthree" class="form-control" id="exampleFormControlSelect1">
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
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Invoice format<span style="color: red;"> *</span></label>
                                <select name="txtfive" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Standard">Standard</option>
                                    <option value="NHS">NHS</option>
                                    <option value="Local authority">Local authority</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Invoice group<span style="color: red;"></span></label>
                                <select name="txtsix" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Null">No options</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <?php
                        require_once('dbconnections.php');

                        for ($a = 1; $a <= 50; $a++) {
                            $usdd = "0";
                            $rand1 = rand(0000, 9999);
                            $rand2 = rand(0000, 9999);
                            $rand3 = rand(0000, 9999);
                            $ud = "45";
                            $id = "$usdd$rand1$rand2$rand3$ud";
                        }

                        ?> <input type="hidden" value="<?php echo $id; ?>" name="mySpecialId" />

                        <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />

                        <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">

                        <div class="form-group">
                            <input style="float: right;" type="submit" name="btnAddNewContractData" class="btn btn-small btn-info" value="Save data" />
                        </div>
                    </form>
                </div>
                <br>
                <hr>



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
                                        <th>Invoice format</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_contract WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {

                                        echo "
                                                    <tr>
                                                        <td>" . $getholdof_rows['col_name'] . "</td>
                                                        <td>" . $getholdof_rows['col_payer'] . "</td>
                                                        <td>" . $getholdof_rows['col_service_type'] . "</td>
                                                        <td>" . $getholdof_rows['col_invoice_format'] . "</td>
                                                        <td><a href='./edit-contract?col_special_Id=" . $getholdof_rows['col_special_Id'] . "'> <button title='View client task' type='button' class='btn  btn-primary btn-sm'><i class='feather mr-2 icon-list'></i></button></a></td>
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
                                        <th>Invoice format</th>
                                        <th>Decision</th>
                                    </tr>
                                </tfoot>
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