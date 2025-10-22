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
                                Invoice configuration
                                <br>
                                <small>Add an invoicing email address, payment details, and billing address for your branch</small>
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
                    <form action="./billing-config" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Communication email already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <br>
                                    <label for="exampleInputPassword1"><strong>Invoice information</strong><span style="color: red; font-size:22px;"> *</span></label>
                                    <br>
                                    <label for="exampleInputPassword1">Billing address<span style="color: red;"> *</span></label>
                                    <textarea placeholder="Billing address" style="height: 100px;" name="txtone" id="exampleFormControlSelect1" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Invoice number prefix (optional)<span style="color: red;"> *</span></label>
                                    <input type="number" name="txttwo" placeholder="Invoice number prefix (optional)" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Office phone number (optional)<span style="color: red;"> *</span></label>
                                    <input type="tel" name="txtthree" placeholder="Office phone number (optional)" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputPassword1">Payment details<span style="color: red;"> *</span></label>
                                <textarea placeholder="Payment details" style="height: 100px;" name="txtfour" id="exampleFormControlSelect1" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <br>
                                    <label for="exampleInputPassword1"><strong>Communication</strong><span style="color: red; font-size:22px;"> *</span></label>
                                    <br>
                                    <label for="exampleInputPassword1">Email for invoicing queries<span style="color: red;"> *</span></label>
                                    <input type="text" name="txtfive" placeholder="Email for invoicing queries" required class="form-control" id="exampleInputPassword1" />
                                </div>
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
                            <input style="float: left;" type="submit" name="btnAddBillingConfigData" class="btn btn-small btn-info" value="Save data" />
                        </div>
                    </form>
                </div>
                <br>
                <hr>
            </div>
        </div>





    </div>
    <!-- Latest Customers end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>

<?php include('footer-contents.php'); ?>