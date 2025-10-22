<?php require_once('client_task_backend.php'); ?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Plan Task</h5>
                            <p style="margin-top:-10px; font-size:16px;">View all tasks assigned to <?= $clientFullName ?> and add new tasks using the form provided below.</p>
                        </div>
                        <hr />
                        <ul class="breadcrumb text-black">
                            <li class="breadcrumb-item"><i class="feather icon-home"></i></li>
                            <li class="breadcrumb-item"><?= $clientFullName ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Client tasks</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                <div class="row">
                                    <div id="popupAlert" style="width: 100%; height:auto; display:none; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                        Client task already exist!!!
                                    </div>
                                    <div class="col-md-5" id="colLeft">
                                        <form method="POST" action="./client-task?uryyToeSS4=<?= $uryyToeSS4 ?>" enctype="multipart/form-data" name="addClient-form" autocomplete="off">
                                            <div class="form-group"><input type="hidden" name="txtClientSocialId" value="<?= $uryyToeSS4 ?>" /></div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Select task<sup style="color: red;">*</sup></label>
                                                <div><input type="text" name="txtTask" required class="form-control" id="input" placeholder="Type a task here..." /></div>
                                                <ul class="list"></ul>
                                            </div>
                                            <div class="form-group">
                                                <h5>Add details(optional)</h5>
                                                <label for="exampleFormControlTextarea1">The carer will see this note in the app each time they complete this task.</label>
                                                <textarea name="txtTaskDetails" class="form-control" placeholder="Highlights" id="exampleFormControlHighlights" rows="5"></textarea>
                                            </div>
                                            <br>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Select frequency 1<sup style="color: red;">*</sup></h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                            <div class="daysAlignment" style="width: 100%; height:auto; font-weight:600; padding:12px 0px 0px 20px;">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <input name="txtMorning" value="Morning" type="checkbox" class='checkboxes'>
                                                                        <span style="font-size:13px;">&nbsp; Mor</span>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input name="txtLunch" value="Lunch" type="checkbox" class='checkboxes'>
                                                                        <span style="font-size:13px;">&nbsp; Lun</span>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input name="txtTea" value="Tea" type="checkbox" class='checkboxes'>
                                                                        <span style="font-size:13px;">&nbsp; Tea</span>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input name="txtBed" value="Bed" type="checkbox" class='checkboxes'>
                                                                        <span style="font-size:13px;">&nbsp; Bed</span>
                                                                    </div>
                                                                    <?php
                                                                    while ($row_client_carecalls = mysqli_fetch_array($select_client_carecalls)) {
                                                                        $txtExtraCalls = $row_client_carecalls['care_calls'];
                                                                        if (isset($callMap[$txtExtraCalls])) {
                                                                            $name = $callMap[$txtExtraCalls]['name'];
                                                                            $label = $callMap[$txtExtraCalls]['label'];
                                                                            echo "
                                                                            <div class='col-3'>
                                                                                <input name='{$name}' value='{$txtExtraCalls}' type='checkbox' class='checkboxes'>
                                                                                <span style='font-size:13px;'>&nbsp; {$label}</span>
                                                                            </div>
                                                                            ";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <div class="col-3">
                                                                        <input type="checkbox" id="selectAllCheckbox">
                                                                        <span style='font-size:13px;'>&nbsp; Check all</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="width: 100%; height:auto;">
                                                <div class="card-header">
                                                    <h5>Select frequency 2<sup style="color: red;">*</sup></h5>
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
                                                        <h6 class="mt-3"><strong>Daily | weekly</strong></h6>
                                                        <div style="width: 100%; height:auto; background-color:rgba(149, 175, 192,1.0); padding:12px;">
                                                            <div>If you wish this task to popup once every month, kindly select a date for the popup.</div>
                                                            <span>Popup date</span> &nbsp;
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
                                                                <div>If you wish this task to popup once every month, kindly choose the start date and the end date below.</div>
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
                                                                <div>Custom<br>If you wish this task to popup on every other day, please select the checkbox below.
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
                                            <hr>
                                            <div class="form-group mt-5">
                                                <h5><span style="color: red;"></span></h5>
                                                <div class="custom-control custom-switch">
                                                    <input name="txtAnytimeSession" type="checkbox" class="custom-control-input" id="customswitch12">
                                                    <label class="custom-control-label" for="customswitch12">Anytime / Sessions</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputStarts1">Start date<sup style="color: red;">*</sup></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                                    <img src="assets/images/icons/pngtree-calendar-icon-logo-2023-date-time-png-image_6310337.png" style="width: 20px; height:20px;" alt="">
                                                                </span>
                                                            </div>
                                                            <input type="date" required name="txtStarts" class="form-control" id="exampleInputStarts" aria-describedby="StartDate" value="<?php echo $today; ?>">
                                                            <div class="invalid-tooltip"></div>
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
                                                            <input type="date" name="txtEnd" class="form-control" id="exampleInputStarts" aria-describedby="StartDate" placeholder="Starts">
                                                            <div class="invalid-tooltip"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-grou">
                                                <input type="hidden" value="<?= $currentDate; ?>" name="current_Date">
                                                <input type="hidden" value="<?php echo date("h:ia"); ?>" name="current_Time">
                                            </div>
                                            <input type="hidden" name=" client_task_id" />
                                            <input type="hidden" value="" name="mysocialIdEncrypt" />
                                            <a style='height:40px;' onclick="location.reload()" type="button" class="btn btn-danger text-decoration-none text-white">Refresh</a>
                                            <button style='height:40px;' type="submit" name="btnSubmitClientTastForm" class="btn btn-primary">Continue</button>
                                        </form>
                                    </div>
                                    <div class="col-md-7" id="colRight">
                                        <?php include_once('client-task-table.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#btnEnlarge").on("click", function() {
        $("#colLeft").toggle(); // hide/show left column
        $("#colRight").toggleClass("col-md-7 col-md-12"); // switch width
    });

    /**/
    let names = [
        <?php
        include('dbconnect.php');
        $result = mysqli_query($myConnection, "SELECT * FROM tbl_task_list ");
        while ($trans = mysqli_fetch_array($result)) {
            echo "
                '" . $trans['task_title'] . "',
                ";
        } ?>

    ];
    let sortedNames = names.sort();
    let input = document.getElementById("input");
    input.addEventListener("keyup", (e) => {
        removeElements();
        for (let i of sortedNames) {

            if (
                i.toLowerCase().startsWith(input.value.toLowerCase()) &&
                input.value != ""
            ) {
                let listItem = document.createElement("li");
                listItem.classList.add("list-items");
                listItem.style.cursor = "pointer";
                listItem.setAttribute("onclick", "displayNames('" + i + "')");
                let word = "<b>" + i.substr(0, input.value.length) + "</b>";
                word += i.substr(input.value.length);
                listItem.innerHTML = word;
                document.querySelector(".list").appendChild(listItem);
            }
        }
    });

    function displayNames(value) {
        input.value = value;
        removeElements();
    }

    function removeElements() {
        let items = document.querySelectorAll(".list-items");
        items.forEach((item) => {
            item.remove();
        });
    }
</script>
<?php include('footer-contents.php'); ?>