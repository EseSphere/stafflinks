<?php include('client-header-contents.php'); ?>


<style>
    ul {
        list-style: none;
    }

    /*Selection for type*/
    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }
</style>



<?php
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
    //change this line in your query as well
    $result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
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
                                    <h5 class="m-b-10">Plan medication(s)</h5>
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
                                <h5>Create a schedule to match <?php echo "" . $row['client_first_name'] . "" ?>'s prescription.</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                        <div class="row">
                                            <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                                Medication already exist!!!
                                            </div>


                                            <div class="col-md-5">


                                                <form method="POST" action="./client-extra-tea-medication?uryyToeSS4=<?php echo "" . $row['uryyToeSS4'] . ""; ?>" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                                                    <div class="form-group">

                                                        <input type="hidden" name="txtClientSocialId" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                                                            }
                                                                                                        } ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Select Medicine<span style="color: red;">*</span></label>
                                                        <div>
                                                            <input type="text" name="txtMedName" required class="form-control" id="input" placeholder="Type a medicine here..." />
                                                        </div>
                                                        <ul class="list"></ul>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-7 col-7">
                                                                <label for="exampleInputPassword1">Select dosage<span style="color: red;">*</span></label>
                                                                <input placeholder="Select/type dosage here..." list="browsers" name="txtMedDosage" required class="form-control" id="exampleFormControlSelect1" />
                                                                <datalist id="browsers">
                                                                    <?php
                                                                    $result = mysqli_query($conn, "SELECT * FROM tbl_medication_list GROUP BY med_dosage ");
                                                                    while ($trans = mysqli_fetch_array($result)) {
                                                                        echo "
                                                                            <option value='" . $trans['med_dosage'] . "'>" . $trans['med_dosage'] . "</option>
                                                                            ";
                                                                    } ?>
                                                                </datalist>
                                                            </div>
                                                            <div class="col-md-5 col-5">
                                                                <label for="exampleInputPassword1">Select type<span style="color: red;">*</span></label>
                                                                <input list="select" placeholder="Select type here..." name="txtMedType" required class="form-control">
                                                                <datalist id="select">
                                                                    <?php
                                                                    $result = mysqli_query($conn, "SELECT * FROM tbl_medication_list GROUP BY med_type ");
                                                                    while ($trans = mysqli_fetch_array($result)) {
                                                                        echo "
                                                                            <option value='" . $trans['med_type'] . "'>" . $trans['med_type'] . "</option>
                                                                        ";
                                                                    } ?>

                                                                </datalist>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--<div class="form-group">
                                                        <label for="exampleInputPassword1">Frequency<span style="color: red;">*</span></label>
                                                        <select name="txtMedFrequency" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value='1 Daily'>1 Daily</option>
                                                            <option value='2X Daily'>2X Daily</option>
                                                            <option value='3X Daily'>3X Daily</option>
                                                            <option value='4X Daily'>4X Daily</option>
                                                            <option value='5X Daily'>5X Daily</option>
                                                            <option value='6X Daily'>6X Daily</option>
                                                            <option value='As required'>As required</option>
                                                            <option value='1 Tablet Daily'>1 Tablet Daily</option>
                                                            <option value='2 Tablets Daily'>2 Tablets Daily</option>
                                                            <option value='3 Tablets Daily'>3 Tablets Daily</option>
                                                            <option value='4 Tablets Daily'>4 Tablets Daily</option>
                                                            <option value='5 Tablets Daily'>5 Tablets Daily</option>
                                                            <option value='6 Tablets Daily'>6 Tablets Daily</option>

                                                        </select>
                                                    </div>-->

                                                    <hr>

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Additional information</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#" role="tab" aria-controls="home" aria-selected="true">Closed</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Open</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                        <p class="mb-0">
                                                                            Click on open to view additional info
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                        <p class="mb-0">
                                                                            Dose form
                                                                            <br>
                                                                            medicine
                                                                            <br>
                                                                            Manufacturer
                                                                            <br>
                                                                            —
                                                                            <br>
                                                                            Intended routes of administration
                                                                            <br>
                                                                            Oral
                                                                            <br>
                                                                            Regulatory
                                                                            <br>
                                                                            <a href="https://www.gov.uk/government/publications/controlled-drugs-list--2" target="_blank">
                                                                                HM Government — No Controlled Drug Status
                                                                            </a>
                                                                            <br>
                                                                            This information is taken from dm+d and should be cross-referenced with other sources.
                                                                        </p>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">What support is required with this medicine?<span style="color: red;">*</span></label>
                                                        <select name="txtMedicineSupport" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="Administer">Administer</option>
                                                            <option value="Assist">Assist</option>
                                                            <option value="Prompt">Prompt</option>
                                                        </select>
                                                        <br>
                                                        <span>If you're unsure, we recommend reading the <a href="https://www.cqc.org.uk/guidance-providers/adult-social-care/administering-medicines-home-care-agencies" target="_blank">CQC's guidance </a>on medicines support.
                                                        </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">What type of medicine?<span style="color: red;">*</span></label>
                                                        <select name="txtMedPackage" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="Scheduled">Scheduled</option>
                                                            <option value="Blister">Blister</option>
                                                            <option value="PRN">PRN</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <h5>Medication time</h5>
                                                    <br>

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Select frequency 1 <span style="color: red;">*</span></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <input type="hidden" value="ExtraTea" name="txtCareCall">
                                                                                <span style="font-size:16px;">&nbsp;Extra tea care call</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Select frequency 2 <span style="color: red;">*</span></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="tab-content">
                                                                <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <input name="txtMonday" value="Monday" type="checkbox" class=" " id="customswitch5">
                                                                            <span style="font-size:13px;">&nbsp; Mon</span>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input name="txtTuesday" value="Tuesday" type="checkbox" class=" " id="customswitch6">
                                                                            <span style="font-size:13px;">&nbsp; Tue</span>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input name="txtWednesday" value="Wednesday" type="checkbox" class=" " id="customswitch7">
                                                                            <span style="font-size:13px;">&nbsp; Wed</span>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input name="txtThursday" value="Thursday" type="checkbox" class=" " id="customswitch8">
                                                                            <span style="font-size:13px;">&nbsp; Thu</span>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input name="txtFriday" value="Friday" type="checkbox" class=" " id="customswitch9">
                                                                            <span style="font-size:13px;"> Fri</span>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input name="txtSaturday" value="Saturday" type="checkbox" class=" " id="customswitch10">
                                                                            <span style="font-size:13px;">&nbsp; Sat</span>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input name="txtSunday" value="Sunday" type="checkbox" class=" " id="customswitch11">
                                                                            <span style="font-size:13px;">&nbsp; Sun</span>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input type="checkbox" name="select-all" id="select-alldays" />
                                                                            <span style="font-size:13px;">&nbsp; All</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div style="width: 100%; height:auto; padding:6px; font-size:17px; font-weight:600;">
                                                        <div style="width: 100%; height:auto; background-color:rgba(22, 160, 133,.3); padding:12px;">
                                                            <div>
                                                                If you wish this medication to popup once every month, kindly select a date for the popup.
                                                            </div>
                                                            <span>Popup date</span> &nbsp;
                                                            <input name="txtSunday" value="Sunday" type="checkbox" class=" " id="displayClicked">
                                                        </div>
                                                        <div id="displayPopupMed" style="width: 100%; height:auto; background-color:rgba(189, 195, 199,.3); padding:12px;">
                                                            <label for="exampleInputPassword1">Select popup date<span style="color: red;"></span></label>
                                                            <select name="txtMedPopupDate" value="Null" class="form-control" id="exampleFormControlSelect1">
                                                                <option value="Null" selected="selected">--Select Option--</option>
                                                                <option value="1">1st</option>
                                                                <option value="2">2nd</option>
                                                                <option value="3">3rd</option>
                                                                <option value="4">4th</option>
                                                                <option value="5">5th</option>
                                                                <option value="6">6th</option>
                                                                <option value="7">7th</option>
                                                                <option value="8">8th</option>
                                                                <option value="9">9th</option>
                                                                <option value="10">10th</option>
                                                                <option value="11">11th</option>
                                                                <option value="12">12th</option>
                                                                <option value="13">13th</option>
                                                                <option value="14">14th</option>
                                                                <option value="15">15th</option>
                                                                <option value="16">16th</option>
                                                                <option value="17">17th</option>
                                                                <option value="18">18th</option>
                                                                <option value="19">19th</option>
                                                                <option value="20">20th</option>
                                                                <option value="21">21st</option>
                                                                <option value="22">22nd</option>
                                                                <option value="23">23rd</option>
                                                                <option value="24">24th</option>
                                                                <option value="25">25th</option>
                                                                <option value="26">26th</option>
                                                                <option value="27">27th</option>
                                                                <option value="28">28th</option>
                                                                <option value="29">29th</option>
                                                                <option value="30">30th</option>
                                                                <option value="31">31st</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6 col-6">
                                                                <label for="exampleInputStarts1">Starts<span style="color: red;"> *</span></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                                            <img src="assets/images/icons/pngtree-calendar-icon-logo-2023-date-time-png-image_6310337.png" style="width: 20px; height:20px;" alt="">
                                                                        </span>
                                                                    </div>
                                                                    <input type="date" required value="<?php print $today; ?>" name="txtStartMed" class="form-control" id="exampleInputStarts" aria-describedby="StartDate" placeholder="Starts">
                                                                    <div class="invalid-tooltip">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6">
                                                                <label for="exampleInputStarts1">End<span style="color: red;"></span></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                                            <img src="assets/images/icons/pngtree-calendar-icon-logo-2023-date-time-png-image_6310337.png" style="width: 20px; height:20px;" alt="">
                                                                        </span>
                                                                    </div>
                                                                    <input type="date" name="txtEndMed" class="form-control" id="exampleInputStarts" aria-describedby="StartDate" placeholder="Starts">
                                                                    <div class="invalid-tooltip">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>

                                                    <div class="form-group">
                                                        <h5>Add details(optional)</h5>
                                                        <label for="exampleFormControlTextarea1">The carer will see this note in the app each time they complete this task.</label>
                                                        <textarea name="txtMedkDetails" class="form-control" placeholder="Highlights" id="exampleFormControlHighlights" rows="5"></textarea>
                                                    </div>


                                                    <div class="form-grou">
                                                        <input type="hidden" value="<?php
                                                                                    $currentDate = date('F j, Y');
                                                                                    echo $currentDate; ?>" name="current_Date">

                                                        <input type="hidden" value="<?php echo date("h:i a"); ?>" name="current_Time">
                                                    </div>


                                                    <?php

                                                    for ($a = 1; $a <= 50; $a++) {
                                                        $usdd = "0";
                                                        $rand = rand(0000, 9999);
                                                        $rand1 = rand(0000, 9999);
                                                        $rand2 = rand(0000, 9999);
                                                        $rand3 = rand(0000, 9999);
                                                        $rand4 = rand(0000, 9999);
                                                        $randpx = rand(00000000, 99999999);
                                                        $randpx1 = rand(00000000, 99999999);
                                                        $randpx2 = rand(00000000, 99999999);
                                                        $randpx3 = rand(00000000, 99999999);
                                                        $rand5 = rand(0000, 9999);
                                                        $rand6 = rand(0000, 9999);
                                                        $rand7 = rand(0000, 9999);
                                                        $rand8 = rand(0000, 9999);
                                                        $rand9 = rand(00000000, 99999999);
                                                        $rand0 = rand(000000000, 999999999);
                                                        $ud = "45";
                                                        $udsep = "-";
                                                        $udsep1 = "45-";
                                                        $udsep2 = "cl10-";
                                                        $udsep3 = "i94-";
                                                        $id = "$usdd$rand$ud$rand1$rand2$udsep1$rand3$rand4$rand5$udsep2$rand6$rand7$randpx$udsep3$rand8$rand9$rand0$udsep1$randpx1$randpx2$randpx3";
                                                    }

                                                    // Return current date from the remote server

                                                    ?> <input type="hidden" value="<?php echo $id; ?>" name="client_med_id" />


                                                    <?php
                                                    require_once('dbconnections.php');

                                                    for ($a = 1; $a <= 50; $a++) {
                                                        $rand = rand(0, 9);
                                                        $idEncrypt = "$rand";
                                                    }

                                                    // Return current date from the remote server
                                                    ?> <input type="hidden" value="<?php echo $idEncrypt; ?>" name="mysocialIdEncrypt" />

                                                    <button style='height:50px;' type="submit" name="btnSubmitExtraTeaMeds" class="btn  btn-primary">Upload medication</button>

                                                </form>
                                            </div>

                                            <div class="col-md-7">
                                                <?php include_once('client-medication-table.php'); ?>
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


        <script type="text/javascript">
            /**/
        </script>
        <?php include('footer-contents.php'); ?>