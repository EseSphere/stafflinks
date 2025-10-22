<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Phare X | User Forgot Password</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta property="og:image" content="../../assets/img/Logo_nobkground.png" />
    <meta name="twitter:image" content="../../assets/img/Logo_nobkground.png" />
    <link rel="icon" href="../../assets/img/Logo_nobkground.png" />
    <link rel="icon" href="../../assets/img/Logo_nobkground.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <?php require_once('processing-account-verification.php'); ?>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="align-items-center justify-content-between mb-3">
                                <h4>Account Verification</h4>
                                <h5>A verification code has been sent to your email. Please enter the code below to verify your account.</h5>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" name="verifyicNumber" required class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Enter code</label>
                                <span style="color: red; font-size:12px; font-weight:bold; display:block;" id="emailError">
                                    <?php
                                    if (isset($error)) {
                                        echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>" . $error;
                                    }
                                    ?>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Continue</button>
                            <p class="text-center mb-0">Remember your account? <a href="./">Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>