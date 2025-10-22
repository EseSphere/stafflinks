<?php include('dbconnections.php');
$sql_notification = "SELECT * FROM tbl_team_status WHERE (col_approval = 'Awaiting Approval' 
AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
$myCheckres = mysqli_query($conn, $sql_notification);
$rowcount = mysqli_num_rows($myCheckres);
$varNotification = '<sup class="shake-me">' . $rowcount . '</sup>';

$sel_admin_data_result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users 
WHERE user_email_address = '" . $_SESSION['usr_email'] . "' 
AND col_company_id = '" . $_SESSION['usr_compId'] . "' ");
$display_admin_data_row = mysqli_fetch_array($sel_admin_data_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo "$CompanyName"; ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="Geosoft care - Software for care settings is a dynamic nursing, domiciliary,
     support and agency App based in the UK. It is built on solid partnership and experience spanning almost two 
     decades within its management team." />
    <meta name="keywords" content="HTML, CSS, Bootstrap, Tailwind, Xampp Restful APIs, Git, JavaScript, AJAX, PHP mySQL" />
    <meta name="author" content="Geosoft Care LTD" />
    <meta name="developer" content="Ese Sphere IT Solution" />
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
    <link rel="stylesheet" href="./css/style2.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js" type="text/javascript">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="./assets/js/scripts.js"></script>
    <?php include('processing-add-task-form.php'); ?>
    <?php include('processing-add-client-form.php'); ?>
    <?php include('processing-client-task.php'); ?>
    <?php include('processing-client-medicine.php'); ?>
    <?php include('processing-add-group-form.php'); ?>
    <?php include('processing-add-team-form.php'); ?>
    <?php include('processing-add-position.php'); ?>
    <?php include('processing-new-medication-form.php'); ?>
    <?php include('processing-edit-medication.php'); ?>
    <?php include('processing-schedule-roster.php'); ?>
    <?php include('processing-add-new-run.php'); ?>
    <?php include('processing-edit-morning-call.php'); ?>
</head>

<body data-new-gr-c-s-check-loaded="14.1027.0" data-gr-ext-installed="">
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
                        <img class="img-radius" src="assets/images/gsLogo.png" alt="User-Profile-Image">
                        <div class="user-details">
                            <span>Geosoft</span>
                            <div id="more-details">Admin panel<i class="fa fa-chevron-down m-l-5"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-unstyled">
                            <li class="list-group-item"><a href="./checking-administrator-access"
                                    style="text-decoration: none; color:#fff;"><i
                                        class="feather icon-user m-r-5"></i>View admin</a></li>
                            <li class="list-group-item"><a
                                    href="./share-access-code?col_company_Id=<?php echo "" . $display_admin_data_row['col_company_Id'] . ""; ?>"
                                    style="text-decoration: none; color:#fff;"><i
                                        class="feather icon-share-2 m-r-5"></i>Share access</a></li>
                            <li class="list-group-item"><a href="./qrcodes"
                                    style="text-decoration: none; color:#fff;"><i class="fas fa-qrcode m-r-5"></i>QR
                                    Codes</a></li>
                            <li class="list-group-item"><a href="./auth-normal-logout?auth-normal-logout"
                                    style="text-decoration: none; color:#fff;"><i
                                        class="feather icon-log-out m-r-5"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="./dashboard" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./roster/" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-layout"></i></span><span class="pcoded-mtext">Roster</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./manage-runs" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-map"></i></span><span class="pcoded-mtext">Runs</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./active-clients" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-user"></i></span><span class="pcoded-mtext">Clients</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./active-team" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-user-plus"></i></span><span class="pcoded-mtext">Team</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./reports" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-align-justify"></i></span><span
                                class="pcoded-mtext">Reports</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./ratings" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-star"></i></span><span class="pcoded-mtext">Ratings</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./tasks" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-box"></i></span><span class="pcoded-mtext">Tasks</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./medication" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-heart"></i></span><span
                                class="pcoded-mtext">Medication</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./group" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-pie-chart"></i></span><span
                                class="pcoded-mtext">Groups</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./position" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-briefcase"></i></span><span
                                class="pcoded-mtext">Position</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./auth-normal-logout" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-log-out"></i></span><span class="pcoded-mtext">Logout</span></a>
                    </li>
                </ul>
                <div class="card text-center">
                    <div class="card-block">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="feather icon-sunset f-40"></i>
                        <h6 class="mt-3">Hello, Geosoft!</h6>
                        <p>Complete the following steps to learn how Geosoft works and hit the ground running.</p>
                        <a href="https://geosoftcare.co.uk/page/help-center" target="_blank"
                            class="btn btn-primary btn-sm text-white m-0">Help center</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <h3 style="color: rgba(189, 195, 199,1.0);">Geosoft</h3>
            </a>
            <a href="#!" class="mob-toggler"><i class="feather icon-more-vertical"></i></a>
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
                        <a class="dropdown-toggle h-drop"
                            href="./finance/">
                            <i class="feather icon-pocket"></i> Finance
                        </a>
                        &nbsp;&nbsp;
                        <a class="dropdown-toggle h-drop" href="./auth-position">
                            <i class="feather icon-briefcase"></i> Position
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <div class="noti-head">
                            <div class="float-right">
                                <a href="./notification-panel" style="text-decoration: none;">
                                    <i class="feather icon-bell"></i><?php print $varNotification; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo "" . $display_admin_data_row['company_name'] . ""; ?> <i
                                class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="assets/images/user/profile-image.jpg" class="img-radius"
                                    alt="User-Profile-Image">
                                <span>
                                    <?php echo "" . $display_admin_data_row['user_fullname'] . ""; ?>
                                </span>
                            </div>
                            <ul class="pro-body">
                                <li><a href="./checking-administrator-access" class="dropdown-item"><i
                                            class="feather icon-user"></i> Admin list</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a>
                                </li>
                                <li><a href="./auth-normal-logout" class="dropdown-item"><i
                                            class="feather icon-lock"></i> Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>