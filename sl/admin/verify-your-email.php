<?php require_once "./header.php"; ?>
<?php include('checking-mail-verification.php'); ?>

<div class="wrapper">
    <div style="margin-top: 5%;" class="container text-center">
        <div class="card borderless">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div id="popupAlert" style="width: 100%; height:auto; display:none; padding:8px; background-color:#e74c3c; color:white;">
                        <h4 class="text-white">Oops!!! Wrong code.</h4>
                    </div>
                    <div class="p-4">
                        <a href="https://stafflinks.co.uk" class="text-decoration-none mt-5" rel="noopener noreferrer" title="Visit StaffLinks official website">
                            <img src="./assets/images/logo.png" alt="" class="img-fluid mb-0" style="width:230px; height:70px;">
                        </a>
                        <hr>
                        <h4>Verify your email</h4>
                        <h5 class="mb-3">Kindly check your email for the verification code <br>Thank you for your time.</h5>
                        <form action="./verify-your-email" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="tel" style="width: 350px; margin:0px auto; font-size:22px;" class="form-control" placeholder="Enter code" required name="verificationTXT" />
                            </div>
                            <div class="form-group">
                                <button name="btnSubmitVerifyform" type="submit" class="btn btn-primary">Verify now!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./footer.php'); ?>