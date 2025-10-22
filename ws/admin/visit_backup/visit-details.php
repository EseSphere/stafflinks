<?php include('client-header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <?php
        if (isset($_GET['uryyToeSS4'])) {
            $uryyToeSS4 = $_GET['uryyToeSS4'];
        }
        ?>
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Visit details
                    <br>
                    <small>
                        <?php echo "" . $_SESSION['care_calls']; ?>
                    </small>
                </h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <div style="font-size:18px;"><span style="color:red;"><strong>Note:</strong></span> <br>
                            Are you sure you want to end <?php print $_SESSION['client_fullName'] . ' ' . $_SESSION['care_calls']; ?>?</div>
                        <hr style="background-color: rgba(149, 165, 166,.7);">
                        </p>


                        <form action="./processing-end-care-call" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <input type="hidden" name="txtClientId" value="<?php echo "" . $uryyToeSS4; ?>" />
                            <input type="hidden" name="txtClientCareCall" value="<?php echo "" . $_SESSION['care_calls']; ?>" />

                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="Start date"><strong>End visit</strong></label>
                                        <input type="date" name="txtEndDate" value="<?php echo $tomorrow; ?>" class="form-control" required id="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="button" onclick="history.back();" class="btn btn-danger">Go back</button>
                                <button class="btn btn-primary" name="btnEndCareCall" type="submit">End visit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>