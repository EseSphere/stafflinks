<?php include('header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <!--Care update time form start here -->
            <div class="col-xl-8">
                <div class="row">

                    <!-- Clients feed, team member start -->
                    <div class="col-xl-6">
                        <a href='./view-client-feed' style='text-decoration:none; color:#000;'>
                            <div class='card table-card'>
                                <div class='card-header'>
                                    <h5><strong><i class='feather mr-2 icon-briefcase'></i> &nbsp; Care call history</strong></h5>
                                </div>
                                <div class='card-body p-0'>
                                    <div style=" width: 100%; height:auto; padding:18px; color:rgba(39, 174, 96,1.0);">
                                        <span style='font-weight:22px;'><i class='feather mr-2 icon-check-square'></i> Updated</span> <span style='font-weight:22px; position:absolute;'>&nbsp; &nbsp; 24 Jan 2024</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-6">
                        <a href='./view-client-feed' style='text-decoration:none; color:#000;'>
                            <div class='card table-card'>
                                <div class='card-header'>
                                    <h5><strong><i class='feather mr-2 icon-briefcase'></i> &nbsp; Suppervision history</strong></h5>
                                </div>
                                <div class='card-body p-0'>
                                    <div style=" width: 100%; height:auto; padding:18px; color:rgba(39, 174, 96,1.0);">
                                        <span style='font-weight:22px;'><i class='feather mr-2 icon-check-square'></i> Updated</span> <span style='font-weight:22px; position:absolute;'>&nbsp; &nbsp; 24 Jan 2024</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-6">
                        <a href='./view-client-feed' style='text-decoration:none; color:#000;'>
                            <div class='card table-card'>
                                <div class='card-header'>
                                    <h5><strong><i class='feather mr-2 icon-briefcase'></i> &nbsp; Report & Compliments</strong></h5>
                                </div>
                                <div class='card-body p-0'>
                                    <div style=" width: 100%; height:auto; padding:18px; color:rgba(39, 174, 96,1.0);">
                                        <span style='font-weight:22px;'><i class='feather mr-2 icon-check-square'></i> Updated</span> <span style='font-weight:22px; position:absolute;'>&nbsp; &nbsp; 24 Jan 2024</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>

            <!--Care update time form end here -->



            <!--Client brief detail start here -->
            <div class="col-xl-4">

                <section style="background-color: #eee; margin-bottom:50px;">
                    <br>
                    <div class="container-fluid">

                        <?php
                        include('dbconnect.php');

                        if (isset($_GET['user_special_Id'])) {
                            $user_special_Id = $_GET['user_special_Id'];

                            $result = mysqli_query($myConnection, "SELECT * FROM tbl_goesoft_carers_account WHERE user_special_Id='$user_special_Id' ");
                            while ($row = mysqli_fetch_array($result)) { ?>


                                <div class="row" style="font-size: 18px;">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                <img src="assets/images/user/profile-icon.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 120px;">
                                                <h5 class="my-3"><?php echo "" . $row['user_fullname'] . "" ?></h5>
                                                <p style="font-size: 16px;" class="text-muted mb-1"><?php echo "" . $row['user_email_address'] . "" ?></p>
                                                <p style="font-size: 16px;" class="text-muted mb-4"><?php echo "" . $row['user_phone_number'] . "" ?></p>
                                                <div class="d-flex justify-content-center mb-2">
                                                    <a href="./client-status<?php echo "?user_special_Id=" . $row['user_special_Id'] . "" ?>" style=" text-decoration: none;">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Client status</button>
                                                    </a>

                                                    &nbsp;&nbsp;

                                                    <a href="./delete-client-details<?php echo "?user_special_Id=" . $row['user_special_Id'] . ""; ?>" style=" text-decoration: none;">
                                                        <button type="button" class="btn btn-danger" data-target="#exampleModal" data-whatever="@mdo">Delete profile</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="card mb-4 mb-lg-0">
                                            <div class="card-body p-0" style="font-size: 18px;">
                                                <h5 style="padding: 22px;">Care calls</h5>
                                                <ul class="list-group list-group-flush rounded-3">


                                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                        <i class="fa fa-bath fa-lg text-warning" aria-hidden='true'></i>
                                                        <p style="font-size: 16px;" class="mb-0"><?php echo "" . $row['verification_code'] . "" ?></p>
                                                    </li>


                                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                        <i class="fa fa-medkit fa-lg" style="color: #333333;"></i>
                                                        <p style="font-size: 16px;" class="mb-0"><?php echo "" . $row['date_registered'] . "" ?></p>
                                                    </li>


                                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                        <i class="fa fa-coffee fa-lg" style="color: #55acee;"></i>
                                                        <p style="font-size: 16px;" class="mb-0"><?php echo "" . $row['time_registered'] . "" ?></p>
                                                    </li>


                                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                        <i class="fa fa-bed fa-lg" style="color: #ac2bac;"></i>
                                                        <a href="./bed-care-calls<?php echo "?user_special_Id=" . $row['user_special_Id'] . "" ?>" style=" text-decoration: none; color:#000;">
                                                            <p style="font-size: 16px;" class="mb-0">
                                                        <?php echo "" . $row['status2'] . "";
                                                    }
                                                } ?>
                                                            </p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                    </div>
                    <br><br>
                </section>

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