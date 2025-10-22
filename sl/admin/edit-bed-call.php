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
                            <h5 class="m-b-10">Edit care call <br>
                                <?php
                                if (isset($_GET['uryyToeSS4'])) {
                                    $uryyToeSS4 = $_GET['uryyToeSS4'];
                                    $getClientName = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE uryyToeSS4 = '$uryyToeSS4' GROUP BY client_name ");
                                    while ($rowClientName = mysqli_fetch_array($getClientName)) {
                                        $ClientNameHere = $rowClientName['client_name'];
                                        echo "
                                <small>Re-assign $ClientNameHere Bed call</small>
                                ";
                                    }
                                }
                                ?>
                            </h5>
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
                        <h5>Re-Schedule</h5>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                <!--<div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(39, 174, 96,1.0); color:white;">
                                    The selected carer is occupied.
                                </div>-->
                                <div class="row">
                                    <div class="col-md-5">

                                        <?php
                                        if (isset($_GET['uryyToeSS4'])) {
                                            $uryyToeSS4 = $_GET['uryyToeSS4'];
                                        }

                                        ?>

                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home"><strong>Re-Assign Call</strong></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#menu1"><strong>Cancel Call</strong></a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div id="home" class="container tab-pane active"><br>
                                                <h5>Re-Assign Call</h5>
                                                <p>
                                                <form method="POST" action="./processing-edit-morning-call" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                                                    <input type='hidden' name='txtClientSpecialId' value='<?php echo $uryyToeSS4 ?>' />

                                                    <br>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1"><strong>Select New carer</strong><span style="color: red;">*</span></label>
                                                        <select name="txtNewCarer" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <?php
                                                            //change this line in your query as well
                                                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls GROUP BY first_carer ");
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "
                                                                    <option value='" . $row['first_carer_Id'] . "'>" . $row['first_carer'] . "</option>
                                                                    ";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1"><strong>Select current carer</strong><span style="color: red;">*</span></label>
                                                        <select name="txtCurrentCarer" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <?php
                                                            //change this line in your query as well
                                                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls GROUP BY first_carer ");
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "
                                                                    <option value='" . $row['first_carer_Id'] . "'>" . $row['first_carer'] . "</option>
                                                                    ";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Shift date">Date<span style="color: red;">*</span></label>
                                                                <input type="date" name="txtShiftDate" class="form-control" min="2024-01-01" max="2030-12-31" required placeholder="Date" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="form-group">
                                                        <button type="submit" name="btnReScheduleRuns" class="btn  btn-primary">Re-schedule</button>
                                                    </div>
                                                </form>
                                                </p>
                                            </div>
                                            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                                            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                                            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                                            <div id="menu1" class="container tab-pane fade"><br>
                                                <h5>Cancel Call</h5>
                                                <p>
                                                <form method="POST" action="./processing-cancel-bed-call" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                                                    <input type='hidden' name='txtClientSpecialId' value='<?php echo $uryyToeSS4 ?>' />

                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1"><strong>Select carer</strong><span style="color: red;">*</span></label>
                                                        <select name="txtFirstCarer" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <?php
                                                            //change this line in your query as well
                                                            $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls GROUP BY first_carer ");
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "
                                                                <option value='" . $row['first_carer_Id'] . "'>" . $row['first_carer'] . "</option>
                                                                ";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <!--<div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <span for="exampleFormControlSelect1" style="color: green; font-size:18px;">Double call &nbsp;</span>
                                                                <input type="checkbox" name="itemid" id="" class="check item">
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <br>
                                                                <div class="form-group cost-box">
                                                                    <div class="form-line">
                                                                        <label for="exampleFormControlSelect1"><strong>Select second carer</strong><span style="color: red;">*</span></label>
                                                                        <select name="txtSecondCarer" required class="form-control" id="exampleFormControlSelect1">
                                                                            <option value="Single run" selected="selected" disabled="disabled">--Select Option--</option>
                                                                            <?php
                                                                            //change this line in your query as well
                                                                            //$result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form ");
                                                                            //while ($row = mysqli_fetch_array($result)) {
                                                                            //echo "
                                                                            //<option value='" . $row['uryyTteamoeSS4'] . "'>" . $row['team_first_name'] . " " . $row['team_last_name'] . "</option>
                                                                            //";
                                                                            //}
                                                                            //
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->

                                                    <div style="margin-top: -12px;" class="form-group">
                                                        <label for="exampleFormControlSelect1"><strong>Reason</strong><span style="color: red;">*</span></label>
                                                        <select name="txtReason" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="Family Outing">Family Outing</option>
                                                            <option value="Personal Outing">Personal Outing</option>
                                                            <option value="In Hospital">In Hospital</option>
                                                            <option value="Family Gathering">Family Gathering</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Shift date">Date<span style="color: red;">*</span></label>
                                                                <input type="date" name="txtShiftDate" class="form-control" min="2024-01-01" max="2030-12-31" required placeholder="Date" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>


                                                    <?php
                                                    require_once('dbconnections.php');

                                                    for ($a = 1; $a <= 50; $a++) {
                                                        $usdd = "0";
                                                        $rand1 = rand(0000, 9999);
                                                        $rand2 = rand(0000, 9999);
                                                        $rand3 = rand(0000, 9999);
                                                        $ud = "45";
                                                        $id = "$usdd$rand1$rand2$rand3$ud";
                                                    }

                                                    ?> <input type="hidden" value="<?php echo $id; ?>" name="mySpecialId" />

                                                    <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />

                                                    <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="txtCurrentDate">


                                                    <div class="form-group">
                                                        <button type="submit" name="btnCancelCall" class="btn  btn-primary">Cancel call</button>
                                                    </div>
                                                </form>
                                                </p>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="col-md-7">

                                        <h5>List of carers</h5>
                                        <br>
                                        <div class="row">

                                            <?php
                                            //change this line in your query as well
                                            $result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "
                                                <div class='col-sm-6'>
                                                    <button style='width:100%;' type='button' class='btn btn-outline-secondary'>" . $row['team_first_name'] . " " . $row['team_last_name'] . "</button>
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