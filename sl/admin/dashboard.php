<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php require_once 'statistics.php'; ?>
            <!-- Clients ,team member start -->
            <div class="col-xl-6 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Recent Clients</h5>
                        <a href="./client-list" style="position: absolute; right:50px; top:12x;">
                            <button type="button" class="btn btn-info btn-sm"><i class="feather mr-2 icon-plus"></i>More</button>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th class="text-left">Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "
                                            SELECT 
                                                t1.userId, 
                                                t1.client_first_name, 
                                                t1.client_last_name, 
                                                t1.client_primary_phone, 
                                                t1.uryyToeSS4, 
                                                t1.col_company_Id, 
                                                t2.col_reason, 
                                                t2.col_status_color 
                                            FROM tbl_general_client_form t1
                                            LEFT JOIN tbl_client_status_records t2 
                                                ON t1.uryyToeSS4 = t2.col_client_Id 
                                                AND (
                                                    (CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) 
                                                    OR (t2.col_start_date <= '$today' AND t2.col_end_date = 'TFN')
                                                ) 
                                            WHERE t1.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
                                            ORDER BY t1.userId DESC 
                                            LIMIT 5;
                                        ";

                                    $result = mysqli_query($conn, $query);

                                    while ($trans = mysqli_fetch_array($result)) {
                                        echo "
                                            <tr>
                                                <td>
                                                    <div class='d-inline-block align-middle'>
                                                        <img src='assets/images/profile/profile-icon.jpg' alt='user image' class='img-radius wid-40 align-top m-r-15'>
                                                        <div class='d-inline-block'>
                                                            <h6> " . $trans['client_first_name'] . "  " . $trans['client_last_name'] . " </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>" . $trans['client_primary_phone'] . "</td>
                                                <td>
                                                    <a href='./client-details?uryyToeSS4=" . $trans['uryyToeSS4'] . "'>
                                                        <button title='View client details' type='button' class='btn btn-primary btn-sm'>
                                                            <i class='feather mr-2 icon-eye'></i>View
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Team ,team member start -->
            <div class="col-xl-6 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Recent Team</h5>
                        <a href="./team-list" style="position: absolute; right:50px; top:12x;">
                            <button type="button" class="btn btn-info btn-sm"><i class="feather mr-2 icon-plus"></i>More</button>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th class="text-left">Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "
                                            SELECT 
                                                t1.userId, 
                                                t1.team_first_name, 
                                                t1.team_last_name, 
                                                t1.team_primary_phone, 
                                                t1.uryyTteamoeSS4, 
                                                t1.col_company_Id, 
                                                t2.col_team_condition, 
                                                t2.col_approval, 
                                                t2.col_color_code 
                                            FROM tbl_general_team_form t1
                                            LEFT JOIN tbl_team_status t2 
                                                ON t1.uryyTteamoeSS4 = t2.uryyTteamoeSS4 
                                                AND (
                                                    (CURDATE() BETWEEN t2.col_startDate AND t2.col_endDate AND t2.col_approval = 'Approved') 
                                                    OR (t2.col_startDate <= '$today' AND t2.col_endDate = 'TFN' AND t2.col_approval = 'Approved')
                                                )
                                            WHERE t1.col_company_Id = '" . $_SESSION['usr_compId'] . "' 
                                            ORDER BY t1.userId DESC 
                                            LIMIT 5;
                                        ";

                                    $result = mysqli_query($conn, $query);

                                    while ($trans = mysqli_fetch_array($result)) {
                                        echo "
                                            <tr>
                                                <td>
                                                    <div class='d-inline-block align-middle'>
                                                        <img src='assets/images/profile/profile-icon.jpg' alt='user image' class='img-radius wid-40 align-top m-r-15'>
                                                        <div class='d-inline-block'>
                                                            <h6>" . $trans['team_first_name'] . " " . $trans['team_last_name'] . "</h6>
                                                            <p class='m-b-0' style='font-size:12px; padding:3px 0px 3px 5px; border-radius:50px; color:" . $trans["col_color_code"] . ";'>
                                                                <strong>" . $trans['col_team_condition'] . "</strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>" . $trans['team_primary_phone'] . "</td>
                                                <td>
                                                    <a href='./team-details?uryyTteamoeSS4=" . $trans['uryyTteamoeSS4'] . "'>
                                                        <button type='button' class='btn btn-primary btn-sm'>
                                                            <i class='feather mr-2 icon-eye'></i>View
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-3 col-lg-3">
                <div class="calendar">
                    <div class="calendar-header">
                        <button id="prev-month">&#8592;</button>
                        <div id="month-year"></div>
                        <button id="next-month">&#8594;</button>
                    </div>
                    <div class="calendar-body">
                        <div class="calendar-weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="calendar-days" id="calendar-days">
                            <!-- Days will be generated here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-9 col-sm-9 col-lg-9">
                <?php
                // Fetch client data
                $sql = "SELECT client_first_name, client_last_name, client_address_line_1, client_address_line_2, client_city, client_county, client_poster_code, client_country FROM tbl_general_client_form";
                $result = $conn->query($sql);
                $clients = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Combine full address
                        $row['full_address'] = trim($row['client_address_line_1'] . ', ' . $row['client_address_line_2'] . ', ' . $row['client_city'] . ', ' . $row['client_county'] . ', ' . $row['client_poster_code'] . ', ' . $row['client_country']);
                        $clients[] = $row;
                    }
                }
                $conn->close();
                ?>
                <div style="height: 100%;" class="card table-card">
                    <div class="card-header">
                        <h5>Client Location</h5>
                    </div>
                    <div class="card-body p-0">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTWuN9VC9BLvvy2dLJTSlW_AijYf5DIN4"></script>
<script>
    const monthYear = document.getElementById('month-year');
    const calendarDays = document.getElementById('calendar-days');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');

    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    function renderCalendar(month, year) {
        calendarDays.innerHTML = "";
        monthYear.textContent = `${months[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Add empty cells for days before first day
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('calendar-day', 'empty');
            calendarDays.appendChild(emptyCell);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('calendar-day');
            dayCell.textContent = day;

            // Highlight today
            if (
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {
                dayCell.classList.add('today');
            }

            calendarDays.appendChild(dayCell);
        }
    }

    prevMonthBtn.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    nextMonthBtn.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    // Initial render
    renderCalendar(currentMonth, currentYear);

    const clients = <?php echo json_encode($clients); ?>;

    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 6,
            center: {
                lat: 54.0,
                lng: -2.0
            } // default center
        });

        const geocoder = new google.maps.Geocoder();
        const bounds = new google.maps.LatLngBounds();

        clients.forEach(client => {
            if (client.full_address) {
                geocoder.geocode({
                    'address': client.full_address
                }, function(results, status) {
                    if (status === 'OK' && results[0]) {
                        const position = results[0].geometry.location;
                        bounds.extend(position);

                        const marker = new google.maps.Marker({
                            map: map,
                            position: position,
                            title: client.client_first_name + " " + client.client_last_name
                        });

                        const infoWindow = new google.maps.InfoWindow({
                            content: `<b>${client.client_first_name} ${client.client_last_name}</b><br>${client.full_address}`
                        });

                        marker.addListener("click", () => infoWindow.open(map, marker));
                        map.fitBounds(bounds);
                    } else {
                        console.warn('Geocode failed for ' + client.full_address + ': ' + status);
                    }
                });
            }
        });
    }

    window.onload = initMap;
</script>
<?php include('footer-contents.php'); ?>