<?php
ob_start();
session_start();

$redirectUrl = 'https://admin.stafflinks.co.uk';
if (isset($_SESSION['usr_email'])) {
	unset($_SESSION['usr_compId'], $_SESSION['usr_email']);
}

session_destroy();
header("Location: $redirectUrl");
exit;
