<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <br>
        <h6>Carer feed</h6>

        <br>
        <div class="row">
            <div class="col-2">
                <div class="row">
                    <div class="col-md-12 col-2">
                        <?php
                        if (isset($_GET['uryyTteamoeSS4'])) {
                            $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE uryyTteamoeSS4='$uryyTteamoeSS4' AND call_status = 'Action needed' ORDER BY userId DESC LIMIT 1 ");
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <a href="./client-feed<?php echo "?uryyTteamoeSS4=" . $row['uryyTteamoeSS4'] . "";
                                                    }
                                                } ?>" style="text-decoration:none; color:#000;">
                                    <div style="padding: 3px;">
                                        <strong>Attempted
                                            <span style="float: right; background-color:#ecf0f1; padding:5px;">
                                                <?php
                                                if (isset($_GET['uryyTteamoeSS4'])) {
                                                    $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                                                    $result = "SELECT * FROM tbl_daily_shift_records WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ";
                                                    if ($result = mysqli_query($conn, $result)) {
                                                        $rowcount = mysqli_num_rows($result);
                                                        printf($rowcount);
                                                        mysqli_free_result($result);
                                                    }
                                                }

                                                ?>
                                            </span></strong>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-12 col-2">
                        <?php
                        if (isset($_GET['uryyTteamoeSS4'])) {
                            $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE uryyTteamoeSS4='$uryyTteamoeSS4' AND call_status = 'Action needed' ORDER BY userId DESC LIMIT 1 ");
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <a href="./alerts-feeds<?php echo "?uryyTteamoeSS4=" . $row['uryyTteamoeSS4'] . "";
                                                    }
                                                } ?>" style="text-decoration:none; color:#000;">
                                    <div style="padding: 3px;">
                                        <strong>Alerts
                                            <span style="float: right; background-color:#ecf0f1; padding:5px;">
                                                <?php
                                                if (isset($_GET['uryyTteamoeSS4'])) {
                                                    $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                                                    $result = "SELECT * FROM tbl_schedule_calls WHERE uryyTteamoeSS4='$uryyTteamoeSS4' AND call_status = 'Action needed' ";
                                                    if ($result = mysqli_query($conn, $result)) {
                                                        $rowcount = mysqli_num_rows($result);
                                                        printf($rowcount);
                                                        mysqli_free_result($result);
                                                    }
                                                }

                                                ?>


                                            </span></strong>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-12 col-2">
                        <?php
                        if (isset($_GET['uryyTteamoeSS4'])) {
                            $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE uryyTteamoeSS4='$uryyTteamoeSS4' AND call_status = 'Action needed' ORDER BY userId DESC LIMIT 1 ");
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <a href="./client-visit<?php echo "?uryyTteamoeSS4=" . $row['uryyTteamoeSS4'] . "";
                                                    }
                                                } ?>" style="text-decoration:none; color:#000;">
                                    <div style="padding: 3px;">
                                        <strong>Visits
                                            <span style="float: right; background-color:#ecf0f1; padding:5px;">
                                                <?php
                                                if (isset($_GET['uryyTteamoeSS4'])) {
                                                    $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                                                    $result = "SELECT * FROM tbl_schedule_calls WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ";
                                                    if ($result = mysqli_query($conn, $result)) {
                                                        $rowcount = mysqli_num_rows($result);
                                                        printf($rowcount);
                                                        mysqli_free_result($result);
                                                    }
                                                }

                                                ?>
                                            </span></strong>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-12 col-2">
                        <?php
                        if (isset($_GET['uryyTteamoeSS4'])) {
                            $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE uryyTteamoeSS4='$uryyTteamoeSS4' AND call_status = 'Action needed' ORDER BY userId DESC LIMIT 1 ");
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <a href="./client-notes<?php echo "?uryyTteamoeSS4=" . $row['uryyTteamoeSS4'] . "";
                                                    }
                                                } ?>" style="text-decoration:none; color:#000;">
                                    <div style="padding: 3px;">
                                        <strong>Notes
                                            <span style="float: right; background-color:#ecf0f1; padding:5px;">
                                                <?php
                                                if (isset($_GET['uryyTteamoeSS4'])) {
                                                    $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                                                    $result = "SELECT * FROM tbl_client_notes WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ";
                                                    if ($result = mysqli_query($conn, $result)) {
                                                        $rowcount = mysqli_num_rows($result);
                                                        printf($rowcount);
                                                        mysqli_free_result($result);
                                                    }
                                                }

                                                ?>
                                            </span></strong>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-12 col-2">
                        <a href="" style="text-decoration:none; color:#000;">
                            <div style="padding: 3px;">
                                <hr>
                                <strong>Actions</strong>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-10">
                <a href="./manage-runs" style="text-decoration: none;">
                    <button class="btn btn-small btn-primary">Add new +</button>
                </a>
                <hr>
                <div class="row">

                    <!-- Clients feed, team member start -->
                    <?php
                    if (isset($_GET['uryyTteamoeSS4'])) {
                        $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                        $result = mysqli_query($conn, "SELECT * FROM tbl_daily_shift_records WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ");
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                            
                            <div class='col-xl-6'>
                                <a href='./view-client-feed?userId=" . $row['userId'] . "' style='text-decoration:none; color:#000;'>
                                    <div class='card table-card'>
                                        <div class='card-header'>
                                            <h5><i class='feather mr-2 icon-briefcase'></i> &nbsp; Attempted</h5>
                                            <span style='position:absolute; right:20px; font-weight:16px;'><i class='feather mr-2 icon-clock'></i> " . $row['shift_start_time'] . "</span>
                                        </div>
                                        <div class='card-body p-0'>
                                            <div style='width:100%; height:auto; padding:8px 0px 8px 22px; font-size:16px;'>
                                                <h6>Care team</h6>
                                                <span style='font-weight:22px;'><i class='feather mr-2 icon-user'></i> " . $row['team_1Name'] . " </span> | <span style='font-weight:22px;'>" . $row['team_2Name'] . " </span>
                                            </div>
                                            <div style=' width: 100%; height:auto; padding:8px; background-color:#16a085; color:#fff;'>
                                                <span style='font-weight:22px;'><i class='feather mr-2 icon-check-square'></i> Attempted </span> <span style='font-weight:22px; position:absolute; right:10px;'><i class='feather mr-2 icon-calendar'></i>" . $row['shift_date'] . "</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ";
                        }
                    } ?>
                </div>


                <br>
                <br>
            </div>
        </div>

        <div class="row">
            <?php include('bottom-panel-block.php'); ?>
        </div>

        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>




<?php include('footer-contents.php'); ?>