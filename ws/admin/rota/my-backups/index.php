<?php ob_start();
session_start();
include('dbconnect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="HTML, CSS, JavaScript, AJAX, PHP mySQL" />
    <meta name="author" content="Geocare Services Limited" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Geosoft | Rota - Work order scheduling</title>

    <meta property="og:image" content="../assets/images/gsLogo.png" />
    <meta name="twitter:image" content="../assets/images/gsLogo.png" />
    <link rel="icon" href="../assets/images/gsLogo.png" />
    <!-- Logo icon -->
    <link rel="icon" href="../assets/images/gsLogo.png" type="image/x-icon" />


    <link rel="stylesheet" href="css/mobiscroll.javascript.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="js/mobiscroll.javascript.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#popaction").hide();
            $('#popupclientBox').click(function() {
                $('#popaction').slideToggle();
            });
            $('#popupClose').click(function() {
                $('#popaction').slideToggle();
            });
        });
    </script>

    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        body,
        html {
            height: 100%;
            overflow-x: hidden;
        }

        .md-work-order-checkbox-label.mbsc-checkbox {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .md-work-order-date {
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            padding: 5px 10px;
        }

        .md-work-order-date-title {
            font-size: 13px;
            color: #959595;
            padding: 5px 10px;
            line-height: 18px;
        }

        .md-work-order-price-tag {
            display: inline-block;
            font-size: 11px;
            line-height: 16px;
            vertical-align: middle;
            border: 1px solid #959595;
            color: #959595;
            border-radius: 5px;
            margin: 0 10px;
            padding: 0px 5px;
        }

        .md-work-order-scheduling .mbsc-timeline-parent {
            height: 32px;
        }

        .multipleSelection {
            width: 200px;
            background-color: rgba(189, 195, 199, 1.0);
            font-size: 16px;
        }

        .selectBox {
            position: relative;
        }

        .selectBox select {
            width: 100%;
            padding: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .overSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0px;
            bottom: 0;
        }

        #checkBoxes {
            display: none;
            border: 1px #8DF5E4 solid;
            height: auto;
            padding: 8px;
        }

        #checkBoxes label {
            display: block;
            padding: 5px;
        }

        #checkBoxes label:hover {
            background-color: #4F615E;
            color: white;

            /* Added text color for better visibility */
        }



        /*Carer version */

        .CmultipleSelection {
            width: 200px;
            background-color: rgba(189, 195, 199, 1.0);
            font-size: 16px;
        }

        .CselectBox {
            position: relative;
        }

        .CselectBox select {
            width: 100%;
            padding: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .CoverSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0px;
            bottom: 0;
        }

        #CcheckBoxes {
            display: none;
            border: 1px #8DF5E4 solid;
            height: auto;
            padding: 8px;
        }

        #CcheckBoxes label {
            display: block;
            padding: 5px;
        }

        #CcheckBoxes label:hover {
            background-color: #4F615E;
            color: white;

            /* Added text color for better visibility */
        }
    </style>

</head>

