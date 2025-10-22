<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Geosoft is a dynamic nursing, domiciliary, support and agency App based in the UK. 
    It is built on solid partnership and experience spanning almost two decades within its management team." />
    <meta name="keywords" content="HTML, CSS, Bootstrap, Tailwind, Flutter, JavaScript, AJAX, PHP mySQL, Chart.js, Xampp" />
    <meta name="author" content="Ese Sphere" />
    <meta property="og:image" content="../assets/images/logos/gsLogo4.png" />
    <meta name="twitter:image" content="../assets/images/logos/gsLogo4.png" />
    <link rel="icon" href="../assets/images/logos/gsLogo4.png" />
    <link rel="icon" href="../assets/images/logos/gsLogo4.png" type="image/x-icon" />
    <title>Geosoft Care | Analysis</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/gsLogo4.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ./");
        exit();
    }
    ?>
    <style type="text/css">
        html,
        body {
            overflow-x: hidden;
        }

        .card-dark {
            background-color: #1e1e3f;
            border: none;
            color: white;
        }

        .card-dark h5 {
            border-bottom: 1px solid #444;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./dashboard" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/gsLogo.png" width="160" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>

                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./dashboard" aria-expanded="false">
                                <span><i class="ti ti-layout-dashboard"></i></span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Statistics</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./care-plan" aria-expanded="false">
                                <span><i class="ti ti-article"></i></span>
                                <span class="hide-menu">Care Plan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./care-task" aria-expanded="false">
                                <span><i class="ti ti-alert-circle"></i></span>
                                <span class="hide-menu">Care Task</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./care-meds" aria-expanded="false">
                                <span><i class="ti ti-health-recognition"></i></span>
                                <span class="hide-menu">Care Meds</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./reported-visit" aria-expanded="false">
                                <span><i class="ti ti-typography"></i></span>
                                <span class="hide-menu">Reported Visit</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">SECTIONS</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./scheduled-visit" aria-expanded="false">
                                <span><i class="ti ti-user"></i></span>
                                <span class="hide-menu">Scheduled Visit</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./scheduled-hours" aria-expanded="false">
                                <span><i class="ti ti-clock"></i></span>
                                <span class="hide-menu">Scheduled Hours</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">EXTRA</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./visit-fulfilled" aria-expanded="false">
                                <span><i class="ti ti-mood-happy"></i></span>
                                <span class="hide-menu">Completed Visit</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./force-checkin" aria-expanded="false">
                                <span><i class="ti ti-logout"></i></span>
                                <span class="hide-menu">Force Check-In</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./completed-task" aria-expanded="false">
                                <span><i class="ti ti-book"></i></span>
                                <span class="hide-menu">Completed Task</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./completed-medication" aria-expanded="false">
                                <span><i class="ti ti-heart"></i></span>
                                <span class="hide-menu">Completed Meds</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="./dashboard" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Dashboard</p>
                                        </a>
                                        <a href="./dashboard" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="./logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>