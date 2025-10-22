<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <!--Care update time form start here -->
            <div class="col-xl-8">
                <h5>Required carer
                    <br>
                    <small>Number of required carer(s) for morning care call.</small>
                </h5>
                <hr>
                <br>

                <form method="POST" action="./processing-carers-required-tea-care-call" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                    <?php
                    if (isset($_GET['uryyToeSS4'])) {
                        $uryyToeSS4 = $_GET['uryyToeSS4'];
                        $result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' ");
                        while ($row = mysqli_fetch_array($result)) { ?>

                            <input name="clientId" type="hidden" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                    }
                                                                } ?>">

                            <div class=" form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="background-color:rgba(189, 195, 199,.2); font-size:16px; font-weight:600; border-left:8px solid rgba(192, 57, 43,1.0); padding:22px; border-radius:5px;">
                                            Kindly us the select box below to chose the numbers of carers required for morning care call.
                                        </div>
                                        <br>
                                        <label for=" exampleInputPassword1">Required carer(s)<span style="color: red;">*</span></label>
                                        <select name="txtRequiredCarers" required class="form-control" id="exampleFormControlSelect1">
                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                            <option value="1">One carer</option>
                                            <option value="2">Two carers</option>
                                            <option value="3">Three carers</option>
                                            <option value="4">Four carers</option>
                                            <option value="5">Five carers</option>
                                            <option value="6">Six carers</option>
                                            <option value="7">Seven carers</option>
                                            <option value="8">Eight carers</option>
                                            <option value="9">Nine carers</option>
                                            <option value="10">Ten carers</option>
                                            <option value="15">More than ten carers</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Select frequency 2 <span style="color: red;">*</span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input name="txtMonday" value="Monday" type="checkbox" class=" " id="customswitch5">
                                                        <span style="font-size:13px;">&nbsp; Morning call</span>
                                                    </div>
                                                    <div class="col-3">
                                                        <input name="txtTuesday" value="Tuesday" type="checkbox" class=" " id="customswitch6">
                                                        <span style="font-size:13px;">&nbsp; Lunch call</span>
                                                    </div>
                                                    <div class="col-2">
                                                        <input name="txtWednesday" value="Wednesday" type="checkbox" class=" " id="customswitch7">
                                                        <span style="font-size:13px;">&nbsp; Tea call</span>
                                                    </div>
                                                    <div class="col-2">
                                                        <input name="txtThursday" value="Thursday" type="checkbox" class=" " id="customswitch8">
                                                        <span style="font-size:13px;">&nbsp; Bed call</span>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="checkbox" name="select-all" id="select-alldays" />
                                                        <span style="font-size:13px;">&nbsp; All calls</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->

                            <div class="form-group">
                                <button type="submit" name="btnSaveRequiredCarer" class="btn  btn-info">Save now</button>
                            </div>
                </form>

            </div>

            <!--Care update time form end here -->


            <!--Client brief detail start here -->
            <div class="col-xl-4">

                <?php include('client-details-leftpanel.php'); ?>

            </div>
            <!--Client brief detail start here -->
        </div>


        <br>
        <br>

        <div class="row">
            <?php include('bottom-panel-block.php'); ?>
        </div>

        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>



<?php include('footer-contents.php'); ?>