<body>

    <div mbsc-page class="demo-work-order-scheduling">
        <div style="height:100%">
            <div id="demo-work-order-scheduling" class="md-work-order-scheduling"></div>

            <div style="display:none;">
                <div id="demo-work-order-popup">
                    <div style="width:100%; height:auto; text-align:right; padding:22px 22px 3px;">
                        <button id="popupclientBox" class="btn btn-primary btn-xs">Edit</button>
                    </div>
                    <div class="mbsc-form-group">
                        <label>
                            Client name
                            <input mbsc-input id="work-order-title" />
                        </label>
                        <label>
                            Location
                            <input mbsc-input id="work-order-location" />
                        </label>
                        <label>
                            Team member(s)
                            <input mbsc-input id="work-order-bill" />
                        </label>
                        <label>
                            Notes
                            <textarea mbsc-textarea id="work-order-notes"></textarea>
                        </label>
                    </div>
                    <div class="mbsc-form-group">
                        <label>
                            Starts
                            <input mbsc-input id="work-order-start" />
                        </label>
                        <label>
                            Ends
                            <input mbsc-input id="work-order-end" />
                        </label>
                        <div id="work-order-date"></div>
                    </div>
                    <div id="work-order-resources" class="mbsc-form-group">

                    </div>

                    <div class="mbsc-button-group">
                        <button class="mbsc-button-block" id="work-order-delete" mbsc-button data-color="danger" data-variant="outline">Delete work order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="position:absolute; top:2px; width:78%; font-size:18px; left:200px; z-index:1000;">
        <div class="row">
            <div class="col-md-2 col-2">
                <form action="./change-roster-view" enctype="multipart/form-data" method="post" autocomplete="off">
                    <div class="multipleSelection">
                        <div class="selectBox" onclick="showCheckboxes()">
                            <select style="width: 100%; height:40px; border:1px solid rgba(22, 160, 133,1.0); border-radius:5px;">
                                <option>Client view</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>

                        <div id="checkBoxes">

                            <?php

                            $sqlSelectCity = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' GROUP BY col_area_city ");
                            while ($cityRow = mysqli_fetch_array($sqlSelectCity)) {
                                echo "

                            <label for='Client view'>
                                <input value='" . $cityRow["col_area_city"] . "' name='checkCityView' type='checkbox' id='' />
                                " . $cityRow["col_area_city"] . "
                            </label>

                            ";
                            } ?>
                            <hr>
                            <input type="submit" name="btnChangeRosterView" style="width: 100%; height:35px; cursor:pointer;
                            border:none; background-color:rgba(41, 128, 185,1.0); color:white;" value="Change view" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-2">
                <form action="./change-roster-view" enctype="multipart/form-data" method="post" autocomplete="off">
                    <div class="CmultipleSelection">
                        <div class="CselectBox" onclick="showCarerCheckboxes()">
                            <select style="width: 100%; height:40px; border:1px solid rgba(22, 160, 133,1.0); border-radius:5px;">
                                <option>Carer view</option>
                            </select>
                            <div class="CoverSelect"></div>
                        </div>

                        <div id="CcheckBoxes">

                            <?php

                            $sqlSelectCity = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' GROUP BY col_area_city ");
                            while ($cityRow = mysqli_fetch_array($sqlSelectCity)) {
                                echo "

                            <label for='Carer view'>
                                <input value='" . $cityRow["col_area_city"] . "' name='checkCityView' type='checkbox' id='' />
                                " . $cityRow["col_area_city"] . "
                            </label>

                            ";
                            } ?>
                            <hr>
                            <input type="submit" name="btnChangeCarerView" style="width: 100%; height:35px; cursor:pointer;
                            border:none; background-color:rgba(41, 128, 185,1.0); color:white;" value="Change view" />
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align:right;" class="col-md-2">
                <h5>Daily rota</h5>
            </div>
            <div style="text-align:right;" class="col-md-2"></div>
            <div style="text-align:right;" class="col-md-4">
                <a href="../manage-runs" target="_blank" style="text-decoration: none;">
                    <button class="btn btn-md btn-primary">Manage runs</button>
                </a>
                <a href="../schedule-roster" target="_blank" style="text-decoration: none;">
                    <button class="btn btn-md btn-success">Plan roster</button>
                </a>
                <a href="../dashboard" target="_blank" style="text-decoration: none;">
                    <button class="btn btn-md btn-outline-secondary">Dashboard</button>
                </a>
            </div>
        </div>
    </div>


    <div id="popaction" style="position:absolute; top:0px; left:0; right:0; bottom:0; width:100%; font-size:18px; z-index:1000; background-color:rgba(44, 62, 80,.1); height:100%;">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-4"></div>
            <div class="col-md-5">
                <div style="width: 100%; height:100%; background-color:white;border-left: 3px solid rgba(44, 62, 80,1.0);">
                    <div style="padding:22px; width:100%; height:auto; background-color:rgba(44, 62, 80,1.0);">
                        <button class="btn btn-sm btn-danger" id="popupClose" style="float: right; cursor:pointer;">Close</button>
                        <h5><strong style="color: white;">Edit care call</strong></h5>
                        <div style="width: 100%; height:auto; margin-top:18px;">
                            <form action="">
                                <div class="form-group">
                                    <div class="row">
                                        <div style="padding: 0px;" class="col-md-8">
                                            <input style="height: 50px; font-size:20px;" type="search" name="txtSearchClient" class="form-control" required placeholder="Enter client name">
                                        </div>
                                        <div style="padding: 0px;" class="col-md-4">
                                            <input style="height: 50px; font-size:16px;" type="submit" value="Fetch" name="btnSearchClient" class="btn btn-success btn-large" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div style="padding:22px; width:100%; height:auto; background-color:inherit;">
                        <h5>Select Client</h5>
                        <hr>
                        <table class="table table-striped">
                            <?php
                            $getClientsDetails = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' GROUP BY client_name ");
                            while ($att_cli_row = mysqli_fetch_array($getClientsDetails)) {

                                echo "
                                    <tr>
                                        <td>" . $att_cli_row["client_name"] . "</td>
                                        <td style='text-align: right;'>
                                            <a target='_blank' href='../edit-morning-call?uryyToeSS4=" . $att_cli_row["uryyToeSS4"] . "' style='text-decoration: none; cursor: pointer;' title='Re-schedule morning care call'>
                                            <img src='../assets/images/icons/1.jpg' style='width: 30px; height:30px; box-shadow: 10px 10px 7px lightblue; border-radius:100%;' alt=''>
                                            </a>
                                            <a target='_blank' href='../edit-lunch-call?uryyToeSS4=" . $att_cli_row["uryyToeSS4"] . "' style='text-decoration: none; cursor: pointer;' title='Re-schedule lunch care call'>
                                            <img src='../assets/images/icons/2.png' style='width: 30px; height:30px; box-shadow: 10px 10px 7px lightblue; border-radius:100%;' alt=''>
                                            </a>
                                            <a target='_blank' href='../edit-tea-call?uryyToeSS4=" . $att_cli_row["uryyToeSS4"] . "' style='text-decoration: none; cursor: pointer;' title='Re-schedule tea care call'>
                                            <img src='../assets/images/icons/3.jpg' style='width: 30px; height:30px; box-shadow: 10px 10px 7px lightblue; border-radius:100%;' alt=''>
                                            </a>
                                            <a target='_blank' href='../edit-bed-call?uryyToeSS4=" . $att_cli_row["uryyToeSS4"] . "' style='text-decoration: none; cursor: pointer;' title='Re-schedule bed care call'>
                                            <img src='../assets/images/icons/4.png' style='width: 30px; height:30px; box-shadow: 10px 10px 7px lightblue; border-radius:100%;' alt=''>
                                            </a>
                                        </td>
                                    </tr>
                            ";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        mobiscroll.setOptions({
            locale: mobiscroll.localeEn,
            theme: 'ios',
            themeVariant: 'light'
        });

        function getCostString(cost) {
            return cost.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        var calendar,
            popup,
            range,
            oldEvent,
            tempEvent = {},
            deleteEvent,
            restoreEvent,
            titleInput = document.getElementById('work-order-title'),
            locationInput = document.getElementById('work-order-location'),
            billInput = document.getElementById('work-order-bill'),
            notesTextarea = document.getElementById('work-order-notes'),
            deleteButton = document.getElementById('work-order-delete'),
            resourceCont = document.getElementById('work-order-resources');

        var myResources = [{
            id: 'contractors',
            name: 'Team(Carers)',

            // This is to collapsed the schedule drop down
            collapsed: false,
            eventCreation: false,
            children: [{
                id: 'builders',
                name: 'Team',
                eventCreation: false,
                children: [

                    <?php
                    if (isset($_GET['col_area_city'])) {
                        $GetRunByCity = $_GET['col_area_city'];

                        $sel_dist_att = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls WHERE col_area_city = '$GetRunByCity' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' GROUP BY first_carer ");
                        while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
                            $db_worker_name = $att_rw['first_carer'];

                            echo "

                    {
                        id: '" . $att_rw["team_resource"] . "',
                        name: '" . $att_rw['first_carer'] . "'
                    },

                ";
                        }
                    } ?>

                ]
            }]
        }];

        function createAddPopup(elm) {
            // hide delete button inside add popup
            deleteButton.style.display = 'none';

            deleteEvent = true;
            restoreEvent = false;

            // set popup header text and buttons for adding
            popup.setOptions({
                headerText: 'New work order',
                buttons: [
                    'cancel',
                    {
                        text: '',
                        keyCode: 'enter',
                        handler: function() {

                            calendar.updateEvent(tempEvent);
                            deleteEvent = false;

                            // navigate the calendar to the correct view
                            calendar.navigate(tempEvent.start);

                            popup.close();
                        },
                        cssClass: 'mbsc-popup-button-primary'
                    }
                ]
            });

            // fill popup with a new event data
            mobiscroll.getInst(titleInput).value = tempEvent.title;
            mobiscroll.getInst(locationInput).value = tempEvent.location;
            mobiscroll.getInst(billInput).value = tempEvent.cost;
            mobiscroll.getInst(notesTextarea).value = '';
            range.setVal([tempEvent.start, tempEvent.end]);
            setCheckboxes(tempEvent.resource);

            // set anchor for the popup
            popup.setOptions({
                anchor: elm
            });

            popup.open();
        }

        function createEditPopup(args) {
            var ev = args.event;

            // show delete button inside edit popup
            deleteButton.style.display = 'block';

            deleteEvent = false;
            restoreEvent = true;

            // set popup header text and buttons for editing
            popup.setOptions({
                headerText: 'Edit event',
                buttons: [
                    'cancel',
                    {
                        text: '',
                        keyCode: 'enter',
                        handler: function() {
                            var date = range.getVal();
                            // update event with the new properties on save button click
                            var s = "<a title=\"Blah\" href=\"javascript:BlahFunc('" + options.rowId + "')\">This is blah</a>";

                            // navigate the calendar to the correct view
                            calendar.navigate(date[0]);;

                            restoreEvent = false;
                            popup.close();
                        },
                        cssClass: 'mbsc-popup-button-primary'
                    }
                ]
            });

            // fill popup with the selected event data
            mobiscroll.getInst(titleInput).value = ev.title || '';
            mobiscroll.getInst(locationInput).value = ev.location || '';
            mobiscroll.getInst(billInput).value = ev.cost || 0;
            mobiscroll.getInst(notesTextarea).value = ev.notes || '';
            range.setVal([ev.start, ev.end]);
            setCheckboxes(ev.resource);

            // set anchor for the popup
            popup.setOptions({
                anchor: args.domEvent.currentTarget
            });
            popup.open();
        }

        calendar = mobiscroll.eventcalendar('#demo-work-order-scheduling', {
            clickToCreate: true,
            dragToCreate: true,
            dragToMove: true,
            dragToResize: true,
            dragTimeStep: 30,
            view: {
                timeline: {
                    type: 'week',
                    startDay: 0,
                    endDay: 6
                }
            },
            data: [
                <?php
                include('dbconnect.php');
                $sel_dist_att = mysqli_query($myConnection, "SELECT DISTINCT first_carer FROM tbl_schedule_calls WHERE first_carer != ' ' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
                    $db_worker_name = $att_rw['first_carer'];

                    $sel_corr_data = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls WHERE first_carer = '$db_worker_name' AND rightTo_display = 'True' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                    while ($att_cor_rw = mysqli_fetch_array($sel_corr_data)) {

                        echo "

                {
                    start: '" . $att_cor_rw["Clientshift_Date"] . "T" . $att_cor_rw["dateTime_in"] . "',
                    end: '" . $att_cor_rw["Clientshift_Date"] . "T" . $att_cor_rw["dateTime_out"] . "',
                    title: '" . $att_cor_rw["client_name"] . "',
                    location: '" . $att_cor_rw["client_area"] . "',
                    resource: ['" . $att_cor_rw["team_resource"] . "'],
                    color: '" . $att_cor_rw["timeline_colour"] . "',
                    cost: '" . $att_cor_rw["first_carer"] . " | " . $att_cor_rw["second_carer"] . "',
                    notes: '" . $att_cor_rw["call_status"] . "',
                },
";
                    }
                } ?>
            ],


            resources: myResources,
            extendDefaultEvent: function() {
                return {
                    title: 'Schedule order',
                    location: '',
                    cost: 0
                };
            },
            onEventClick: function(args) {
                oldEvent = {
                    ...args.event
                };
                tempEvent = args.event;

                if (!popup.isVisible()) {
                    createEditPopup(args);
                }
            },
            onEventCreated: function(args) {
                popup.close();
                // store temporary event
                tempEvent = args.event;
                createAddPopup(args.target);
            },
            onEventDeleted: function(args) {
                mobiscroll.snackbar({
                    button: {
                        action: function() {
                            calendar.addEvent(args.event);
                        },
                        text: 'Undo'
                    },
                    message: 'Schedule deleted'
                });
            },
            renderDay: function(args) {
                var formatDate = mobiscroll.formatDate;
                var events = args.events;
                var costs = 0;

                if (events) {
                    for (var i = 0; i < events.length; ++i) {
                        costs += events[i].cost;
                    }
                }

                return '<div class="md-work-order-date">' + formatDate('DD DDD MMM YYYY', args.date) + '</div>' +
                    '<div class="md-work-order-date-title">New week roster</div>';

            },
            renderScheduleEventContent: function(event) {
                return '<div>' + event.title + '<span class="md-work-order-price-tag"></span></div>';
            }
        });

        popup = mobiscroll.popup('#demo-work-order-popup', {
            display: 'bottom',
            contentPadding: false,
            fullScreen: true,
            scrollLock: false,
            onClose: function() {
                if (deleteEvent) {
                    calendar.removeEvent(tempEvent);
                } else if (restoreEvent) {
                    calendar.updateEvent(oldEvent);
                }
            },
            responsive: {
                medium: {
                    display: 'anchored',
                    width: 520,
                    fullScreen: false,
                    touchUi: false
                }
            }
        });

        titleInput.addEventListener('input', function(ev) {
            // update current event's title
            tempEvent.title = ev.target.value;
        });

        locationInput.addEventListener('input', function(ev) {
            // update current event's location
            tempEvent.location = ev.target.value;
        });

        billInput.addEventListener('input', function(ev) {
            // update current event's cost
            tempEvent.cost = +ev.target.value || 0;;
        });

        notesTextarea.addEventListener('change', function(ev) {
            // update current event's description
            tempEvent.notes = ev.target.value;
        });

        range = mobiscroll.datepicker('#work-order-date', {
            controls: ['time'],
            select: 'range',
            startInput: '#work-order-start',
            endInput: '#work-order-end',
            showRangeLabels: false,
            touchUi: false,
            stepMinute: 30,
            minTime: '06:00',
            maxTime: '23:30',
            onChange: function(args) {
                var date = args.value;
                // update event's start date
                tempEvent.start = date[0];
                tempEvent.end = date[1];
            }
        });

        document.querySelectorAll('input[name=event-status]').forEach(function(elm) {
            elm.addEventListener('change', function() {
                // update current event's free property
                tempEvent.free = mobiscroll.getInst(freeSegmented).checked;
            });
        });

        deleteButton.addEventListener('click', function() {
            // delete current event on button click
            calendar.removeEvent(tempEvent);
            popup.close();

            // save a local reference to the deleted event
            var deletedEvent = tempEvent;

            mobiscroll.snackbar({
                button: {
                    action: function() {
                        calendar.addEvent(deletedEvent);
                    },
                    text: 'Undo'
                },
                message: 'Event deleted'
            });
        });

        function setCheckboxes(resources) {
            var checkboxes = document.getElementsByClassName('work-order-checkbox');

            for (var i = 0; i < checkboxes.length; i++) {
                var checkbox = checkboxes[i];
                mobiscroll.getInst(checkbox).checked = resources.indexOf(checkbox.getAttribute('data-value')) !== -1;
            }
        }

        function appendChekboxes() {
            var checkboxes = '<div class="mbsc-grid mbsc-no-padding"><div class="mbsc-row">';

            for (var i = 0; i < myResources.length; ++i) {
                for (var j = 0; j < myResources[i].children.length; ++j) {
                    var resource = myResources[i].children[j];

                    checkboxes += '<div class="mbsc-col-sm-4"><div class="mbsc-form-group-title">' + resource.name + '</div>';

                    for (var k = 0; k < resource.children.length; ++k) {
                        var r = resource.children[k];
                        checkboxes += '<label class="work-order-checkbox-label"><input class="work-order-checkbox" data-value="' +
                            r.id + '" type="checkbox" mbsc-checkbox data-theme="material" data-label="' + r.name + '"/></label>';

                    }
                    checkboxes += '</div>';
                }
            }
            checkboxes += '</div></div>';

            resourceCont.innerHTML = checkboxes;
            mobiscroll.enhance(resourceCont);
        }

        appendChekboxes();


        //For client view display
        let show = true;

        function showCheckboxes() {
            let checkboxes = document.getElementById("checkBoxes");

            if (show) {
                checkboxes.style.display = "block";
                show = false;
            } else {
                checkboxes.style.display = "none";
                show = true;
            }
        }

        //For carer view display
        let cshow = true;

        function showCarerCheckboxes() {
            let checkboxes = document.getElementById("carercheckBoxes");

            if (cshow) {
                CcheckBoxes.style.display = "block";
                cshow = false;
            } else {
                CcheckBoxes.style.display = "none";
                cshow = true;
            }
        }
    </script>




</body>

</html>