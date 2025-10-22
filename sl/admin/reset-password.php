<?php require_once "./header.php"; ?>
<?php include('processing-reset-password.php'); ?>

<div class="auth-wrapper">
    <div class="auth-content text-center">
        <form action="./reset-password" method="POST" enctype="multipart/form-data" name="signupForm" autocomplete="off">
            <div class="card borderless">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h4 class="f-w-400">Reset Password</h4>
                            <hr>
                            <div id="popupAlert" style="display:none; width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                Email does not exist!!!
                            </div>
                            <div class="form-group mb-3 text-left">
                                <label style="text-align: left;" for="Company name">Enter email</label>
                                <input type="email" name="myEmail" class="form-control" id="myEmail" placeholder="Email address" required />
                            </div>
                            <button type="submit" id="save-btn" name="btnResetPassword" class="btn btn-primary btn-block mb-4">Reset password</button>
                            <hr>
                            <p class="mb-2">Already have an account? <a href="./index" class="f-w-400">Sign in</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    save_btn = document.querySelector("#save-btn");
    save_btn.onclick = function() {
        this.innerHTML = "<div class='loader'>Loading...</div>";
        setTimeout(() => {
            this.innerHTML = "Reset password";
            this.style = "color: #fff; pointer-event:none;";
        }, 7000);
    }
</script>
<?php require_once "./footer.php"; ?>