<?php include('header-contents.php'); ?>
<?php include('processing-new-purchase-order.php'); ?>

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
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">
                                New Purchase Order<br>
                                <small>Form details</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="col-md-12">
                    <form action="./processing-new-purchase-order" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Care recipient<span style="color: red;"> *</span></label>
                                    <select name="txtone" class="form-control" id="exampleFormControlSelect1">
                                        <option value="" selected="selected" disabled="disabled">Select...</option>
                                        <?php
                                        $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                        while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {
                                            echo "<option value='" . $getholdof_rows['uryyToeSS4'] . "'>" . $getholdof_rows['client_first_name'] . " " . $getholdof_rows['client_last_name'] . "</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Payer<span style="color: red;"> *</span></label>
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
                                <label for="exampleInputPassword1">Contract<span style="color: red;"> *</span></label>
                                <select name="txtthree" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <?php
                                    $getCareRecipient = mysqli_query($conn, "SELECT * FROM tbl_contract WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                    while ($fetchData = mysqli_fetch_array($getCareRecipient)) {
                                        echo "
                                            <option value='" . $fetchData['col_name'] . "'>" . $fetchData['col_name'] . "</option>
                                        ";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Service type(s)<span style="color: red;"> *</span></label>
                                    <select name="txtfour" class="form-control" id="exampleFormControlSelect1">
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
                                <label for="exampleInputPassword1">Maximum hours per week<span style="color: red;"> *</span></label>
                                <input type="text" name="txtfive" placeholder="Maximum hours per week" required class="form-control" id="exampleInputPassword1" />
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
                            <input style="float: right;" type="submit" name="btnAddNewPurchaseData" class="btn btn-small btn-info" value="Save data" />
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
                                        <th>Care recipient</th>
                                        <th>Payer</th>
                                        <th>Contract</th>
                                        <th>Service type</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_purchase_order WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {
                                        echo "
                                                    <tr>
                                                        <td>" . $getholdof_rows['col_client_name'] . "</td>
                                                        <td>" . $getholdof_rows['col_payer'] . "</td>
                                                        <td>" . $getholdof_rows['col_contract_name'] . "</td>
                                                        <td>" . $getholdof_rows['col_service_type'] . "</td>
                                                        <td><a href='./delete-purchase-order?col_special_Id=" . $getholdof_rows['col_special_Id'] . "'> <button title='View client task' type='button' class='btn  btn-danger btn-sm'><i class='feather mr-2 icon-delete'></i></button></a></td>
                                                     </tr>
                                                
                                                ";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Care recipient</th>
                                        <th>Payer</th>
                                        <th>Contract</th>
                                        <th>Service type</th>
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
</div>

<?php include('footer-contents.php'); ?>