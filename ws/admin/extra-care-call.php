<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];

    $result_name = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
    $row = mysqli_fetch_array($result_name);
    $client_name = $row['client_first_name'] . ' ' . $row['client_last_name'];
    $client_area = $row['client_area'];
} ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <!--Care update time form start here -->
            <div class="col-xl-6">
                <h5>New visit
                    <br>
                    <small><?php print $client_name; ?> new visit time</small>
                </h5>
                <hr>
                <br><br>

                <form method="POST" action="./processing-extra-care-call" enctype="multipart/form-data" name="addClient-form" autocomplete="off">
                    <input name="clientId" type="hidden" value="<?php echo "" . $uryyToeSS4; ?>">
                    <input name="txtClientFullName" type="hidden" value="<?php echo "" . $client_name; ?>">
                    <input name="txtClientArea" type="hidden" value="<?php echo "" . $client_area; ?>">

                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <label for="exampleInputPassword1">Time in<span style="color: red;">*</span></label>
                                <input name="txtDateTimeIn" required type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time in">
                            </div>
                            <div class="col-md-6 col-6">
                                <label for="exampleInputPassword1">Time out<span style="color: red;">*</span></label>
                                <input name="txtDateTimeOut" required type="time" class="form-control" id="exampleInputPassword1" placeholder="Date time out">
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                    <div style="margin-top: 10px;" class="form-group">
                                        <div style="background-color:rgba(189, 195, 199,.2); font-size:16px; height:120px; font-weight:600; border-left:8px solid rgba(192, 57, 43,1.0); padding:22px; border-radius:5px;">
                                            Choose the numbers of carers required for this care call.
                                        </div>
                                        <br>
                                        <label for=" exampleInputPassword1">Required carer(s)<span style="color: red;">*</span></label>
                                        <select name="txtRequiredCarers" required class="form-control" id="exampleFormControlSelect1">
                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                            <option value="1">One carer</option>
                                            <option value="2">Two carers</option>
                                            <option value="3">Three carers</option>
                                            <option value="4">Four carers</option>
                                            <option value="5">Five carers</option>
                                            <option value="6">Six carers</option>
                                            <option value="7">Seven carers</option>
                                            <option value="8">Eight carers</option>
                                            <option value="9">Nine carers</option>
                                            <option value="10">Ten carers</option>
                                            <option value="15">More than ten carers</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                    <div style="margin-top: 10px;" class="form-group">
                                        <div style="background-color:rgba(189, 195, 199,.2); font-size:16px; height:120px; font-weight:600; border-left:8px solid rgba(39, 174, 96,1.0); padding:22px; border-radius:5px;">
                                            Kindly use the select box below to choose the funding appropriate for this care call.
                                        </div>
                                        <br>
                                        <label for=" exampleInputPassword1">Funding<span style="color: red;">*</span></label>
                                        <select name="txtClientFunding" required class="form-control" id="exampleFormControlSelect1">
                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM tbl_invoice_rate WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "
                                                        <option value='" . $row['col_special_Id'] . "'>" . $row['col_name'] . "</option>
                                                ";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <hr>

                            <div style="width: 100%; height:auto;">
                                <div class="card-header">
                                    <h5 style="text-decoration: underline;"><strong>Frequency</strong></h5>
                                </div>
                                <nav>
                                    <div style="font-size: 18px; color:black; font-weight: 600;" class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button style="color:black;" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Daily | Weekly</button>
                                        <button style="color:black;" class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">One time</button>
                                        <button style="color:black;" class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Custom</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <br>
                                        <h6><strong>Daily | weekly</strong></h6>
                                        <div style="width: 100%; height:auto; background-color:rgba(149, 175, 192,1.0); padding:12px;">
                                            <div>
                                                If you wish this medication to popup once every month, kindly select a date for the popup.
                                            </div>
                                            <span>Select choice</span> &nbsp;
                                            <input type="checkbox" name="clickDisplayDaily" onclick="onlyOne(this)" id="clickDisplayDaily">
                                        </div>
                                        <div id="displayDailyCheckbox" class="card">
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input name="txtMonday" value="Monday" type="checkbox" id="customswitch5">
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
                                                                <span style="font-size:13px;">&nbsp; Fri</span>
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
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <br>
                                        <h6><strong>One time</strong></h6>
                                        <div style="width: 100%; height:auto; padding:6px; font-size:17px; font-weight:600;">
                                            <div style="width: 100%; height:auto; background-color:rgba(22, 160, 133,.3); padding:12px;">
                                                <div>
                                                    If you wish this medication to popup once every month, kindly choose the start date and the end date below.
                                                </div>
                                                <span>Select choice</span> &nbsp;
                                                <input type="checkbox" name="clickDisplayOneTime" onclick="onlyOne(this)" id="clickDisplayOneTime" />
                                            </div>
                                            <div id="displayOneTimeCheckBox" style="width: 100%; height:auto; background-color:rgba(189, 195, 199,.3); padding:12px;">
                                                <h6><strong>Once every month</strong></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <br>
                                        <h6><strong>Custom</strong></h6>
                                        <div style="width: 100%; height:auto; padding:6px; font-size:17px; font-weight:600;">
                                            <div style="width: 100%; height:auto; background-color:rgba(25, 42, 86,1.0); color:white; padding:12px;">
                                                <div>
                                                    Custom
                                                    <br>
                                                    If you wish this medication to popup on every other day, please select the checkbox below.
                                                </div>
                                                <span>Every other day</span> &nbsp;
                                                <input type="checkbox" name="clickDisplayCustom" onclick="onlyOne(this)" id="clickDisplayCustom">
                                            </div>
                                            <div id="displayCustomCheckBox" style="width: 100%; height:auto; background-color:rgba(189, 195, 199,.3); padding:12px;">
                                                <div class="row">
                                                    <div class="col-md-5 col-5">
                                                        <label for="exampleInputPassword1">Period<span style="color: red;"></span></label>
                                                        <input type="number" min="2" max="7" value="2" class="form-control" name="txtPeriod" id="txtMedPopupDate" placeholder="Enter Period">
                                                    </div>
                                                    <div class="col-md-7 col-7">
                                                        <label for="exampleInputPassword1">Select option<span style="color: red;"></span></label>
                                                        <select name="txtPeriodCategory" value="Null" class="form-control" id="exampleFormControlSelect1">
                                                            <option value="Days">Days</option>
                                                            <option value="Weeks">Weeks</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <input name="txtMonday" value="Monday" type="checkbox" id="customswitch5">
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
                                                                    <span style="font-size:13px;">&nbsp; Fri</span>
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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="padding: 12px; height:auto; background-color:rgba(149, 165, 166,.2); margin-top:12px; border-top-left-radius:5px; border-top-right-radius:5px; border-top: 3px solid rgba(39, 174, 96,1.0);">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <label for="exampleInputStarts1">Start date<span style="color: red;"> *</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                        <img src="assets/images/icons/pngtree-calendar-icon-logo-2023-date-time-png-image_6310337.png" style="width: 20px; height:20px;" alt="">
                                                    </span>
                                                </div>
                                                <input type="date" required value="<?php print $today; ?>" name="txtStartDate" class="form-control" id="exampleInputStarts" aria-describedby="StartDate" placeholder="Starts">
                                                <div class="invalid-tooltip">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <label for="exampleInputStarts1">End date<span style="color: red;"></span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                        <img src="assets/images/icons/pngtree-calendar-icon-logo-2023-date-time-png-image_6310337.png" style="width: 20px; height:20px;" alt="">
                                                    </span>
                                                </div>
                                                <input type="date" name="txtEndDate" value="<?php print $tomorrowDate; ?>" class="form-control" id="exampleInputStarts" aria-describedby="StartDate" placeholder="Starts">
                                                <div class="invalid-tooltip">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" style="height:50px;" name="btnSubmitCaregCall" class="btn btn-info">Update now</button>
                    </div>
                </form>
            </div>
            <!--Care update time form end here -->



            <!--Client brief detail start here -->
            <div class="col-xl-4">
                <?php include('client-details-leftpanel.php'); ?>
            </div>
            <!--Client brief detail start here -->
        </div>



        <br>
        <br>
        <div class="row">
            <?php include('bottom-panel-block.php'); ?>
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>




<?php include('footer-contents.php'); ?>