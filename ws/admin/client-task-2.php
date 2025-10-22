<?php include('client-header-contents.php'); ?>


<?php
include('dbconnect.php');

if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
    //change this line in your query as well
    $result = mysqli_query($myConnection, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4'");
    while ($row = mysqli_fetch_array($result)) {
?>


        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Schedule client task(s)</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!"><?php echo "" . $row['client_first_name'] . " " . $row['client_last_name'] . "" ?></a></li>
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
                                <h5>Client tasks</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                        <div class="row">
                                            <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                                Client task already exist!!!
                                            </div>
                                            <div class="col-md-4">


                                                <form method="POST" action="./client-task?uryyToeSS4=<?php echo "" . $row['uryyToeSS4'] . ""; ?>" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                                                    <div class="form-group">

                                                        <input type="hidden" name="txtClientSocialId" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                                                            }
                                                                                                        } ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Select task</label>
                                                        <select name="txtTask" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <?php
                                                            include('dbconnect.php');

                                                            //change this line in your query as well
                                                            $result = mysqli_query($myConnection, "SELECT * FROM tbl_task_list ");
                                                            while ($trans = mysqli_fetch_array($result)) {
                                                                echo "
                                                                <option value='" . $trans['task_title'] . "'>" . $trans['task_title'] . "</option>
                                                                ";
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Add details(optional)</h5>
                                                        <label for="exampleFormControlTextarea1">The carer will see this note in the app each time they complete this task.</label>
                                                        <textarea name="txtTaskDetails" class="form-control" placeholder="Highlights" required id="exampleFormControlHighlights" rows="5"></textarea>
                                                    </div>


                                                    <br>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Select frequency <span style="color: red;">*</span></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#" role="tab" aria-controls="home" aria-selected="true">Daily</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Weekly</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                        <div class="row">

                                                                            <div class="col">
                                                                                <input name="txtMorning" value="Morning" type="checkbox" class="" id="customswitch1">
                                                                                <span style="font-size:13px;">Mrning</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtLunch" value="Lunch" type="checkbox" class="" id="customswitch2">
                                                                                <span style="font-size:13px;">Lunch</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtTea" value="Tea" type="checkbox" class="" id="customswitch3">
                                                                                <span style="font-size:13px;">Tea</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtBed" value="Bed" type="checkbox" class="" id="customswitch4">
                                                                                <span style="font-size:13px;">Bed</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <input name="txtMonday" value="M" type="checkbox" class=" " id="customswitch5">
                                                                                <span style="font-size:13px;">Mo</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtTuesday" value="T" type="checkbox" class=" " id="customswitch6">
                                                                                <span style="font-size:13px;">Tu</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtWednesday" value="W" type="checkbox" class=" " id="customswitch7">
                                                                                <span style="font-size:13px;">We</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtThursday" value="T" type="checkbox" class=" " id="customswitch8">
                                                                                <span style="font-size:13px;">Th</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtFriday" value="F" type="checkbox" class=" " id="customswitch9">
                                                                                <span style="font-size:13px;">Fri</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtSaturday" value="S" type="checkbox" class=" " id="customswitch10">
                                                                                <span style="font-size:13px;">Sat</span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input name="txtSunday" value="S" type="checkbox" class=" " id="customswitch11">
                                                                                <span style="font-size:13px;">Sun</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Select time<span style="color: red;">*</span></h5>
                                                        <div class="custom-control custom-switch">
                                                            <input name="txtAnytimeSession" type="checkbox" class="custom-control-input" id="customswitch12">
                                                            <label class="custom-control-label" for="customswitch12">Anytime / Sessions</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputStarts1">Starts<span style="color: red;">*</span><br>The first task will be on the selected date.</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                                    <img src="assets/images/icons/pngtree-calendar-icon-logo-2023-date-time-png-image_6310337.png" style="width: 20px; height:20px;" alt="">
                                                                </span>
                                                            </div>
                                                            <input type="date" required name="txtStarts" class="form-control" id="exampleInputStarts" aria-describedby="StartDate" placeholder="Starts">
                                                            <div class="invalid-tooltip">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-grou">
                                                        <input type="hidden" value="<?php
                                                                                    $currentDate = date('F j, Y');
                                                                                    echo $currentDate; ?>" name="current_Date">

                                                        <input type="hidden" value="<?php echo date("h:i a"); ?>" name="current_Time">
                                                    </div>

                                                    <button type="submit" name="btnSubmitClientTast" class="btn  btn-primary">Upload task</button>


                                                </form>
                                            </div>

                                            <div class="col-md-8">

                                                <h4>Tasks</h4>
                                                <br>

                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>My task record</h5>
                                                        <div class="card-header-right">
                                                            <div class="btn-group card-option">
                                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="feather icon-more-horizontal"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tasks</th>
                                                                        <th>When</th>
                                                                        <th>Frequency</th>
                                                                        <th>From until</th>
                                                                        <th class="text-right">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    include('dbconnect.php');

                                                                    if (isset($_GET['uryyToeSS4'])) {
                                                                        $uryyToeSS4 = $_GET['uryyToeSS4'];
                                                                        //change this line in your query as well
                                                                        $result = mysqli_query($myConnection, "SELECT * FROM tbl_clients_task_records WHERE uryyToeSS4='$uryyToeSS4'");
                                                                        while ($row = mysqli_fetch_array($result)) {
                                                                            echo "
                                                   

                                                            <tr>
                                                                <td>

                                                                    <div class='d-inline-block align-middle'>
                                                                        <div class='d-inline-block'>
                                                                            <h6>" . $row['client_taskName'] . "</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span style='height: 20px; width:20px; padding:3px; background-color:rgba(46, 204, 113,1.0); color:white; font-size:18px;'>" . $row['monday'] . "</span>
                                                                    <span style='height: 20px; width:20px; padding:3px; background-color:rgba(46, 204, 113,1.0); color:white; font-size:18px;'>" . $row['tuesday'] . "</span>
                                                                    <span style='height: 20px; width:20px; padding:3px; background-color:rgba(46, 204, 113,1.0); color:white; font-size:18px;'>" . $row['wednesday'] . "</span>
                                                                    <span style='height: 20px; width:20px; padding:3px; background-color:rgba(46, 204, 113,1.0); color:white; font-size:18px;'>" . $row['thursday'] . "</span>
                                                                    <span style='height: 20px; width:20px; padding:3px; background-color:rgba(46, 204, 113,1.0); color:white; font-size:18px;'>" . $row['friday'] . "</span>
                                                                    <span style='height: 20px; width:20px; padding:3px; background-color:rgba(46, 204, 113,1.0); color:white; font-size:18px;'>" . $row['saturday'] . "</span>
                                                                    <span style='height: 20px; width:20px; padding:3px; background-color:rgba(46, 204, 113,1.0); color:white; font-size:18px;'>" . $row['sunday'] . "</span>
                                                                </td>
                                                                <td>" . $row['frequency'] . "</td>
                                                                <td>" . $row['task_startDate'] . "</td>
                                                                <td class='text-right'>
                                                                <a style='text-decoration:none;' href='./delete-client-task?client_Id=" . $row['client_Id'] . "'> <button title='Delete client medicine' type='button' class='btn  btn-danger btn-sm'>Delete</button> </a>
                                                                </td>
                                                            </tr>
                                                            ";
                                                                        }
                                                                    } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
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