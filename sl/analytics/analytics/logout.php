<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

session_unset();
session_destroy();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
header("Location: ./");
exit();
