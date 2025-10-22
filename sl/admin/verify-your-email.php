<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WorkSphere | Simplify. Organize. Thrive.</title>
    <meta name="description" content="WorkSphere is an all-in-one platform for managing staff, clients, schedules, and finances efficiently. Streamline operations and empower your team with a centralized web application." />
    <meta name="keywords" content="WorkSphere, staff management, client management, scheduling, finance portal, web app, team management, productivity, operations" />
    <meta name="author" content="WorkSphere Team" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta property="og:title" content="WorkSphere | Simplify. Organize. Thrive." />
    <meta property="og:description" content="Manage staff, clients, schedules, and finances in one unified platform. WorkSphere makes team and operations management simple and efficient." />
    <meta property="og:image" content="assets/images/wsLogo.png" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.worksphere.co.uk" />
    <meta name="twitter:title" content="WorkSphere | Simplify. Organize. Thrive." />
    <meta name="twitter:description" content="WorkSphere centralizes staff, client, schedule, and finance management in one platform for maximum efficiency." />
    <meta name="twitter:image" content="assets/images/wsLogo.png" />
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="icon" href="assets/images/wsLogo.png" type="image/png" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/wsLogo.png">
    <link rel="shortcut icon" href="assets/images/wsLogo.png" type="image/x-icon">
    <meta name="theme-color" content="#4CAF50" />
    <link rel="manifest" href="/manifest.json" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <link rel="canonical" href="https://www.worksphere.co.uk" />
    <meta name="rating" content="General" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#popupAlert').hide();
        });
    </script>
    <?php include('checking-mail-verification.php'); ?>
</head>

<div class="wrapper">
    <div style="margin-top: 5%;" class="container text-center">
        <div class="card borderless">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:#e74c3c; color:white;">
                        Oops!!! Wrong code.
                    </div>
                    <div class="">
                        <br />
                        <h1 class="f-w-400">Geosoft Care</h1>
                        <hr>
                        <h3>Verify your email</h3>
                        Thank you for your time.
                        <br>
                        Kindly check your email for the verification code.
                        <br><br>
                        <form action="./verify-your-email" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="tel" style="width: 350px; margin:0px auto; font-size:22px;" class="form-control" placeholder="Enter code" required name="verificationTXT" />
                            </div>
                            <div class="form-group">
                                <button name="btnSubmitVerifyform" type="submit" class="btn  btn-primary btn-lg">Verify now!</button>
                            </div>
                        </form>
                    </div>
                    <br /><br>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#popupAlert').hide();

        function showDiv() {
            document.getElementById('popupAlert').style.display = "block";
        };
    </script>
    </body>

</html>