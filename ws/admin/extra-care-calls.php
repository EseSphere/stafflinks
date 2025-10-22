<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <?php
            if (isset($_GET['uryyToeSS4'])) {
                $uryyToeSS4 = $_GET['uryyToeSS4'];

                $sel_extra_care_call_result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' ");
                while ($get_extra_care_call_row = mysqli_fetch_array($sel_extra_care_call_result)) { ?>

                    <!--Care update time form start here -->
                    <div class="col-xl-8">
                        <h5>Update care call
                            <br>
                            <small><?php echo "" . $get_extra_care_call_row['client_first_name'] . " " . $get_extra_care_call_row['client_last_name'] . ""; ?> Extra care call</small>
                        </h5>
                        <hr>
                        <div style="width: 100%; height:auto; text-align:right;">
                            <form action="./processing-remove-extra-care-call" method="post" enctype="multipart/form-data">
                                <input name="RemoveclientId" type="hidden" value="<?php echo "" . $get_extra_care_call_row['uryyToeSS4'] . "";  ?>">
                                <input type="submit" name="removeExtraCareCall" value="Remove" class="btn btn-danger">
                            </form>
                        </div>
                        <br><br>



                        <form method="POST" action="./processing-extra-care-calls" enctype="multipart/form-data" name="addClient-form" autocomplete="off">
                            <input name="clientId" type="hidden" value="<?php echo "" . $get_extra_care_call_row['uryyToeSS4'] . "";
                                                                    }
                                                                } ?>">

                            <div class=" form-group">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <label for="exampleInputPassword1">Extra carecall time in<span style="color: red;">*</span></label>
                                        <input name="txtDateTimeIn" required type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time in">
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <label for="exampleInputPassword1">Extra carecall time out<span style="color: red;">*</span></label>
                                        <input name="txtDateTimeOut" required type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time out">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="btnSubmitMorningCall" class="btn  btn-info">Update now</button>
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