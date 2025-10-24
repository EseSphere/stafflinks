<?php
require_once "./header.php";
include('processing-signup.php');
$email = $_GET['email'];
?>

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
								<input type="email" name="myEmail" class="form-control" readonly value="<?= $email ?>" required />
							</div>
							<hr>
							<div class="form-group mb-3">
								<label for="txtSelectCurrentCity" style="float:left;">What city is your company located?</label>
								<select name="txtSelectCurrentCity" id="txtSelectCurrentCity" class="form-control" required>
									<option value="">-- Select City --</option>
									<option value="London">London</option>
									<option value="Birmingham">Birmingham</option>
									<option value="Manchester">Manchester</option>
									<option value="Leeds">Leeds</option>
									<option value="Liverpool">Liverpool</option>
									<option value="Sheffield">Sheffield</option>
									<option value="Bristol">Bristol</option>
									<option value="Leicester">Leicester</option>
									<option value="Coventry">Coventry</option>
									<option value="Bradford">Bradford</option>
									<option value="Cardiff">Cardiff</option>
									<option value="Nottingham">Nottingham</option>
									<option value="Newcastle upon Tyne">Newcastle upon Tyne</option>
									<option value="Sunderland">Sunderland</option>
									<option value="Hull">Hull</option>
									<option value="Stoke-on-Trent">Stoke-on-Trent</option>
									<option value="Derby">Derby</option>
									<option value="Southampton">Southampton</option>
									<option value="Portsmouth">Portsmouth</option>
									<option value="Plymouth">Plymouth</option>
									<option value="Wolverhampton">Wolverhampton</option>
									<option value="Milton Keynes">Milton Keynes</option>
									<option value="Aberdeen">Aberdeen</option>
									<option value="Edinburgh">Edinburgh</option>
									<option value="Glasgow">Glasgow</option>
									<option value="Dundee">Dundee</option>
									<option value="Swansea">Swansea</option>
									<option value="Belfast">Belfast</option>
									<option value="Luton">Luton</option>
									<option value="York">York</option>
									<option value="Peterborough">Peterborough</option>
									<option value="Oxford">Oxford</option>
									<option value="Cambridge">Cambridge</option>
									<option value="Exeter">Exeter</option>
									<option value="Norwich">Norwich</option>
									<option value="Chelmsford">Chelmsford</option>
									<option value="Canterbury">Canterbury</option>
									<option value="Chester">Chester</option>
									<option value="Lincoln">Lincoln</option>
									<option value="Lancaster">Lancaster</option>
									<option value="Bath">Bath</option>
									<option value="Hereford">Hereford</option>
									<option value="Worcester">Worcester</option>
									<option value="Salisbury">Salisbury</option>
									<option value="Winchester">Winchester</option>
									<option value="Durham">Durham</option>
									<option value="Carlisle">Carlisle</option>
									<option value="Inverness">Inverness</option>
									<option value="Stirling">Stirling</option>
									<option value="Perth">Perth</option>
									<option value="Lisburn">Lisburn</option>
									<option value="Derry">Derry</option>
									<option value="Newport">Newport</option>
								</select>
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

							<button type="submit" id="save-btn" name="btnSignUp" class="btn btn-primary btn-block mb-4" disabled>Create account</button>
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

<?php include('./footer.php'); ?>