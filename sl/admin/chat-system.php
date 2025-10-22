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
                                        if (isset($_GET['user_special_Id'])) {
                                            $user_special_Id = $_GET['user_special_Id'];
                                        }
                                        $result_disp = mysqli_query($conn, "SELECT * FROM tbl_goesoft_carers_account WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY user_fullname ASC");
                                        while ($trans = mysqli_fetch_array($result_disp)) {
                                            $carerNum_chat = $trans['user_email_address'];

                                            if ($result = mysqli_query($conn, "SELECT * FROM tbl_chat_system WHERE (carer_specialId = '$user_special_Id' AND chat_status ='Pending' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')")) {
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
                                <div style="width: 100%; height:auto; padding:12px 0px 0px 33px;">
                                    <form action="./processing-chat-system" method="post" enctype="multipart/form-data" autocomplete="off" name="chatBoxform">

                                        <?php
                                        $chatCarer_result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_carers_account WHERE user_special_Id = '$user_special_Id'");
                                        while ($Caht_rows = mysqli_fetch_array($chatCarer_result)) { ?>
                                            <input type="hidden" value="<?php echo "" . $Caht_rows['user_email_address'] . ""; ?>" name="txtCarerEmail" />
                                            <input type="hidden" value="<?php echo "" . $Caht_rows['user_special_Id'] . "";
                                                                    } ?>" name="txtCarerSpecialId" />


                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE user_email_address = '" . $_SESSION['usr_email'] . "'");
                                            while ($trans = mysqli_fetch_array($result)) { ?>
                                                <input type="hidden" value="<?php echo "" . $trans['user_email_address'] . ""; ?>" name="txtAdminEmail" />
                                                <input type="hidden" value="<?php echo "" . $trans['user_fullname'] . ""; ?>" name="txtAdminName" />
                                                <input type="hidden" value="<?php echo "" . $trans['user_special_Id'] . "";
                                                                        } ?>" name="txtAdminSpecialId" />
                                                <div class="form-group">
                                                    <textarea name="txtChatMessage" id="" rows="5" class="form-control" placeholder="Message" required></textarea>
                                                </div>


                                                <input type="hidden" value="<?php print $sTime; ?>" name="txtAdminTimeSent" />
                                                <input type="hidden" value="<?php print $currentDate; ?>" name="txtAdminDateSent" />


                                                <div class="form-group">
                                                    <input type="submit" value="Send chat" class="btn btn-md btn-primary" name="btnSendChat" />
                                                </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-8">


                                <!------------------------------------------------------------------------------------------------------------>
                                <!--The chat area begins here-->
                                <!------------------------------------------------------------------------------------------------------------>

                                <div class="chatSystemBox">

                                    <?php
                                    $chat_system_result = mysqli_query($conn, "SELECT * FROM tbl_chat_system WHERE carer_specialId = '$user_special_Id' ORDER BY userId DESC");
                                    while ($result_trans_rows = mysqli_fetch_array($chat_system_result)) {
                                        echo "
                                        <div class='row'>
                                        <div style='margin: 0; padding:0;' class='col-md-1 col-1'>
                                            <div style='width: 100%; height:auto; padding:2px 0px 0px 33px;'>
                                                <img src='./assets/images/chat_system/9619263.png' style='width: 100%; height:100%; border-radius:100%;' alt=''>
                                            </div>
                                        </div>
                                        <div style='margin: 0; padding:0;' class='col-md-8 col-8'>
                                            <div style='border-radius:12px; width: 100%; height:auto; padding:22px; background-color:rgba(41, 128, 185,1.0); color:#fff;'>
                                                <span style='color: rgba(236, 240, 241,.8);'><em>" . $result_trans_rows['admin_name'] . "</em></span>
                                                <span style='color: rgba(236, 240, 241,.8); float:right;'><em>" . $result_trans_rows['adTime_sent'] . " " . $result_trans_rows['adDate_sent'] . "</em></span>
                                                <br>
                                                " . $result_trans_rows['admin_chat'] . "
                                            </div>
                                        </div>
                                        <div class='col-md-3 col-3'></div>
                                    </div>

                                    <br>
                                    <div class='row'>
                                        <div class='col-md-3 col-3'></div>
                                        <div style='margin: 0; padding:0;' class='col-md-8 col-8'>
                                            <div style='border-radius:12px; width: 100%; height:auto; padding:22px; background-color:rgba(22, 160, 133,1.0); color:#fff;'>
                                                <span style='color: rgba(236, 240, 241,.8);'><em>" . $result_trans_rows['carer_name'] . "</em></span>
                                                <span style='color: rgba(236, 240, 241,.8); float:right;'><em>" . $result_trans_rows['time_sent'] . " " . $result_trans_rows['date_sent'] . "</em></span>
                                                <br>
                                                " . $result_trans_rows['carer_chat'] . "
                                            </div>
                                        </div>
                                        <div style='margin: 0; padding:0;' class='col-md-1 col-1'>
                                            <div style='width: 100%; height:auto; padding:2px 0px 0px 33px;'>
                                                <img src='./assets/images/chat_system/3210031.png' style='width: 100%; height:100%; border-radius:100%;' alt=''>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    ";
                                    } ?>
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