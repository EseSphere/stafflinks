<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <?php
        if (isset($_GET['uryyToeSS4'])) {
            $uryyToeSS4 = $_GET['uryyToeSS4'];
        }
        $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE uryyToeSS4='$uryyToeSS4' AND call_status = 'Scheduled' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY userId DESC LIMIT 1 ");
        $row = mysqli_fetch_array($result);
        $clientName = $row['client_name'];
        ?> <br>
        <h4>Alerts feeds <br><small style="font-weight: 600;"><?php echo $clientName; ?>
                (<?php
                    $result = "SELECT * FROM tbl_schedule_calls WHERE uryyToeSS4='$uryyToeSS4' AND call_status = 'Scheduled' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ";
                    if ($result = mysqli_query($conn, $result)) {
                        $rowcount = mysqli_num_rows($result);
                        printf($rowcount);
                        mysqli_free_result($result);
                    } ?>)
            </small></h4>

        <br>
        <div class="row">
            <div class="col-12">
                <a href="./manage-runs" style="text-decoration: none;">
                    <button class="btn btn-small btn-primary">Add new run</button>
                </a>
                <input class="btn btn-secondary" type="button" value="Download file" onclick="PrintElem('#yourdiv')" />

                <div id="yourdiv">
                    <div class="row">

                        <!-- Clients feed, team member start -->
                        <?php
                        $date_query = mysqli_query($conn, "SELECT DISTINCT(DATE(Clientshift_Date)) AS ClientshifTd FROM tbl_schedule_calls order by Clientshift_Date asc");
                        while ($row = mysqli_fetch_array($date_query)) {
                            echo "
                            <hr>
                            <h5>
                                <strong>
                                    <i class='feather mr-2 icon-calendar'></i>" . date('d M, Y', strtotime("" . $row['ClientshifTd'] . "")) . ",
                                    " . date('l', strtotime("" . $row['ClientshifTd'] . "")) . "
                                </strong>
                            </h5>";

                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE (DATE(Clientshift_Date) = '" . $row['ClientshifTd'] . "' AND uryyToeSS4='$uryyToeSS4' AND call_status = 'Scheduled' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY Clientshift_Date DESC ");
                            while ($row = mysqli_fetch_array($result)) {
                                $clientVisitDate = date('d M, Y', strtotime("" . $row['Clientshift_Date'] . ""));
                                echo "
                            
                            <div class='col-xl-4'>
                                <a href='./view-alerts-feed?userId=" . $row['userId'] . "' style='text-decoration:none; color:#000;'>
                                    <div class='card table-card'>
                                        <div class='card-header'>
                                            <h5><i class='feather mr-2 icon-briefcase'></i> &nbsp; Scheduled</h5>
                                            <span style='position:absolute; right:20px; font-weight:16px;'><i class='feather mr-2 icon-clock'></i> " . $clientVisitDate . "</span>
                                        </div>
                                        <div class='card-body p-0'>
                                            <div style='width:100%; height:auto; padding:8px 0px 8px 22px; font-size:16px;'>
                                                <h6><strong>Planned time</strong></h6>
                                                <table style='border:none;'>
                                                                        <tr>
                                                                             <td>
                                                                                <h6>Time in</h6>
                                                                            </td>
                                                                            <td style='padding: 0px 0px 0px 35px;'>
                                                                                <h6>Time out</h6>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <span style='font-weight:22px;'><i class='feather mr-2 icon-clock'></i> " . $row['dateTime_in'] . " </span>
                                                                            </td>
                                                                            <td style='padding: 0px 0px 0px 35px;'>
                                                                                <span style='font-weight:22px;'><i class='feather mr-2 icon-clock'></i> " . $row['dateTime_out'] . " </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>   
                                            </div>
                                            <div style=' width: 100%; height:auto; padding:8px; background-color:rgba(25, 42, 86,1.0); color:#fff;'>
                                                <span style='font-weight:22px;'><i class='feather mr-2 icon-check-square'></i> Scheduled </span> <span style='font-weight:22px; position:absolute; right:10px;'><i class='feather mr-2 icon-calendar'></i>" . $row['Clientshift_Date'] . "</span>
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



        </div>






        <div class="row">
            <?php include('bottom-panel-block.php'); ?>
        </div>

        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>




<?php include('footer-contents.php'); ?>