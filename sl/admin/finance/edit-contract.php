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
                                Edit contract<br>
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

                <?php
                if (isset($_GET['col_special_Id'])) {
                    $col_special_Id = $_GET['col_special_Id'];
                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_contract WHERE col_special_Id = '$col_special_Id'");
                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {
                ?>
                        <div class="col-md-12">
                            <form action="./processing-edit-contract" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Name<span style="color: red;"> *</span></label>
                                            <input type="text" name="txtone" value="<?php echo "" . $getholdof_rows['col_name'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Payer<span style="color: red;"> *</span></label>
                                            <input type="text" name="txttwo" value="<?php echo "" . $getholdof_rows['col_payer'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Service type(s)<span style="color: red;"> *</span></label>
                                            <input type="text" name="txtthree" value="<?php echo "" . $getholdof_rows['col_service_type'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputPassword1">Rate card<span style="color: red;"> *</span></label>
                                        <input type="text" name="txtfour" value="<?php echo "" . $getholdof_rows['col_rate_card'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputPassword1">Invoice format<span style="color: red;"> *</span></label>
                                        <input type="text" name="txtfive" value="<?php echo "" . $getholdof_rows['col_invoice_format'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                    </div>
                                </div>
                                <br>
                                <input type="hidden" value="<?php echo "" . $getholdof_rows['col_special_Id'] . "";
                                                        }
                                                    } ?>" name="mySpecialId" />
                                <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">

                                <div class="form-group">
                                    <input style="float: right;" type="submit" name="btnUpdateContractData" class="btn btn-small btn-info" value="Update data" />
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