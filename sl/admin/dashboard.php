<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
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
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div style="height: 325px;" class="card">
                    <div style="height: 100%;" class="card-body">
                        <h5 class="mb-5">Power</h5>
                        <h2>2789<span class="text-muted m-l-5 f-14 mb-5">kw</span></h2>
                        <div id="power-card-chart1"></div>
                        <div class="row">
                            <div class="col col-auto">
                                <div class="map-area">
                                    <h6 class="m-0">2876 <span> kw</span></h6>
                                    <p class="text-muted m-0">month</p>
                                </div>
                            </div>
                            <div class="col col-auto">
                                <div class="map-area">
                                    <h6 class="m-0">234 <span> kw</span></h6>
                                    <p class="text-muted m-0">Today</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Total Leads</h5>
                        <p class="text-c-green f-w-500"><i class="fa fa-caret-up m-r-15"></i> 18% High than last month</p>
                        <div class="row">
                            <div class="col-4 b-r-default">
                                <p class="text-muted m-b-5">Overall</p>
                                <h5>76.12%</h5>
                            </div>
                            <div class="col-4 b-r-default">
                                <p class="text-muted m-b-5">Monthly</p>
                                <h5>16.40%</h5>
                            </div>
                            <div class="col-4">
                                <p class="text-muted m-b-5">Day</p>
                                <h5>4.56%</h5>
                            </div>
                        </div>
                    </div>
                    <div id="tot-lead" style="height:150px"></div>
                </div>
            </div>
        </div>

        <div class="row">
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
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>