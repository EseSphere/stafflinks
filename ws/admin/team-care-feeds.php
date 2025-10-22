<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <?php
            include('dbconnect.php');

            if (isset($_GET['uryyToeSS4'])) {
                $uryyToeSS4 = $_GET['uryyToeSS4'];

                $result = mysqli_query($myConnection, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' ");
                while ($row = mysqli_fetch_array($result)) { ?>

                    <!-- Clients feed, team member start -->
                    <div class="col-xl-4">
                        <a href='./view-client-feed<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>' style='text-decoration:none; color:#000;'>
                            <div class='card table-card'>
                                <div class='card-header'>
                                    <h5><i class='feather mr-2 icon-briefcase'></i> &nbsp; Visit</h5>
                                    <span style='position:absolute; right:20px; font-weight:16px;'>Time of visit</span>
                                </div>
                                <div class='card-body p-0'>
                                    <div style='width:100%; height:auto; padding:8px 0px 8px 22px; font-size:16px;'>
                                        <h6>Care team</h6>
                                        <span style='font-weight:22px;'><i class='feather mr-2 icon-user'></i> Samson Gift</span> | <span style='font-weight:22px;'>Michael Nas</span>
                                        <hr>
                                        <h6>Alert</h6>
                                        <span style='font-weight:22px;'><i class='feather mr-2 icon-alert-triangle'></i> No alert raised</span>
                                    </div>
                                    <div style=" width: 100%; height:auto; padding:8px; background-color:rgba(24, 44, 97,1.0); color:#fff;">
                                        <span style='font-weight:22px;'><i class='feather mr-2 icon-check-square'></i> Completed</span> <span style='font-weight:22px; position:absolute; right:10px;'>15min / 30min</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
        </div>

<?php }
            } ?>
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