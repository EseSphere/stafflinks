
<?php

ob_start();
session_start();

if ((empty($_SESSION['usr_email']))) {

    header("Location: ./index");
}
