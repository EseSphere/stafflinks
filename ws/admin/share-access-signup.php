<!DOCTYPE html>
<html lang="en">

<head>
    <title>Geosoft Care | Admin control panel - Sign up</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Geocare is a dynamic nursing and domiciliary agency based in the UK. It is built on solid partnership and experience spanning almost two decades within its management team.">
    <meta name="keywords" content="HTML, CSS, JavaScript, AJAX, PHP mySQL">
    <meta name="author" content="Geocare Services Limited">
    <!-- Favicon icon -->
    <meta property="og:image" content="assets/images/gsLogo.png" />
    <meta name="twitter:image" content="assets/images/gsLogo.png" />
    <link rel="icon" href="assets/images/gsLogo.png" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/gsLogo.png" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <script type="text/javascript">
        $(document).ready(function() {
            $('#popupAlert').hide();
        });
    </script>
    <?php include('processing-share-access-details.php'); ?>
</head>

<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
    <div class="auth-content text-center">

        <?php
        if (isset($_GET['col_company_Id'])) {
            $col_company_Id = $_GET['col_company_Id'];
            $result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE col_company_Id='$col_company_Id' ORDER BY userId DESC LIMIT 1");
            while ($row = mysqli_fetch_array($result)) {
        ?>

                <form action="./share-access-signup?col_company_Id=<?php echo "" . $row['col_company_Id'] . ""; ?>" method="POST" enctype="multipart/form-data" name="signupForm" autocomplete="off">
                    <div class="card borderless">
                        <div class="row align-items-center text-center">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h4 class="f-w-400">Sign up</h4>
                                    <hr>

                                    <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                        Email already exist!!!
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="fullName" class="form-control" id="username" placeholder="Full name" required />
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="myEmail" class="form-control" id="myEmail" placeholder="Email address" required />
                                    </div>
                                    <hr>

                                    <input type="hidden" name="txtSelectCompany" value="<?php echo "" . $row['company_name'] . ""; ?>">

                                    <div class="form-group mb-4">
                                        <input type="password" minlength="8" name="myPassword" class="form-control" id="Password" placeholder="myPassword" required />
                                    </div>

                                    <?php

                                    for ($a = 1; $a <= 50; $a++) {
                                        $usdd = "0";
                                        $rand = rand(0000, 9999);
                                        $ud = "45";
                                        $id = "$usdd$rand$ud";
                                    }

                                    // Return current date from the remote server
                                    ?> <input type="hidden" value="<?php echo $id; ?>" name="mysocialId" />
                                    <input type="hidden" name="currentDate" value="<?php echo "" . date("Y-m-d") . ""; ?>" />
                                    <input type="hidden" name="currentTime" value="<?php echo "" . date("H:ia"); ?>" />

                                    <div class="custom-control custom-checkbox  text-left mb-4 mt-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Keep me <a href="#!"> loged in</a>.</label>
                                    </div>

                                    <?php /*Get user ip address*/
                                    $ip_address = $_SERVER['REMOTE_ADDR'];
                                    /*Get user ip address details with geoplugin.net*/
                                    $geopluginURL = 'http://www.geoplugin.net/php.gp?ip=' . $ip_address;
                                    $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
                                    /*Get City name by return array*/
                                    $city = $addrDetailsArr['geoplugin_city'];
                                    /*Get Country name by return array*/
                                    $country = $addrDetailsArr['geoplugin_countryName'];
                                    /*Comment out these line to see all the posible details*/
                                    /*echo '<pre>';
                            print_r($addrDetailsArr);
                            die();*/
                                    if (!$city) {
                                        $city = 'Not Define';
                                    }
                                    if (!$country) {
                                        $country = 'Not Define';
                                    }

                                    ?>
                                    <input type='hidden' value='<?php echo "" . $row['my_city'] . ""; ?>' name='txtmyCity' />
                                    <input type='hidden' value='<?php echo "" . $ip_address . ""; ?>' name='txtIpAddress' />
                                    <input type='hidden' value='<?php echo "" . $country . ""; ?>' name='txtmyCountry' />

                                    <input type="hidden" name="txtCompanyId" value="<?php echo "" . $row['col_company_Id'] . "";
                                                                                }
                                                                            } ?>">

                                    <button type="submit" id="save-btn" name="btnSubmitform" class="btn btn-primary btn-block mb-4">Sign up</button>
                                    <hr>
                                    <p class="mb-2">Already have an account? <a href="./index" class="f-w-400">Signin</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    </div>
</div>
<!-- [ auth-signup ] end -->


<script>
    save_btn = document.querySelector("#save-btn");

    save_btn.onclick = function() {
        this.innerHTML = "<div class='loader'>Loading...</div>";
        setTimeout(() => {
            this.innerHTML = "Sign up";
            this.style = "color: #fff; pointer-event:none";
        }, 7000);
    }
</script>
<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>



</body>

</html>