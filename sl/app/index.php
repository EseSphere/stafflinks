<?php require_once('header-log.php'); ?>

<!-- Redirect to log.php after 2 seconds-->
<script>
    setTimeout(function() {
        window.location.href = "log.php";
    }, 3000); // 2000 milliseconds = 2 seconds
</script>

<!-- Splash Screen Container -->
<div class="container-fluid" id="splash-screen" style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color:#fff;">
    <div id="splash-logo" class="img-logo">
        <img id="logoAnime" src="./images/log-anime.gif" alt="StaffLinks Logo" style="width: 100%; height: 100%; opacity: 0; transform: translateY(50px); transition: all 1s ease;">
    </div>
</div>

<script>
    // Slide-in animation for logo
    document.addEventListener("DOMContentLoaded", () => {
        const logo = document.getElementById("logoAnime");
        setTimeout(() => {
            logo.style.opacity = "1";
            logo.style.transform = "translateY(0)";
        }, 100); // small delay before animation
    });
</script>

<?php require_once('footer-log.php'); ?>