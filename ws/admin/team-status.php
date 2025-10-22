<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Carer Status</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <div style="font-size:18px;"><span style="color:red;"><strong>Note:</strong></span> Your action is going to de-activate this carer. Be sure you want to proceed with this action.</div>
                        <hr style="background-color: rgba(149, 165, 166,.7);">
                        <p class="card-text" style="font-size: 16px;">Select option</p>
                        </p>
                        <?php
                        if (isset($_GET['uryyTteamoeSS4'])) {
                            $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                            $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ORDER BY userId DESC LIMIT 1");
                            while ($sel_team_data_row = mysqli_fetch_array($sel_team_data_result)) {
                        ?>

                                <form action="./processing-team-status" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                    <div class="form-group">
                                        <input type="hidden" name="txtFirstName" value="<?php echo "" . $sel_team_data_row['team_first_name'] . ""; ?>" />
                                        <input type="hidden" name="txtLastName" value="<?php echo "" . $sel_team_data_row['team_last_name'] . ""; ?>" />
                                        <input type="hidden" name="teamSpecialId" value="<?php echo "" . $sel_team_data_row['uryyTteamoeSS4'] . "";
                                                                                        }
                                                                                    } ?>" />

                                        <select style="height:50px;" name="txtTeamStatus" class="form-control" required id="">
                                            <option value="--Select options--">--Select options--</option>
                                            <option value="Currently active">Need care</option>
                                            <option value="Hospitalized">Hospitalized</option>
                                            <option value="On a trip">On a trip</option>
                                            <option value="With family">With family</option>
                                            <option value="Annual Leave (Holiday Entitlement)">Annual Leave (Holiday Entitlement)</option>
                                            <option value="Bank Holidays">Bank Holidays</option>
                                            <option value="Casual Leave">Casual Leave</option>
                                            <option value="Compassionate Leave (Bereavement Leave)">Compassionate Leave (Bereavement Leave)</option>
                                            <option value="Duvet Day">Duvet Day</option>
                                            <option value="Gardening Leave">Gardening Leave</option>
                                            <option value="Maternity Leave (Parental Leave)">Maternity Leave (Parental Leave)</option>
                                            <option value="Paid Time Off (PTO)">Paid Time Off (PTO)</option>
                                            <option value="Sabbatical Leave">Sabbatical Leave</option>
                                            <option value="Sick Leave">Sick Leave</option>
                                            <option value="Time Off In Lieu (TOIL) Leave">Time Off In Lieu (TOIL) Leave</option>
                                            <option value="Unpaid Leave">Unpaid Leave</option>
                                            <option value="Miscellaneous Leave">Miscellaneous Leave</option>
                                            <option value="None">None</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <button class="btn btn-danger" name="btnTeamStatus" type="submit">Yes am sure!</button>
                                    <a href="./team-list" style="text-decoration: none;" class="btn btn-primary">Team list</a>
                                </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>