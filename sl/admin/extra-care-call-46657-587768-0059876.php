<?php include('client-header-contents.php'); ?>

<?php
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
    //change this line in your query as well
    $result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY userId DESC LIMIT 1");
    while ($row = mysqli_fetch_array($result)) {
?>
        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ delete box ] start -->
                <div class="row">
                    <div class="col-md-4 col-xl-2"></div>
                    <div class="col-md-4 col-xl-7">
                        <h5>Add extra care call<br>
                            <small><?php echo "" . $row['client_first_name'] . " " . $row['client_last_name'] . ""; ?></small>
                        </h5>
                        <hr>
                        <div class="card">
                            <div class="card-body" style="font-size: 16px;">
                                </p>

                                <form action="./processing-extra-care-call" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                    <div class="form-group">
                                        <input type="hidden" name="txtFirstname" value="<?php echo "" . $row['client_first_name'] . ""; ?>" />
                                        <input type="hidden" name="txtLastname" value="<?php echo "" . $row['client_last_name'] . ""; ?>" />
                                        <input type="hidden" name="txtClientArea" value="<?php echo "" . $row['client_area'] . ""; ?>" />
                                        <input type="hidden" name="txtMySpciealId" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                                        }
                                                                                    } ?>" />
                                        <input type="hidden" name="txtCompanyId" value="<?php echo "" . $_SESSION['usr_compId'] . ""; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="txtCarecallType" value="Extra" />
                                        <!--<label for="Care call type"> Type of care call</label>
                                        <select name="txtCarecallType" required class="form-control" id="exampleFormControlSelect1">
                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                            <option value="Mid-Morning">Mid-Morning</option>
                                            <option value="Mid-Afternoon">Mid-Afternoon</option>
                                            <option value="Mid-Evening">Mid-Evening</option>
                                        </select>-->
                                    </div>

                                    <button class="btn btn-primary" name="btnAddClientCareCall" type="submit">Add more</button>
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