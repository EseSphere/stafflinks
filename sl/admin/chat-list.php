<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <div class="row">
            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">

            </div>

            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h4>Chat list</h4>
                    </div>
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-lg-4">
                                <div style="width: 100%; height:auto; padding:12px 0px 0px 33px;">
                                    <ul style="max-height: 500px; overflow:scroll; cursor:pointer;" class="list-group">
                                        <?php
                                        $result_disp = mysqli_query($conn, "SELECT * FROM tbl_goesoft_carers_account WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY user_fullname ASC");
                                        while ($trans = mysqli_fetch_array($result_disp)) {
                                            $carerNum_chat = $trans['user_email_address'];

                                            if ($result = mysqli_query($conn, "SELECT * FROM tbl_chat_system WHERE carer_email = '$carerNum_chat' AND chat_status ='Pending'")) {
                                                $rowcount_finclientTask = mysqli_num_rows($result);
                                                echo "
                                            <li class='list-group-item d-flex justify-content-between align-items-center'>
                                                <a href='./chat-system?user_special_Id=" . $trans['user_special_Id'] . "' style='text-decoration:none; color:black; width:100%; height:auto; padding:5px;'>
                                                    " . $trans['user_fullname'] . "
                                                    <span style='position:absolute; right:20px;' class='pull-right badge badge-danger badge-pill'>$rowcount_finclientTask</span>
                                                </a>
                                            </li>
                                            ";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <hr style="background-color: rgba(44, 62, 80,.4);">
                                <!--Chat box body area-->
                            </div>
                            <div class="col-lg-8">
                                <div style="text-align:center; width: 100%; height:auto; padding:22px; color:rgba(189, 195, 199,.6); margin: 100px auto;">
                                    <h3>Select carer to start chat</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <?php include('bottom-panel-block.php'); ?>




        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>