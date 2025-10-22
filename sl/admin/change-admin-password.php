<!DOCTYPE html>
<html lang="en">

<head>
    <title>GeosoftCare | Admin control panel - Change Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Geocare is a dynamic nursing and domiciliary agency based in the UK. It is built on solid partnership and experience spanning almost two decades within its management team.">
    <meta name="keywords" content="HTML, CSS, JavaScript, AJAX, PHP, MySQL">
    <meta name="author" content="Geocare Services Limited">
    <meta property="og:image" content="assets/images/gsLogo.png" />
    <meta name="twitter:image" content="assets/images/gsLogo.png" />
    <link rel="icon" href="assets/images/gsLogo.png" />
    <link rel="icon" href="assets/images/gsLogo.png" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Password strength bar */
        .strength-bar {
            height: 6px;
            border-radius: 4px;
            background-color: #ddd;
            margin-top: 5px;
            width: 100%;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0%;
            border-radius: 4px;
            transition: width 0.3s ease-in-out;
        }

        .strength-weak {
            background-color: #e74c3c;
        }

        .strength-medium {
            background-color: #f1c40f;
        }

        .strength-strong {
            background-color: #2ecc71;
        }

        .strength-text {
            font-size: 12px;
            margin-top: 3px;
            text-align: left;
            font-weight: 500;
        }

        /* Tooltip hint */
        .password-hint {
            font-size: 12px;
            color: #555;
            margin-top: 5px;
            background-color: #f9f9f9;
            padding: 10px;
            border-left: 3px solid #007bff;
            border-radius: 4px;
        }

        .password-hint ul {
            margin: 0;
            padding-left: 18px;
        }

        .password-hint li {
            margin-bottom: 3px;
        }

        /* Eye icon toggle */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#popupAlert').hide();
        });
    </script>

    <?php include('processing-change-admin-password.php'); ?>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <form action="./change-admin-password" method="POST" enctype="multipart/form-data" name="changePasswordForm" autocomplete="off">
                <div class="card borderless">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h4 class="f-w-400">Change Password</h4>
                                <hr>
                                <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192,57,43,1.0); color:white;">
                                    Passwords do not match. Please try again!
                                </div>

                                <input type="hidden" name="myEmail" id="myEmail" value="<?php echo htmlspecialchars($_SESSION['usr_email'] ?? '', ENT_QUOTES); ?>" required />

                                <div class="form-group mb-4 password-wrapper">
                                    <label for="Password">New Password</label>
                                    <input type="password" minlength="8" name="myPassword" class="form-control" id="Password" placeholder="Enter new password" required />
                                    <span class="toggle-password" onclick="togglePassword('Password')">&#128065;</span>

                                    <div class="strength-bar">
                                        <div id="strengthBar" class="strength-bar-fill"></div>
                                    </div>
                                    <div id="strengthText" class="strength-text"></div>

                                    <!-- Password hint tooltip -->
                                    <div class="password-hint">
                                        <strong>Password requirements:</strong>
                                        <ul>
                                            <li>At least 8 characters</li>
                                            <li>Contains uppercase and lowercase letters</li>
                                            <li>Contains numbers</li>
                                            <li>Contains special characters (e.g., !@#$%^&*)</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group mb-4 password-wrapper">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                    <input type="password" minlength="8" name="myCPassword" class="form-control" id="ConfirmPassword" placeholder="Confirm new password" required />
                                    <span class="toggle-password" onclick="togglePassword('ConfirmPassword')">&#128065;</span>
                                </div>

                                <button type="submit" id="save-btn" name="btnChangePassword" class="btn btn-primary btn-block mb-4">Change Password</button>
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
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === "password" ? "text" : "password";
        }

        // Password strength function
        const passwordInput = document.getElementById('Password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', () => {
            const val = passwordInput.value;
            let strength = 0;

            if (val.length >= 8) strength += 1;
            if (/[A-Z]/.test(val)) strength += 1;
            if (/[a-z]/.test(val)) strength += 1;
            if (/[0-9]/.test(val)) strength += 1;
            if (/[\W]/.test(val)) strength += 1;

            if (strength <= 2) {
                strengthBar.className = 'strength-bar-fill strength-weak';
                strengthBar.style.width = '40%';
                strengthText.textContent = 'Weak';
            } else if (strength <= 4) {
                strengthBar.className = 'strength-bar-fill strength-medium';
                strengthBar.style.width = '70%';
                strengthText.textContent = 'Medium';
            } else if (strength === 5) {
                strengthBar.className = 'strength-bar-fill strength-strong';
                strengthBar.style.width = '100%';
                strengthText.textContent = 'Strong';
            }
        });

        // Button loader effect
        const save_btn = document.querySelector("#save-btn");
        save_btn.onclick = function() {
            this.innerHTML = "<div class='loader'>Loading...</div>";
            setTimeout(() => {
                this.innerHTML = "Change Password";
                this.style = "color: #fff; pointer-events:none;";
            }, 7000);
        }
    </script>

    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
</body>

</html>
