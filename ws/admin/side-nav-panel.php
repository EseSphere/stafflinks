<div class="col-2">
    <div class="row">
        <div class="col-md-12 col-2">
            <a href="./client-feed?uryyToeSS4=<?php echo $uryyToeSS4; ?>" style="text-decoration:none; color:#000;">
                <div style="padding: 3px;">
                    <strong>Completed
                        <span style="float: right; background-color:#ecf0f1; padding:5px;">
                            <?php
                            $result = "SELECT * FROM tbl_daily_shift_records WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
                            if ($result = mysqli_query($conn, $result)) {
                                $rowcount = mysqli_num_rows($result);
                                printf($rowcount);
                                mysqli_free_result($result);
                            } ?>
                        </span></strong>
                </div>
            </a>
        </div>
        <div class="col-md-12 col-2">
            <a href="./alerts-feeds?uryyToeSS4=<?php echo $uryyToeSS4; ?>" style="text-decoration:none; color:#000;">
                <div style="padding: 3px;">
                    <strong>Scheduled
                        <span style="float: right; background-color:#ecf0f1; padding:5px;">
                            <?php
                            $result = "SELECT * FROM tbl_schedule_calls WHERE uryyToeSS4='$uryyToeSS4' AND call_status = 'Scheduled' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
                            if ($result = mysqli_query($conn, $result)) {
                                $rowcount = mysqli_num_rows($result);
                                printf($rowcount);
                                mysqli_free_result($result);
                            } ?>


                        </span></strong>
                </div>
            </a>
        </div>
        <div class="col-md-12 col-2">
            <a href="./client-visit?uryyToeSS4=<?php echo $uryyToeSS4; ?>" style="text-decoration:none; color:#000;">
                <div style="padding: 3px;">
                    <strong>Visits
                        <span style="float: right; background-color:#ecf0f1; padding:5px;">
                            <?php
                            $result = "SELECT * FROM tbl_schedule_calls WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
                            if ($result = mysqli_query($conn, $result)) {
                                $rowcount = mysqli_num_rows($result);
                                printf($rowcount);
                                mysqli_free_result($result);
                            } ?>
                        </span></strong>
                </div>
            </a>
        </div>
        <div class="col-md-12 col-2">
            <a href="./client-notes?uryyToeSS4=<?php echo $uryyToeSS4; ?>" style="text-decoration:none; color:#000;">
                <div style="padding: 3px;">
                    <strong>Notes
                        <span style="float: right; background-color:#ecf0f1; padding:5px;">
                            <?php
                            $result = "SELECT * FROM tbl_client_notes WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
                            if ($result = mysqli_query($conn, $result)) {
                                $rowcount = mysqli_num_rows($result);
                                printf($rowcount);
                                mysqli_free_result($result);
                            } ?>
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