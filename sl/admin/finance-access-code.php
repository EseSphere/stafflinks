<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Finance Access Code</h5>
                <hr>
                <?php
                if (isset($_GET['col_company_Id'])) {
                    $col_company_Id = $_GET['col_company_Id'];
                    //change this line in your query as well
                    $result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE col_company_Id='$col_company_Id' ORDER BY userId DESC LIMIT 1");
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div style="text-align:right;" class="col-md-4">
                                <a href="./share-access-code?col_company_Id=<?php echo "" . $row['col_company_Id'] . ""; ?>" style="text-decoration: none;">
                                    <button class="btn btn-info">Admin access</button>
                                </a>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Send to recipient</h5>
                            <div class="card-body" style="font-size: 16px;">

                                <form action="./processing-company-finance-code" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                    <div class="form-group">
                                        <input type="email" name="txtRecipient_Email" placeholder="Recipient email" class="form-control" required />
                                    </div>
                                    <input type="hidden" name="txtInviteeEmail" value="<?php echo "" . $row['user_email_address'] . ""; ?>">
                                    <div class="form-group">
                                        <textarea name="txtShareCode" id="" cols="" rows="6" class="form-control" required>Access code are designed to grant the desired recipient to be able to create account, login and also control most of the activities in the dashboard. By granting access you have agreed to the terms and conditions. Kindly click the link below to create an account. Do not disclose this link to anyone. Thank you.</textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="txtShareUrl" value="https://geosoftcare.co.uk/geosoft/files/admin-control-panel/control-panel/share-access-signup?col_company_Id=<?php echo "" . $row['col_company_Id'] . "";
                                                                                                                                                                                                }
                                                                                                                                                                                            } ?>">
                                    </div>
                                    <button class="btn btn-primary" name="btnshareAccessCode" type="submit">Send Share Code</button>
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