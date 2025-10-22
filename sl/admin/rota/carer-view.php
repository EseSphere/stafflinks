<?php
include_once('header-panel.php');
include_once('flat-header-panel.php');
$varCarerView =  mysqli_real_escape_string($myConnection, $_POST['txtCarerView']);
?>


<script>
    mobiscroll.setOptions({
        locale: mobiscroll.localeEn,
        theme: 'ios',
        themeVariant: 'light'
    });

    function getfirstCarerString(firstCarer) {
        return firstCarer.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var calendar;
    var popup;
    var range;
    var oldEvent;
    var tempEvent = {};
    var deleteEvent;
    var restoreEvent;
    var titleInput = document.getElementById('work-order-title');
    var locationInput = document.getElementById('work-order-location');
    var firstCarerInput = document.getElementById('work-order-firstCarer');
    var StatusTextarea = document.getElementById('work-order-status');
    var deleteButton = document.getElementById('work-order-decision');
    var resourceCont = document.getElementById('work-order-resources');

    var myResources = [{
        id: 'contractors',
        name: 'Team(Carers)',

        collapsed: false,
        eventCreation: false,
        children: [{
            id: 'builders',
            name: 'Team',
            eventCreation: false,
            children: [
                <?php
                $sel_dist_att = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls WHERE (first_carer_Id = '$varCarerView' 
                AND col_company_Id = '" . $_SESSION['usr_compId'] . "' AND col_area_city = '" . $_COOKIE["companyCity"] . "') 
                GROUP BY first_carer");
                while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
                    $db_worker_name = $att_rw['first_carer'];
                    echo "
                    {
                        id: '" . $att_rw["team_resource"] . "',
                        name: '" . $att_rw['first_carer'] . "'
                    },
                ";
                } ?>
            ]
        }]
    }];

    function createAddPopup(elm) {
        deleteButton.style.display = 'none';

        deleteEvent = true;
        restoreEvent = false;

        mobiscroll.getInst(titleInput).value = ev.title || '';
        mobiscroll.getInst(locationInput).value = ev.location || '';
        mobiscroll.getInst(firstCarerInput).value = ev.firstCarer || 0;
        mobiscroll.getInst(StatusTextarea).value = ev.Status || '';
        range.setVal([ev.start, ev.end]);
        setCheckboxes(ev.resource);

        popup.setOptions({
            anchor: elm
        });
        popup.open();
    }

    function createEditPopup(args) {
        var ev = args.event;
        deleteEvent = false;
        restoreEvent = true;

        mobiscroll.getInst(titleInput).value = ev.title || '';
        mobiscroll.getInst(locationInput).value = ev.location || '';
        mobiscroll.getInst(firstCarerInput).value = ev.firstCarer || 0;
        mobiscroll.getInst(StatusTextarea).value = ev.Status || '';
        range.setVal([ev.start, ev.end]);
        setCheckboxes(ev.resource);
        popup.setOptions({
            anchor: args.domEvent.currentTarget
        });
        popup.open();
    }

    calendar = mobiscroll.eventcalendar('#demo-work-order-scheduling', {
        clickToCreate: false,
        dragToCreate: false,
        dragToMove: false,
        dragToResize: false,
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
            $sel_dist_att = mysqli_query($myConnection, "SELECT DISTINCT first_carer_Id FROM tbl_schedule_calls 
            WHERE first_carer_Id = '$varCarerView' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            while ($att_rw = mysqli_fetch_array($sel_dist_att)) {
                $db_worker_Id = $att_rw['first_carer_Id'];

                $sel_corr_data = mysqli_query($myConnection, "SELECT * FROM tbl_schedule_calls 
                WHERE first_carer_Id = '$db_worker_Id' AND rightTo_display = 'True' 
                AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                while ($att_cor_rw = mysqli_fetch_array($sel_corr_data)) {
                    echo "
                {
                    title: '" . $att_cor_rw["client_name"] . "',
                    location: '" . $att_cor_rw["client_area"] . " " . $att_cor_rw["col_area_city"] . "',
                    resource: ['" . $att_cor_rw["team_resource"] . "'],
                    color: '" . $att_cor_rw["timeline_colour"] . "',
                    myUserId: '" . $att_cor_rw["userId"] . "',
                    firstCarer: '" . $att_cor_rw["first_carer"] . "',
                    Status: '" . $att_cor_rw["call_status"] . " | " . $att_cor_rw["care_calls"] . " Call',

                    start: '" . $att_cor_rw["Clientshift_Date"] . "T" . $att_cor_rw["dateTime_in"] . "',
                    end: '" . $att_cor_rw["Clientshift_Date"] . "T" . $att_cor_rw["dateTime_out"] . "',
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
                firstCarer: 0
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

        renderDay: function(args) {
            var formatDate = mobiscroll.formatDate;
            var events = args.events;
            var firstCarers = 0;

            if (events) {
                for (var i = 0; i < events.length; ++i) {
                    firstCarers += events[i].firstCarer;
                }
            }

            return '<div class="md-work-order-date">' + formatDate('DD DDD MMM YYYY', args.date) + '</div>' +
                '<div class="md-work-order-date-title">Carer View</div>';

        },
        renderScheduleEventContent: function(event) {
            return '<div>' + event.title + '<span class="md-work-order-price-tag">Run</span></div>';
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
                touchUi: true
            }
        }
    });

    titleInput.addEventListener('input', function(ev) {
        tempEvent.title = ev.target.value;
    });

    locationInput.addEventListener('input', function(ev) {
        tempEvent.location = ev.target.value;
    });

    firstCarerInput.addEventListener('input', function(ev) {
        tempEvent.firstCarer = +ev.target.value || 0;;
    });

    StatusTextarea.addEventListener('change', function(ev) {
        tempEvent.Status = ev.target.value;
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

    deleteButton.addEventListener('click', function() {
        // navigate to current event details on button click
        window.location.href = '../care-call-details?userId=' + tempEvent.myUserId + '';
        popup.close();
        var deletedEvent = tempEvent;
    });


    document.querySelectorAll('input[name=event-status]').forEach(function(elm) {
        elm.addEventListener('change', function() {
            tempEvent.free = mobiscroll.getInst(freeSegmented).checked;
        });
    });

    function setCheckboxes(resources) {
        var checkboxes = document.getElementsByClassName('work-order-checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            var checkbox = checkboxes[i];
            mobiscroll.getInst(checkbox).checked = resources.indexOf(checkbox.getAttribute('data-value')) !== -1;
        }
    }
</script>




</body>

</html>