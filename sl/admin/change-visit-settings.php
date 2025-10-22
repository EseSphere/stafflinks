<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <h5><strong>Visit
                <br>
                <small>
                    Time schedule
                </small>
            </strong>
        </h5>
        <hr>
        <div class="row">
            <div class="col-xl-2"></div>
            <!--Care update time form start here -->
            <div class="col-xl-6">
                <div style="width: 100%; height:auto; padding:22px; margin-top:50px; border:1px solid rgba(189, 195, 199,1.0);">
                    <form method="POST" action="./processing-visit-settings" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                        <?php
                        $myIduser = $_GET['userId'];
                        ?>

                        <input name="clientId" type="hidden" value="<?php echo $myIduser; ?>">
                        <div class="form-group">
                            <h6><strong><img style="width: 15px; height:15px;" src="./assets/images/icons/cloud-drizzle.svg" alt=""> Visit</strong></h6>
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <label for="exampleInputPassword1">New time in<span style="color: red;"></span></label>
                                    <input name="txtDateTimeIn" type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time in">
                                </div>
                                <div class="col-md-6 col-6">
                                    <label for="exampleInputPassword1">New time out<span style="color: red;"></span></label>
                                    <input name="txtDateTimeOut" type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time out">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <button style="height:50px;" type="submit" name="btnSubmitVisitSettings" class="btn btn-info">Update now</button>
                        </div>
                    </form>
                </div>
            </div>

            <!--Care update time form end here -->
            <div class="col-xl-4"></div>
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