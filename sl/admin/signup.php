<!DOCTYPE html>
<html lang="en">

<head>
	<title>StaffLinks | Simplify. Organize. Thrive.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="robots" content="index, follow" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta property="og:title" content="StaffLinks | Simplify. Organize. Thrive." />
	<meta property="og:description" content="Manage staff, clients, schedules, and finances in one unified platform. StaffLinks makes team and operations management simple and efficient." />
	<meta property="og:image" content="img/stafflinksLogo.png" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.stafflinks.co.uk" />
	<meta name="twitter:title" content="StaffLinks | Simplify. Organize. Thrive." />
	<meta name="twitter:description" content="StaffLinks centralizes staff, client, schedule, and finance management in one platform for maximum efficiency." />
	<meta name="twitter:image" content="img/stafflinksLogo.png" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="theme-color" content="#4CAF50" />
	<meta name="mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="default" />
	<meta name="rating" content="General" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<link rel="icon" href="assets/images/wsLogo.png" type="image/png" />
	<link rel="apple-touch-icon" sizes="180x180" href="assets/images/wsLogo.png">
	<link rel="shortcut icon" href="assets/images/wsLogo.png" type="image/x-icon">
	<link rel="manifest" href="/manifest.json" />
	<link rel="canonical" href="https://www.worksphere.co.uk" />

	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/css/style.css">
	<?php include('processing-signup.php'); ?>

	<style>
		#passwordHelp {
			text-align: left;
			font-size: 13px;
			margin-top: 5px;
		}

		#passwordHelp span {
			display: block;
			color: #999;
		}

		#passwordHelp span.valid {
			color: green;
			font-weight: bold;
		}

		#passwordHelp span.invalid {
			color: red;
			font-weight: bold;
		}

		.password-wrapper {
			position: relative;
		}

		.toggle-password {
			position: absolute;
			top: 50%;
			right: 10px;
			transform: translateY(-50%);
			cursor: pointer;
			color: #888;
			font-size: 16px;
		}

		.toggle-password:hover {
			color: #333;
		}
	</style>
</head>

<body>

	<div class="auth-wrapper">
		<div class="auth-content text-center">
			<form action="./signup" method="POST" enctype="multipart/form-data" name="signupForm" autocomplete="off">
				<div class="card borderless">
					<div class="row align-items-center text-center">
						<div class="col-md-12">
							<div class="card-body">
								<h4 class="f-w-400">Sign up</h4>
								<hr>
								<div id="popupAlert" style="display:none; width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
									Email already exist!!!
								</div>

								<div class="form-group mb-3">
									<input type="text" name="fullName" class="form-control" placeholder="Full name" required />
								</div>

								<div class="form-group mb-3">
									<input type="email" name="myEmail" class="form-control" placeholder="Email address" required />
								</div>

								<hr>

								<div class="form-group mb-3">
									<label for="exampleFormControlInput1" style="float:left;">What city does your company located?</label>
									<input list="cityDataset" name="txtSelectCurrentCity" required type="text" class="form-control" placeholder="City">
								</div>

								<!-- Password Field with Toggle -->
								<div class="form-group mb-3 password-wrapper">
									<input type="password" minlength="8" name="myPassword" class="form-control" id="Password" placeholder="Password" required />
									<span class="toggle-password" id="togglePassword">&#128065;</span>

									<div id="passwordHelp">
										<span id="length" class="invalid">• At least 8 characters</span>
										<span id="upper" class="invalid">• At least one uppercase letter</span>
										<span id="lower" class="invalid">• At least one lowercase letter</span>
										<span id="number" class="invalid">• At least one number</span>
										<span id="special" class="invalid">• At least one special character</span>
									</div>
								</div>

								<div class="custom-control custom-checkbox text-left mb-4 mt-2">
									<input type="checkbox" class="custom-control-input" id="customCheck1">
									<label class="custom-control-label" for="customCheck1">Keep me <a href="#!">logged in</a>.</label>
								</div>

								<button type="submit" id="save-btn" name="btnSubmitform" class="btn btn-primary btn-block mb-4" disabled>Create account</button>
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
		// Password validation logic
		const passwordInput = document.getElementById("Password");
		const saveBtn = document.getElementById("save-btn");

		const lengthReq = document.getElementById("length");
		const upperReq = document.getElementById("upper");
		const lowerReq = document.getElementById("lower");
		const numberReq = document.getElementById("number");
		const specialReq = document.getElementById("special");

		passwordInput.addEventListener("input", () => {
			const password = passwordInput.value;

			const hasLength = password.length >= 8;
			const hasUpper = /[A-Z]/.test(password);
			const hasLower = /[a-z]/.test(password);
			const hasNumber = /\d/.test(password);
			const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

			lengthReq.className = hasLength ? "valid" : "invalid";
			upperReq.className = hasUpper ? "valid" : "invalid";
			lowerReq.className = hasLower ? "valid" : "invalid";
			numberReq.className = hasNumber ? "valid" : "invalid";
			specialReq.className = hasSpecial ? "valid" : "invalid";

			saveBtn.disabled = !(hasLength && hasUpper && hasLower && hasNumber && hasSpecial);
		});

		// Show/Hide Password Toggle
		const togglePassword = document.getElementById("togglePassword");
		togglePassword.addEventListener("click", () => {
			const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
			passwordInput.setAttribute("type", type);
			togglePassword.textContent = type === "password" ? "👁️" : "🙈";
		});
	</script>

	<script>
		save_btn = document.querySelector("#save-btn");
		save_btn.onclick = function() {
			this.innerHTML = "<div class='loader'>Loading...</div>";
			setTimeout(() => {
				this.innerHTML = "Sign up";
				this.style = "color: #fff; pointer-event:none;";
			}, 7000);
		}
	</script>

	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/js/plugins/bootstrap.min.js"></script>
</body>

</html>