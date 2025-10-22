<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Geosoft care - Software for care settings is a dynamic nursing, domiciliary, 
    support and agency App based in the UK. It is built on solid partnership and experience spanning almost 
    two decades within its management team.">
    <meta name="keywords" content="HTML, CSS, JavaScript, AJAX, PHP mySQL">
    <meta name="author" content="Ese Sphere IT Solution.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="./assets/images/logos/gsLogo4.png">
    <meta name="twitter:image" content="./assets/images/logos/gsLogo4.png">
    <title>Geosoft Care | Statistics Account Panel</title>
    <meta property="og:image" content="../assets/images/logos/gsLogo4.png" />
    <meta name="twitter:image" content="../assets/images/logos/gsLogo4.png" />
    <link rel="icon" href="../assets/images/logos/gsLogo4.png" />
    <link rel="icon" href="../assets/images/logos/gsLogo4.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="assets/css/external-construct.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/gsLogo4.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <?php
    session_start();
    include 'db_connection.php';
    if (isset($_SESSION['email'])) {
        header("Location: ./dashboard");
        exit();
    }
    include_once 'processing-signin.php';
    include_once 'processing-signup.php';
    include_once 'processing-reset-password.php';
    include_once 'processing-forgot-password.php';
    ?>
</head>

<body>