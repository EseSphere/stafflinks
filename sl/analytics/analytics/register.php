<?php include('header-log.php') ?>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
  data-sidebar-position="fixed" data-header-position="fixed">
  <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
      <div class="row justify-content-center w-100">
        <div class="col-md-4 col-lg-3 col-xxl-3 col-xl-3 col-sm-3">
          <div class="card mb-0">
            <div class="card-body">
              <p style="font-weight:900; font-size:25px; color:#0c2461; text-align:center;">Sign Up</p>
              <span style="color: red; text-align:center; font-size:14px; font-weight:bold; display:block;" id="emailError">
                <?php
                if (isset($error)) {
                  echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>" . $error;
                }
                ?>
                <br><br>
              </span>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" autocomplete="off" class="form-body">
                <div class="mb-3">
                  <label for="exampleInputtext1" class="form-label">Name</label>
                  <input type="text" name="fullName" class="form-control" required id="exampleInputtext1" aria-describedby="textHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" required id="exampleInputPassword1">
                </div>
                <button name="btnRegister" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                  <a class="text-primary fw-bold ms-2" href="./">Sign In</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('footer-log.php') ?>