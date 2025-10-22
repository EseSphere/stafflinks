<?php include('header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add new position</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Psition</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Reply report</h5>
                    </div>
                    <form method="POST" action="./processing-update-reports" enctype="multipart/form-data" name="addClient-form" autocomplete="off">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <?php
                                                include('dbconnect.php');

                                                if (isset($_GET['report_Id'])) {

                                                    $report_Id = (int)$_GET['report_Id'];
                                                    //change this line in your query as well
                                                    $result = mysqli_query($myConnection, "SELECT * FROM tbl_report_issues WHERE report_Id='$report_ID'");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                ?>

                                                        <input type="text" value="<?php echo "" . $row['report_Id'] . "";
                                                                                }
                                                                            } ?>" name="report_ID" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Reply report</label>
                                                <textarea name="txtReplyReport" required id="exampleInputReport1" class="form-control" rows="5" placeholder="Reply report"></textarea>
                                            </div>

                                            <div style="padding: 0px 0px 0px 15px;" class="form-group">
                                                <button type="submit" name="btnSubmitReply" class="btn btn-primary">Send reply</button>
                                            </div>
                                        </div>

                                        <div class="col-md-7">

                                            <h4>Report(s)</h4>
                                            <br>

                                            <div class="card table-card">
                                                <div class="card-header">
                                                    <div class="card-header-right">
                                                        <div class="btn-group card-option">
                                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="feather icon-more-horizontal"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">


                                                    <?php
                                                    include('dbconnect.php');

                                                    //change this line in your query as well
                                                    $result = mysqli_query($myConnection, "SELECT * FROM tbl_report_issues ORDER BY report_Id DESC LIMIT 10");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo "
                                                   
                                                            <div class='form-group'>
                                                                <h5>" . $row['report_title'] . "</h5>
                                                                <p class='text-muted m-b-0'>Client is " . $row['client_name'] . "</p>
                                                                <div style='width: 100%; font-size:16px; padding:6px;''>
                                                                <p class='text-muted m-b-0'>Client is " . $row['team_members'] . "</p>
                                                                " . $row['report_details'] . "</div>
                                                            </div>
                                                            ";
                                                    }
                                                    ?>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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