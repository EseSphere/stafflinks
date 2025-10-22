<?php
include('db-connect.php');

// Check if form is submitted
if (isset($_POST['btnSubmitform'])) {

  // Sanitize and validate inputs
  $fullName = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_POST['fullName'])));
  $email = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_POST['myEmail'])));
  $txtSelectCurrentCity = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_POST['txtSelectCurrentCity'])));
  $pass = htmlspecialchars(strip_tags(mysqli_real_escape_string($conn, $_POST['myPassword'])));

  // Validate password complexity
  $passwordError = '';
  if (
    strlen($pass) < 8 ||
    !preg_match('/[A-Z]/', $pass) ||
    !preg_match('/[a-z]/', $pass) ||
    !preg_match('/[0-9]/', $pass) ||
    !preg_match('/[\W]/', $pass)
  ) {
    $passwordError = "Password must be at least 8 characters long and contain uppercase, lowercase, number, and special character.";
  }

  if ($passwordError !== '') {
    echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
        let popup = document.getElementById('popupAlert');
        popup.style.display = 'block';
        popup.innerText = '$passwordError';
      });
    </script>";
    exit();
  }

  // Generate unique IDs
  function generateUUIDv4()
  {
    $data = random_bytes(16);
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
    return strtoupper(bin2hex(substr($data, 0, 4)) . '-' .
      bin2hex(substr($data, 4, 2)) . '-' .
      bin2hex(substr($data, 6, 2)) . '-' .
      bin2hex(substr($data, 8, 2)) . '-' .
      bin2hex(substr($data, 10, 6)));
  }

  $specialId = 'USR-' . generateUUIDv4();

  $colCompanyId = 'CMP-' . strtoupper(substr(md5(uniqid(time(), true)), 0, 8));
  $verificationCode = strtoupper(substr(md5(time() . rand()), 0, 6));
  $myPass = hash('sha256', $pass);

  // Function to detect user IP
  function getUserIP()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
      return $_SERVER['REMOTE_ADDR'];
    }
  }

  $userIp = getUserIP();

  $myCountry = 'Unknown';
  $ipApiUrl = "http://ip-api.com/json/{$userIp}?fields=status,country";
  $ipData = @file_get_contents($ipApiUrl);
  if ($ipData !== false) {
    $ipInfo = json_decode($ipData, true);
    if ($ipInfo && $ipInfo['status'] === 'success') {
      $myCountry = $ipInfo['country'];
    }
  }

  $status = 'Not Verified';
  $finance_access2 = 'Denied';
  $lastLogin = date("Y-m-d H:i:s");

  $checkUser = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users WHERE user_email_address = '$email'");
  $userExists = mysqli_num_rows($checkUser);

  if ($userExists > 0) {
    $updateUser = mysqli_query($conn, "
      UPDATE tbl_goesoft_users 
      SET 
        user_fullname = '$fullName',
        user_password = '$myPass',
        user_special_Id = '$specialId',
        verification_code = '$verificationCode',
        status = '$status',
        my_city = '$txtSelectCurrentCity',
        my_ip = '$userIp',
        my_country = '$myCountry',
        finance_access2 = '$finance_access2',
        last_login = '$lastLogin'
      WHERE user_email_address = '$email'
    ");

    if ($updateUser) {
      $subject = "Verify your updated WorkSphere Account";
      $headers = "From: it@worksphere.co.uk\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      $message = "
        <html>
        <body>
          <div style='width: 100%; max-width: 700px; margin: 0 auto;'>
            <div style='padding: 20px; background-color: #4CAF50; color: white; text-align:center;'>
              <h2>Hello $fullName,</h2>
              <p>Your account details have been updated successfully.</p>
              <p>Please verify your email again using the code below:</p>
              <h1>$verificationCode</h1>
              <p>Visit <a href='https://www.worksphere.co.uk/verify-your-email' style='color:#fff;'>this link</a> to verify.</p>
            </div>
          </div>
        </body>
        </html>";

      mail($email, $subject, $message, $headers);

      echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          let popup = document.getElementById('popupAlert');
          popup.style.display = 'block';
          popup.style.backgroundColor = 'rgba(52, 152, 219,1.0)';
          popup.innerText = 'Account updated successfully! Redirecting...';
          setTimeout(function() {
            window.location.href = './verify-your-email';
          }, 3000);
        });
      </script>";
      exit();
    } else {
      echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          let popup = document.getElementById('popupAlert');
          popup.style.display = 'block';
          popup.innerText = 'Failed to update user information. Please try again.';
        });
      </script>";
      exit();
    }
  } else {
    $insertUser = mysqli_query($conn, "INSERT INTO tbl_goesoft_users (
            user_fullname,
            user_email_address,
            user_password,
            user_special_Id,
            verification_code,
            status,
            my_city,
            my_ip,
            my_country,
            finance_access2,
            last_login
        ) VALUES (
            '$fullName',
            '$email',
            '$myPass',
            '$specialId',
            '$verificationCode',
            '$status',
            '$txtSelectCurrentCity',
            '$userIp',
            '$myCountry',
            '$finance_access2',
            '$lastLogin'
        )");

    if ($insertUser) {
      // Send verification email for new user
      $subject = "Verify your WorkSphere Account";
      $headers = "From: it@worksphere.co.uk\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      $message = "
        <html>
        <body>
          <div style='width: 100%; max-width: 700px; margin: 0 auto;'>
            <div style='padding: 20px; background-color: #4CAF50; color: white; text-align:center;'>
              <h2>Welcome to WorkSphere, $fullName!</h2>
              <p>Your account has been created successfully.</p>
              <p>Please verify your email using the code below:</p>
              <h1>$verificationCode</h1>
              <p>Visit <a href='https://www.worksphere.co.uk/verify-your-email' style='color:#fff;'>this link</a> to verify.</p>
            </div>
          </div>
        </body>
        </html>";

      mail($email, $subject, $message, $headers);

      echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          let popup = document.getElementById('popupAlert');
          popup.style.display = 'block';
          popup.style.backgroundColor = 'rgba(46, 204, 113,1.0)';
          popup.innerText = 'Account created successfully! Redirecting...';
          setTimeout(function() {
            window.location.href = './verify-your-email';
          }, 3000);
        });
      </script>";
      exit();
    } else {
      echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          let popup = document.getElementById('popupAlert');
          popup.style.display = 'block';
          popup.innerText = 'An unexpected error occurred. Please try again.';
        });
      </script>";
      exit();
    }
  }
}
