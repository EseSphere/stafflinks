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
                                New Payer<br>
                                <small>Add payer</small>
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
                    <form action="./new-payer" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Contract already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Name<span style="color: red;"> *</span></label>
                                    <input type="text" name="txtone" placeholder="Name" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email<span style="color: red;"></span></label>
                                    <input type="email" name="txttwo" placeholder="Email" class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone number<span style="color: red;"> *</span></label>
                                    <input type="tel" name="txtthree" placeholder="Phone number" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Invoicing preference<span style="color: red;"> *</span></label>
                                <select name="txtfour" class="form-control" id="exampleFormControlSelect1">
                                    <option value="" selected="selected" disabled="disabled">Select...</option>
                                    <option value="Call payer">By phone</option>
                                    <option value="Email payer">By email</option>
                                    <option value="Send post to payer">By post</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Address<span style="color: red;"> *</span></label>
                                <textarea name="txtfive" id="exampleFormControlSelect1" class="form-control" required rows="3"></textarea>
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
                        ?>
                        <input type="hidden" value="<?php echo $id; ?>" name="mySpecialId" />
                        <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />
                        <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">
                        <div class="form-group">
                            <input style="float: right;" type="submit" name="btnAddNewPayerData" class="btn btn-small btn-info" value="Save data" />
                        </div>
                    </form>
                </div>
            </div>
            <!-- prject ,team member start -->
            <div class="col-xl-8 col-md-8">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Payer</h5>
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
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Invoice preference</th>
                                        <th>Address</th>
                                        <th>Contract</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectQuery = mysqli_query($conn, "SELECT * FROM tbl_payer WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY userId DESC");
                                    while ($getholdof_rows = mysqli_fetch_array($SelectQuery)) {
                                        echo "
                                                    <tr>
                                                        <td>" . $getholdof_rows['col_name'] . "</td>
                                                        <td>" . $getholdof_rows['col_email'] . "</td>
                                                        <td>" . $getholdof_rows['col_phone_number'] . "</td>
                                                        <td>" . $getholdof_rows['col_invoice_pref'] . "</td>
                                                        <td>" . $getholdof_rows['col_address'] . "</td>
                                                        <td>
                                                            <a style='text-decoration:none;' href='./view-contract?col_special_Id=" . $getholdof_rows['col_special_Id'] . "'> 
                                                                <button title='View contract' type='button' class='btn btn-primary btn-sm'><i class='feather mr-2 icon-list'></i></button>
                                                            </a>
                                                        </td>
                                                        </tr>
                                                
                                                ";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Invoice preference</th>
                                        <th>Address</th>
                                        <th>Contract</th>
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
<!-- [ Main Content ] end -->

<?php include('footer-contents.php'); ?>