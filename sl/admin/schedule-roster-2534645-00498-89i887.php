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
                            <h5 class="m-b-10">Schedule roster</h5>
                        </div>

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
                        <h5>Schedule</h5>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <form method="POST" action="./processing-schedule-roster-backup" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                                            <?php
                                            //change this line in your query as well
                                            $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_carers_account WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                            while ($sel_team_data_row = mysqli_fetch_array($sel_team_data_result)) {
                                            } ?>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Select first carer<span style="color: red;">*</span></label>
                                                <select name="txtFirstCarer" required class="form-control" id="exampleFormControlSelect1">
                                                    <option value="" selected="selected" disabled="disabled">--Select First Carer--</option>
                                                    <?php
                                                    //change this line in your query as well
                                                    $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY team_first_name ASC ");
                                                    while ($sel_team_data_row = mysqli_fetch_array($sel_team_data_result)) {
                                                        echo "
                                                        <option value='" . $sel_team_data_row['uryyTteamoeSS4'] . "'>" . $sel_team_data_row['team_first_name'] . " " . $sel_team_data_row['team_last_name'] . "</option>
                                                        ";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <hr>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <span for="exampleFormControlSelect1" style="color: green; font-size:18px;">Double call &nbsp;</span>
                                                        <input type="checkbox" name="itemid" id="txtHidenShowTxt" class="check item">
                                                    </div>
                                                    <div id="form-line" class="col-sm-12">
                                                        <br>
                                                        <div class="form-group cost-box">
                                                            <div class="form-line">
                                                                <select name="txtSecondCarer" required class="form-control" id="exampleFormControlSelect1">
                                                                    <option value="Double run" selected="selected" disabled="disabled">--Select Second Carer--</option>
                                                                    <?php
                                                                    //change this line in your query as well
                                                                    $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY team_first_name ASC");
                                                                    while ($sel_team_data_row = mysqli_fetch_array($sel_team_data_result)) {
                                                                        echo "

                                                                    <option value='" . $sel_team_data_row['uryyTteamoeSS4'] . "'>" . $sel_team_data_row['team_first_name'] . " " . $sel_team_data_row['team_last_name'] . "</option>
                                                                    ";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!--<select name="txtSecondCarer" required class="form-control" id="exampleFormControlSelect1">
                                                        <option value="Single run" selected="selected" disabled="disabled">--Select Option--</option>
                                                        <?php
                                                        //change this line in your query as well
                                                        //$result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form ");
                                                        //while ($row = mysqli_fetch_array($result)) {
                                                        //echo "

                                                        //<option value='" . $row['uryyTteamoeSS4'] . "'>" . $row['team_first_name'] . " " . $row['team_last_name'] . "</option>

                                                        //";
                                                        //}
                                                        ?>
                                                    </select>-->

                                            </div>

                                            <hr>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Select Group<span style="color: red;">*</span></label>
                                                <select name="txtClientGroup" required class="form-control" id="exampleFormControlSelect1">
                                                    <option value="Single run" selected="selected" disabled="disabled">--Select Option--</option>
                                                    <?php
                                                    //change this line in your query as well
                                                    $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_client_runs WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' GROUP BY run_name ");
                                                    while ($sel_team_data_row = mysqli_fetch_array($sel_team_data_result)) {
                                                        echo "
                                                        <option value='" . $sel_team_data_row['run_ids'] . "'>" . $sel_team_data_row['run_name'] . "</option>
                                                        ";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Shift date">Date<span style="color: red;">*</span></label>
                                                        <input type="date" name="txtShiftDate" class="form-control" min="1997-01-01" max="2030-12-31" required placeholder="Date" />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div style="width: 100%; height:auto; padding:22px;">
                                                <h6><i class="feather icon-repeat"></i> Would you like to repeat this routine?</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input name="txtNextWeeksTrue" type="checkbox" value="twoWeeksTrue" class="custom-control-input" id="customControlValidation5">
                                                            <label class="custom-control-label" for="customControlValidation5">&nbsp; &nbsp; &nbsp; &nbsp; Next Week</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input name="txtNexttwoWeeksTrue" type="checkbox" value="twoWeeksTrue" class="custom-control-input" id="customControlValidation6">
                                                            <label class="custom-control-label" for="customControlValidation6">&nbsp; &nbsp; &nbsp; &nbsp; Two Week</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Select care calls</h5>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-4 col-4">
                                                    <div class=" form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input name="txtHalfDay" type="checkbox" value="Morning" class="custom-control-input" id="customControlValidation1">
                                                            <label class="custom-control-label" for="customControlValidation1">&nbsp; &nbsp; &nbsp; &nbsp; Half day</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-4">
                                                    <div class=" form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input name="txtLateCalls" type="checkbox" value="Lunch" class="custom-control-input" id="customControlValidation2">
                                                            <label class="custom-control-label" for="customControlValidation2">&nbsp; &nbsp; &nbsp; &nbsp; Late calls</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-4">
                                                    <div class=" form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input name="txtAllDay" type="checkbox" value="Tea" class="custom-control-input" id="customControlValidation3">
                                                            <label class="custom-control-label" for="customControlValidation3">&nbsp; &nbsp; &nbsp; &nbsp; All day</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="col-md-6 col-6">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input name="txtSupportCalls" type="checkbox" value="Support" class="custom-control-input" id="customControlValidation4">
                                                            <label class="custom-control-label" for="customControlValidation4">&nbsp; &nbsp; &nbsp; &nbsp; Suport work</label>
                                                        </div>
                                                    </div>
                                                </div>-->
                                            </div>


                                            <!--<div class="form-group">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input name="txtBedCalls" type="checkbox" value="Bed" class="custom-control-input" id="customControlValidation4">
                                                    <label class="custom-control-label" for="customControlValidation4">&nbsp; &nbsp; &nbsp; &nbsp; Bed Calls</label>
                                                </div>
                                            </div>-->

                                            <hr>

                                            <?php
                                            for ($a = 1; $a <= 50; $a++) {
                                                $usdd = "0";
                                                $rand1 = rand(0000, 9999);
                                                $rand2 = rand(0000, 9999);
                                                $rand3 = rand(0000, 9999);
                                                $rand4 = rand(0000, 9999);
                                                $rand5 = rand(0000, 9999);
                                                $rand6 = rand(0000, 9999);
                                                $ud = "RS2";
                                                $id = "$usdd$rand1$rand2$rand3$rand4$rand5$rand6$ud";
                                            }
                                            // Return current date from the remote server
                                            ?> <input type="hidden" value="02c<?php echo $id; ?>" name="carecallID" />


                                            <!--Weekly id for separations-->
                                            <input type="hidden" value="firstAttemptone<?php echo $id; ?>" name="firstAttempId" />
                                            <input type="hidden" value="Weekione<?php echo $id; ?>" name="weekoneId" />
                                            <input type="hidden" value="Weekitwo<?php echo $id; ?>" name="weektwoId" />

                                            <div class="form-group">
                                                <button type="submit" name="btnScheduleRuns" class="btn  btn-primary">Schedule run</button>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="col-md-7">

                                        <h5>List of carers</h5>
                                        <br>
                                        <div class="row">

                                            <?php
                                            //change this line in your query as well
                                            $sel_general_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY team_first_name ASC ");
                                            while ($sel_general_team_data_row = mysqli_fetch_array($sel_general_team_data_result)) {
                                                echo "
                                                <div class='col-sm-6'>
                                                    <button style='width:100%;' type='button' class='btn btn-outline-secondary'>" . $sel_general_team_data_row['team_first_name'] . " " . $sel_general_team_data_row['team_last_name'] . "</button>
                                                    <br><br>
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
            </div>


            <?php include('bottom-panel-block.php'); ?>


        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>