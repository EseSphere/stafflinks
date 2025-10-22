<?php include('dbconnections.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo "$CompanyName"; ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="Geosoft care - Software for care settings is a dynamic nursing, domiciliary, support and agency App based in the UK. It is built on solid partnership and experience spanning almost two decades within its management team." />
    <meta name="keywords" content="HTML, CSS, JavaScript, AJAX, PHP mySQL" />
    <meta name="author" content="Ese Sphere Ent | Samson Gift" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="assets/images/gsLogo.png" />
    <meta name="twitter:image" content="assets/images/gsLogo.png" />
    <link rel="icon" href="assets/images/gsLogo.png" />
    <link rel="icon" href="assets/images/gsLogo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript">
        $(document).ready(function() {
            $('#popupAlert').hide();

            $('#popupAlertSuccess').hide();

            $('#SecondCarerVisibilitybox').hide();

            $('#SecondCarerVisibility').click(function() {
                $('#SecondCarerVisibilitybox').slideToggle();
            });

            $('#selectAllCheckbox').change(function() {
                $('.checkboxes').prop('checked', $(this).prop('checked'));
            });

        });
    </script>
    <?php include('processing-new-pay-rate.php'); ?>
    <?php include('processing-new-travel-rate.php'); ?>
    <?php include('processing-new-invoice-rate.php'); ?>
    <?php include('processing-new-holiday.php'); ?>
    <?php include('processing-new-contract.php'); ?>
    <?php include('processing-new-payer.php'); ?>
    <?php include('processing-new-purchase-order.php'); ?>
    <?php include('processing-billing-config.php'); ?>
    <?php include('fetching-pay-dashboard-data.php'); ?>
    <?php include('fetching-invoice-dashboard-data.php'); ?>
    <?php include('processing-edit-holiday-rate.php'); ?>
</head>
<style type="text/css">
    #exampleFormControlSelect1 {
        height: 50px;
    }

    .chatSystemBox {
        height: 500px;
        overflow: auto;
        display: flex;
        flex-direction: column-reverse;
        width: 100%;
        padding: 22px;
        max-height: 500px;
    }

    html,
    body {
        font-weight: 600;
    }

    ul {
        list-style: none;
    }

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

    .multipleSelection {
        width: 200px;
        background-color: rgba(189, 195, 199, 1.0);
        font-size: 16px;
        position: absolute;
        z-index: 1000;
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
        top: 0;
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

        /* Added text color for better Samson Gift Osaretin | Ese Sphere Ent visibility */
    }

    input[type=checkbox] {
        transform: scale(1.3);
    }

    .pagination {
        list-style-type: none;
        padding: 10px 0;
        display: inline-flex;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .pagination li {
        box-sizing: border-box;
        padding-right: 10px;
    }

    .pagination li a {
        box-sizing: border-box;
        background-color: #e2e6e6;
        padding: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        color: #616872;
        border-radius: 4px;
    }

    .pagination li a:hover {
        background-color: rgba(41, 128, 185, 1.0);
        color: #fff;
    }

    .pagination .next a,
    .pagination .prev a {
        text-transform: uppercase;
        font-size: 12px;
    }

    .pagination .currentpage a {
        background-color: rgba(41, 128, 185, 1.0);
        color: #fff;
    }

    .pagination .currentpage a:hover {
        background-color: #518acb;
    }
</style>

<body class="">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <?php
    $stmt = $conn->prepare("SELECT * FROM tbl_goesoft_users 
    WHERE user_email_address = ?");
    $stmt->bind_param("s", $_SESSION['usr_email']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
    ?>

        <nav class="pcoded-navbar">
            <div class="navbar-wrapper">
                <div class="navbar-content scroll-div ">
                    <div class="">
                        <div class="main-menu-header">
                            <img class="img-radius" src="assets/images/gsLogo.png" alt="User-Profile-Image">
                            <div class="user-details">
                                <span>Geosoft</span>
                                <div id="more-details">Admin panel<i class="fa m-l-5"></i></div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav pcoded-inner-navbar ">
                        <li class="nav-item pcoded-menu-caption">
                            <label>Navigation</label>
                        </li>
                        <li class="nav-item">
                            <a href="https://admin.geosoftcare.co.uk" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Confirm visits</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./pay-dashboard-657464i-77rf6646-8ui4746" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Pay dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./pay-runs" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Pay runs</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./invoice-dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-folder"></i></span><span class="pcoded-mtext">Invoice dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./invoice" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Invoices</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./invoice-settings-452888-994884-0542353-45662g6" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Invoice settings</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./finance-actual-hour" class="nav-link "><span class="pcoded-micon"><i class="feather icon-link-2"></i></span><span class="pcoded-mtext">Actual hour</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./finance-planned-hour" class="nav-link "><span class="pcoded-micon"><i class="feather icon-link"></i></span><span class="pcoded-mtext">Planned hour</span></a>
                        </li>

                        <li class="nav-item">
                            <a href="./discarded-payroll" class="nav-link "><span class="pcoded-micon"><i class="feather icon-briefcase"></i></span><span class="pcoded-mtext">Discarded payroll</span></a>
                        </li>

                        <li class="nav-item">
                            <a href="./discarded-invoicing" class="nav-link "><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">Discarded invoicing</span></a>
                        </li>

                        <li class="nav-item">
                            <a href="./pay-rates" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Pay rates</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./travel-rate" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Travel rates</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./invoice-rate" class="nav-link "><span class="pcoded-micon"><i class="feather icon-heart"></i></span><span class="pcoded-mtext">Invoice rates</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./holiday-rate" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Holiday rates</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./subscriptions" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Subscriptions</span></a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="./contract" class="nav-link "><span class="pcoded-micon"><i class="feather icon-shield"></i></span><span class="pcoded-mtext">Contracts</span></a>
                        </li>-->
                        <li class="nav-item">
                            <a href="./purchase-orders" class="nav-link "><span class="pcoded-micon"><i class="feather icon-briefcase"></i></span><span class="pcoded-mtext">Purchase orders</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="./payers" class="nav-link "><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">Payer contracts</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="../auth-normal-logout" class="nav-link "><span class="pcoded-micon"><i class="feather icon-log-out"></i></span><span class="pcoded-mtext">Logout</span></a>
                        </li>
                    </ul>

                    <div class="card text-center">
                        <div class="card-block">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="feather icon-sunset f-40"></i>
                            <h6 class="mt-3">Hello, Geosoft!</h6>
                            <p>Complete the following steps to learn how Geosoft works and hit the ground running.</p>
                            <a href="../../../../help-center" target="_blank" class="btn btn-primary btn-sm text-white m-0">Help center</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
            <div class="m-header">
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
                <a href="#!" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <h3 style="color: rgba(189, 195, 199,1.0);">Geosoft</h3>
                </a>
                <a href="#!" class="mob-toggler">
                    <i class="feather icon-more-vertical"></i>
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                        <div class="search-bar">
                            <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                            <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="dropdown-toggle h-drop" href="https://admin.geosoftcare.co.uk/54655-476564-99iu955-4h4657/roster/">
                                <i class="feather icon-layout"></i> Roster
                            </a>
                            &nbsp;&nbsp;
                            <a class="dropdown-toggle h-drop" href="https://admin.geosoftcare.co.uk/54655-476564-99iu955-4h4657/manage-runs">
                                <i class="feather icon-map"></i> Manage run
                            </a>
                            &nbsp;&nbsp;
                            <a class="dropdown-toggle h-drop" href="https://admin.geosoftcare.co.uk/54655-476564-99iu955-4h4657/active-clients">
                                <i class="feather icon-user"></i> Client
                            </a>
                            &nbsp;&nbsp;
                            <a class="dropdown-toggle h-drop" href="https://admin.geosoftcare.co.uk/54655-476564-99iu955-4h4657/team-list">
                                <i class="feather icon-user-plus"></i> Team
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li>
                        <div class="dropdown">
                            <div class="dropdown-menu dropdown-menu-right notification">
                                <div class="noti-head">
                                    <h6 class="d-inline-block m-b-0">Notifications</h6>
                                    <div class="float-right">
                                        <a href="#!" class="m-r-10">mark as read</a>
                                        <a href="#!">clear all</a>
                                    </div>
                                </div>
                                <ul class="noti-body">
                                    <li class="n-title">
                                        <p class="m-b-0">NEW</p>
                                    </li>
                                </ul>
                                <div class="noti-footer">
                                    <a href="#!">show all</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo "" . $row['company_name'] . "";
                        }
                            ?> | <i class="feather icon-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <img src="assets/images/user/profile-image.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span>Samson Gift</span>
                                    <a href="auth-signin.html" class="dud-logout" title="Logout">
                                        <i class="feather icon-log-out"></i>
                                    </a>
                                </div>
                                <ul class="pro-body">
                                    <li><a href="./auth-user-profile" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                    <li><a href="./auth-messages" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                    <li><a href="./auth-normal-logout" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <!-- [ Header ] end -->