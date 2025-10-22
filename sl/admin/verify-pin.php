<!DOCTYPE html>
<html lang="en">

<head>
    <title>GeosoftCare | Admin control panel - Verify PIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Geocare is a dynamic nursing and domiciliary agency based in the UK. It is built on solid partnership and experience spanning almost two decades within its management team.">
    <meta name="keywords" content="HTML, CSS, JavaScript, AJAX, PHP mySQL">
    <meta name="author" content="Geocare Services Limited">
    <meta property="og:image" content="assets/images/gsLogo.png" />
    <meta name="twitter:image" content="assets/images/gsLogo.png" />
    <link rel="icon" href="assets/images/gsLogo.png" />
    <link rel="icon" href="assets/images/gsLogo.png" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .pin-inputs {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .pin-inputs input {
            width: 45px;
            height: 50px;
            text-align: center;
            font-size: 22px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: all 0.2s ease-in-out;
        }

        .pin-inputs input:focus {
            border-color: #007bff;
            box-shadow: 0 0 4px #007bff;
        }

        @media (max-width: 400px) {
            .pin-inputs input {
                width: 40px;
                height: 45px;
                font-size: 18px;
            }
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#popupAlert').hide();
        });
    </script>

    <?php include('processing-verify-pin.php'); ?>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content text-center">
            <form action="./verify-pin" method="POST" enctype="multipart/form-data" name="verifyPinForm" autocomplete="off">
                <div class="card borderless">
                    <div class="row align-items-center text-center">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h4 class="f-w-400">Verify PIN</h4>
                                <hr>
                                <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                    Invalid PIN. Please try again!
                                </div>

                                <p class="mb-3 alert alert-info" style="font-size:14px;">Enter the 5-digit PIN sent to your email address.</p>

                                <!-- 5 separate input boxes for the PIN -->
                                <div class="form-group mb-4 pin-inputs">
                                    <input type="text" maxlength="1" class="pin" id="pin1" required>
                                    <input type="text" maxlength="1" class="pin" id="pin2" required>
                                    <input type="text" maxlength="1" class="pin" id="pin3" required>
                                    <input type="text" maxlength="1" class="pin" id="pin4" required>
                                    <input type="text" maxlength="1" class="pin" id="pin5" required>
                                </div>

                                <!-- Hidden field to store combined PIN -->
                                <input type="hidden" name="resetPin" id="resetPin">

                                <button type="submit" id="verify-btn" name="btnVerifyPin" class="btn btn-primary btn-block mb-4">Verify PIN</button>
                                <hr>
                                <p class="mb-2"><a href="./auth-reset-password" class="f-w-400">Go back</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Automatically move between PIN boxes
        const inputs = document.querySelectorAll(".pin");
        inputs.forEach((input, index) => {
            input.addEventListener("input", () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHiddenPin();
            });

            input.addEventListener("keydown", (e) => {
                if (e.key === "Backspace" && input.value === "" && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Combine all 5 digits into one hidden field
        function updateHiddenPin() {
            const pin = Array.from(inputs).map(i => i.value).join("");
            document.getElementById("resetPin").value = pin;
        }

        // Button animation
        verify_btn = document.querySelector("#verify-btn");
        verify_btn.onclick = function() {
            this.innerHTML = "<div class='loader'>Verifying...</div>";
            setTimeout(() => {
                this.innerHTML = "Verify PIN";
                this.style = "color: #fff; pointer-event:none;";
            }, 7000);
        }
    </script>

    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
</body>

</html>
