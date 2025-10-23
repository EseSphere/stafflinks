<?php require_once 'header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-content text-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" name="signupForm" autocomplete="off">
            <div class="card borderless">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <a href="https://stafflinks.co.uk" class="text-decoration-none" rel="noopener noreferrer" title="Visit StaffLinks official website">
                                <img src="./assets/images/logo.png" alt="" class="img-fluid mb-0" style="width:230px; height:70px;">
                            </a>
                            <hr>
                            <h5 class="mb-3 f-w-400">Create access for new company</h5>
                            <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                Company already exist!!!
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="myEmail" class="form-control" id="myEmail" placeholder="Email address" required />
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="fullName" class="form-control" id="username" placeholder="Company name" required />
                            </div>
                            <hr>
                            <div class="form-group mb-4">
                                <input type="password" minlength="8" name="myPassword" class="form-control" id="Password" placeholder="Password" required />
                            </div>
                            <button type="submit" id="save-btn" name="btnAccessurlform" class="btn btn-primary btn-block mb-4">Create account</button>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>