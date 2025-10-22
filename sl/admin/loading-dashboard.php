<?php require_once "./header.php"; ?>

<div id="pageLoader">
    <img src="./assets/images/logo-gif.gif" alt="StaffLinks Logo" class="logo-icon">
    <h4 class="fs-3 fw-bold">Please wait...</h4>
</div>
<script>
    setTimeout(function() {
        window.location.href = './dashboard';
    }, 5000);
</script>

<?php require_once "./footer.php"; ?>