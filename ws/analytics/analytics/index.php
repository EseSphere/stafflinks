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
              <p style="font-weight:900; font-size:25px; color:#0c2461; text-align:center;">Sign In</p>
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
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                  <div class="form-check">
                    <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-dark" for="flexCheckChecked">
                      Remeber this Device
                    </label>
                  </div>
                  <a class="text-primary fw-bold" href="./forgot-password">Forgot Password?</a>
                </div>
                <button name="btnLogin" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">New to Geosoft?</p>
                  <a class="text-primary fw-bold ms-2" href="./register">Create an account</a>
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