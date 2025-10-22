<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <!--Care update time form start here -->
            <div class="col-xl-8">
                <h5>Update care call
                    <br>
                    <small>Support time</small>
                </h5>
                <hr>
                <br><br>

                <form method="POST" action="./processing-support-care-call" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                    <?php
                    include('dbconnect.php');

                    if (isset($_GET['uryyToeSS4'])) {
                        $uryyToeSS4 = $_GET['uryyToeSS4'];

                        $result = mysqli_query($myConnection, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' ");
                        while ($row = mysqli_fetch_array($result)) { ?>

                            <input name="clientId" type="hidden" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                    }
                                                                } ?>">


                            <div class=" form-group">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <label for="exampleInputPassword1">Support call time in<span style="color: red;">*</span></label>
                                        <input name="txtDateTimeIn" required type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time in">
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <label for="exampleInputPassword1">Support call time out<span style="color: red;">*</span></label>
                                        <input name="txtDateTimeOut" required type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time out">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="btnSubmitSupportCall" class="btn  btn-info">Update now</button>
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