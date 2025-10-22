<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Grant access to finance</h5>
                <hr>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button style="color: #000;" class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><strong>Minor access</strong></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button style="color: #000;" class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><strong>Major access</strong></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="card">
                            <h5 class="card-header">Activate minor access</h5>
                            <div class="card-body" style="font-size: 16px;">
                                <p class="card-text" style="font-size: 16px;">By granting this user access to the finance portal. You have agreed that this user will be able to manage financial activities concerning company finance and invoices with limited access.</p>
                                <hr>
                                Are you sure you want to grant minor access to this user?
                                </p>

                                <?php
                                if (isset($_GET['user_special_Id'])) {
                                    $user_special_Id = $_GET['user_special_Id'];
                                    //change this line in your query as well
                                    $result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE user_special_Id='$user_special_Id'");
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                        <form action="./processing-minor-finance-grant" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" name="adminSpecialId" value="<?php echo "" . $row['user_special_Id'] . "";
                                                                                                }
                                                                                            } ?>" />
                                            </div>

                                            <button class="btn btn-danger" name="btnGrantAccess" type="submit">Yes am sure!</button>
                                        </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="card">
                            <h5 class="card-header">Activate major access</h5>
                            <div class="card-body" style="font-size: 16px;">
                                <p class="card-text" style="font-size: 16px;">By granting this user access to the finance portal. You have agreed that this user will be able to manage financial activities concerning company finance and invoices with maximum access.</p>
                                <hr>
                                Are you sure you want to grant major access to this user?
                                </p>

                                <?php
                                if (isset($_GET['user_special_Id'])) {
                                    $user_special_Id = $_GET['user_special_Id'];
                                    //change this line in your query as well
                                    $result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE user_special_Id='$user_special_Id'");
                                    while ($row = mysqli_fetch_array($result)) {
                                ?>
                                        <form action="./processing-major-finance-grant" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" name="adminSpecialId" value="<?php echo "" . $row['user_special_Id'] . "";
                                                                                                }
                                                                                            } ?>" />
                                            </div>

                                            <button class="btn btn-primary" name="btnGrantMajorAccess" type="submit">Yes am sure!</button>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>