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
                        $sel_client_time = mysqli_query($myConnection, "SELECT DISTINCT client_schedule_start_time FROM tbl_general_client_form ");
                        while ($row = mysqli_fetch_array($sel_client_time)) {
                            echo "
                        <th>" . $row['client_schedule_start_time'] . "</th>
                        ";
                        }
                        ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include('dbconnect.php');

                    $sel_dist_att = mysqli_query($myConnection, "SELECT DISTINCT team_name FROM tbl_general_client_form WHERE team_name != '' ");
                    ?>

                    <?php
                    while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
                        $db_worker_name = $att_rw['team_name'];
                    ?>
                        <tr>
                            <td><?= $db_worker_name ?></td>

                            <?php
                            $sel_corr_data = mysqli_query($myConnection, "SELECT * FROM tbl_general_client_form WHERE team_name = '$db_worker_name' ");

                            while ($att_cor_rw = mysqli_fetch_array($sel_corr_data)) {
                            ?>
                                <td>
                                    <button class="btn btn-primary">
                                        <?= $att_cor_rw["client_first_name"] . " " . $att_cor_rw["client_last_name"] . "<br/>
                                        <span style='font-size:12px;'>" . $att_cor_rw["client_schedule_start_time"] . "-" . $att_cor_rw["client_schedule_end_time"] . "</span>" ?>
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