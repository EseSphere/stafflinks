<?php include('header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div style="width:100%; height:100%; background-color:none; background-image:url();">
            <table border="1" class="table table-condensed">


                <thead>
                    <tr>
                        <th>Team members</th>
                        <?php
                        include('dbconnect.php');
                        $sel_client_time = mysqli_query($myConnection, "SELECT * FROM timeline_schedule GROUP BY time_in ORDER BY time_in");
                        while ($row = mysqli_fetch_array($sel_client_time)) {
                            $db_worker_timeIn = $row['time_in'];
                            echo "
                        <th>" . $row['time_in'] . "</th>
                        ";
                        }
                        ?>
                    </tr>
                </thead>



                <tbody>
                    <?php
                    $sel_dist_att = mysqli_query($myConnection, "SELECT DISTINCT carerName FROM timeline_schedule WHERE carerName != '' ");
                    ?>

                    <?php
                    while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
                        $db_worker_name = $att_rw['carerName'];
                    ?>

                        <tr>
                            <td style="font-size:16px;"><strong><?= $db_worker_name ?></strong></td>

                            <?php
                            $sel_corr_data = mysqli_query($conn, "SELECT * FROM timeline_schedule WHERE carerName = '$db_worker_name' ");
                            while ($att_cor_rw = mysqli_fetch_array($sel_corr_data)) {
                            ?>
                                <td>
                                    <button class="btn btn-primary">
                                        <?= $att_cor_rw["clientName"] ?>
                                    </button>
                                </td>
                            <?php
                            }
                            ?>

                        </tr>

                    <?php
                    }

                    ?>
                    </tr>
                </tbody>

            </table>
        </div>

        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>

<?php include('footer-contents.php'); ?>