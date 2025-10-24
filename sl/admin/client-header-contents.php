<?php
include('dbconnections.php');
if (isset($_GET['id'], $_GET['spec'])) {
    $id = $_GET['id'];
    $uryyToeSS4 = $_GET['spec'];
} else {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>StaffLinks | Simplify. Organize. Thrive.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta property="og:title" content="StaffLinks | Simplify. Organize. Thrive." />
    <meta property="og:description" content="Manage staff, clients, schedules, and finances in one unified platform. StaffLinks makes team and operations management simple and efficient." />
    <meta property="og:image" content="./assets/images/favicon.png" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.stafflinks.co.uk" />
    <meta name="twitter:title" content="StaffLinks | Simplify. Organize. Thrive." />
    <meta name="twitter:description" content="StaffLinks centralizes staff, client, schedule, and finance management in one platform for maximum efficiency." />
    <meta name="twitter:image" content="./assets/images/favicon.png" />
    <meta name="twitter:card" content="./assets/images/favicon.png" />
    <meta name="theme-color" content="#4CAF50" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="rating" content="General" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="icon" href="./assets/images/favicon.png" />
    <link rel="icon" href="./assets/images/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./css/task-medication.css" />
    <link rel="stylesheet" href="./css/emarchart.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./assets/js/scripts.js"></script>
</head>

<body class="text-decoration-none">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <?php require_once 'update-notice.php'; ?>
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-content scroll-div ">
                <div class="">
                    <div class="main-menu-header">
                        <div class="user-details">
                            <span>StaffLinks</span>
                            <div id="more-details">Admin panel<i class="fa fa-chevron-down m-l-5"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-unstyled">
                            <li class="list-group-item text-decoration-none"><a href="./checking-administrator-access" style="text-decoration: none; color:#fff;"><i class="feather icon-user m-r-5"></i>View admin</a></li>
                            <li class="list-group-item text-decoration-none"><a href="./share-access-code?col_company_Id=<?php echo "" . $display_admin_data_row['col_company_Id'] . ""; ?>" style="text-decoration: none; color:#fff;"><i class="feather icon-share-2 m-r-5"></i>Share access</a></li>
                            <li class="list-group-item text-decoration-none"><a href="./qrcodes" style="text-decoration: none; color:#fff;"><i class="fas fa-qrcode m-r-5"></i>QR Codes</a></li>
                            <li class="list-group-item text-decoration-none"><a href="./logout?logout" style="text-decoration: none; color:#fff;"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="./dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./client-details?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./client-notes?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Note</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./client-visits?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-eye"></i></span><span class="pcoded-mtext">Visits</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./schedulled-visits?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-bell"></i></span><span class="pcoded-mtext">Scheduled</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./completed-visits?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-thumbs-up"></i></span><span class="pcoded-mtext">Completed</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./care-plan?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-heart"></i></span><span class="pcoded-mtext">Care plan</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./settings?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="fas fa-qrcode"></i></span><span class="pcoded-mtext">Settings</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./client-task?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Task plan</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./client-medication?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-activity"></i></span><span class="pcoded-mtext">Medication</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./share-family-access?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-briefcase"></i></span><span class="pcoded-mtext">Share access</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./auth-normal-logout" class="nav-link "><span class="pcoded-micon"><i class="feather icon-log-out"></i></span><span class="pcoded-mtext">Logout</span></a>
                    </li>
                </ul>
                <div class="card text-center">
                    <div class="card-block">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="feather icon-sunset f-40"></i>
                        <h6 class="mt-3">Hello, StaffLinks!</h6>
                        <p>Complete the following steps to learn how Geosoft works and hit the ground running.</p>
                        <a href="https://stafflinks.co.uk/page/help-center" target="_blank" class="btn btn-primary btn-sm text-white m-0">Help center</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <img src="./assets/images/logo.png" style="width: 200px; height:60px; margin-left:-50px;" alt="stafflinks logo" class="logo images">
            </a>
            <a href="#!" class="mob-toggler"><i class="feather icon-more-vertical"></i></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="dropdown-toggle h-drop text-decoration-none" href="./rota">
                            <i class="feather icon-layout"></i> Rota
                        </a>
                        &nbsp;&nbsp;
                        <a class="dropdown-toggle h-drop text-decoration-none" href="./manage-runs">
                            <i class="feather icon-map"></i> Run
                        </a>
                        &nbsp;&nbsp;
                        <a class="dropdown-toggle h-drop text-decoration-none" href="./active-clients">
                            <i class="feather icon-user"></i> Client
                        </a>
                        &nbsp;&nbsp;
                        <a class="dropdown-toggle h-drop text-decoration-none" href="./team-list">
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
                            <?php echo "" . $_SESSION['usr_compName'] . ""; ?> | <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="assets/images/user/profile-image.jpg" class="img-radius" alt="User-Profile-Image">
                                <span><?php echo "" . $_SESSION['usr_userName'] . ""; ?></span>
                                <a href="auth-signin.html" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="./checking-administrator-access" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                <li><a href="./logout" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>