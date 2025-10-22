<?php require_once "./header.php"; ?>
<?php include('processing-user-signin.php'); ?>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<form action="./index" method="POST" enctype="multipart/form-data" name="signupForm" autocomplete="off">
			<div class="card borderless">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="card-body">
							<a href="https://stafflinks.co.uk" class="text-decoration-none" target="_blank" rel="noopener noreferrer" title="Visit StaffLinks official website">
								<img src="./assets/images/logo.png" alt="StaffLinks Logo" class="img-fluid mb-0" style="width:230px; height:70px;">
							</a>
							<hr>
							<h5 class="mb-3 f-w-400">Sign In to Your Account</h5>

							<!-- Display Error Messages -->
							<?php if (!empty($loginError) || !empty($emailError) || !empty($passError)) : ?>
								<div id="popupAlert" style="width:100%; height:auto; margin-bottom:5px; padding:15px; background-color:rgba(192,57,43,1.0); color:white; border-radius:6px;">
									<?php
									if (!empty($loginError)) echo $loginError;
									elseif (!empty($emailError)) echo $emailError;
									elseif (!empty($passError)) echo $passError;
									?>
								</div>
							<?php endif; ?>

							<div class="form-group mb-3">
								<input type="text" name="myEmail" required class="form-control" id="Email" placeholder="Email address" value="<?php echo isset($_POST['myEmail']) ? htmlspecialchars($_POST['myEmail']) : ''; ?>">
							</div>
							<div class="form-group mb-4">
								<input type="password" name="myPassword" required class="form-control" id="Password" placeholder="Password">
							</div>

							<div class="custom-control custom-checkbox text-left mb-4 mt-2">
								<input type="checkbox" class="custom-control-input" id="customCheck1">
								<label class="custom-control-label" for="customCheck1">Save credentials.</label>
							</div>

							<button type="submit" name="btnLogin" class="btn btn-primary btn-block mb-4">Sign In</button>
							<hr>
							<p class="mb-2 text-muted">Forgot password? <a href="./reset-password" class="f-w-400">Reset</a></p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- [ auth-signin ] end -->

<?php require_once "./footer.php"; ?>