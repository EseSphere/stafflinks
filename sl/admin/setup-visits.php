<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}
?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <!--Care update time form start here -->
            <div class="col-xl-8">
                <h5><strong>Update care calls</strong></h5>
                <hr>
                <div style="width: 100%; height:auto; padding:2px; text-align:right;">
                    <a href="./carers-required-all-care-call?uryyToeSS4=<?php print $uryyToeSS4; ?>" style="text-decoration: none;">
                        <button class="btn btn-outline-secondary btn-small">Carers</button>
                    </a>
                </div>

                <form method="POST" action="./processing-client-care-calls" enctype="multipart/form-data" name="addClient-form" autocomplete="off">
                    <input name="clientId" type="hidden" value="<?php echo "" . $uryyToeSS4 . ""; ?>">

                    <div class=" form-group">
                        <h6><strong><img style="width: 15px; height:15px;" src="./assets/images/icons/cloud-drizzle.svg" alt=""> Morning visit</strong></h6>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <label for="exampleInputPassword1">Morning call time in<span style="color: red;"></span></label>
                                <input name="txtMorDateTimeIn" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                            <div class=" col-md-6 col-6">
                                <label for="exampleInputPassword1">Morning call time out<span style="color: red;"></span></label>
                                <input name="txtMorDateTimeOut" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class=" form-group">
                        <h6><strong><img style="width: 15px; height:15px;" src="./assets/images/icons/sunrise.svg" alt=""> Lunch visit</strong></h6>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <label for="exampleInputPassword1">Lunch call time in<span style="color: red;"></span></label>
                                <input name="txtLunDateTimeIn" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                            <div class=" col-md-6 col-6">
                                <label for="exampleInputPassword1">Lunch call time out<span style="color: red;"></span></label>
                                <input name="txtLunDateTimeOut" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                        </div>
                    </div>

                    <div class=" form-group">
                        <h6><strong><img style="width: 15px; height:15px;" src="./assets/images/icons/coffee.svg" alt=""> Tea visit</strong></h6>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <label for="exampleInputPassword1">Tea call time in<span style="color: red;"></span></label>
                                <input name="txtTeaDateTimeIn" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                            <div class=" col-md-6 col-6">
                                <label for="exampleInputPassword1">Tea call time out<span style="color: red;"></span></label>
                                <input name="txtTeaDateTimeOut" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                        </div>
                    </div>

                    <div class=" form-group">
                        <h6><strong><img style="width: 15px; height:15px;" src="./assets/images/icons/moon.svg" alt=""> Bed visit</strong></h6>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <label for="exampleInputPassword1">Bed call time in<span style="color: red;"></span></label>
                                <input name="txtBedDateTimeIn" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                            <div class=" col-md-6 col-6">
                                <label for="exampleInputPassword1">Bed call time out<span style="color: red;"></span></label>
                                <input name="txtBedDateTimeOut" type="time" class="form-control" id="exampleInputPassword1" value="Null">
                            </div>
                        </div>
                    </div>

                    <div class=" form-group">
                        <button style="height:50px;" type="submit" name="btnSubmitClientgCalls" class="btn btn-info">Update now</button>
                    </div>
                </form>
            </div>

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
    </div>
</div>




<?php include('footer-contents.php'); ?>