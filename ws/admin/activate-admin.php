<?php
include('header-contents.php');
if (isset($_GET['user_special_Id'])) {
    $user_special_Id = $_GET['user_special_Id'];
}
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Activate admin</h5>
                <hr>
                <div class="card">
                    <h5 class="card-header">Activate</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 16px;">Welcome back. Please note that by activating this user, you are granting them full access and administrative control over all platform activities.</p>
                        <p class="card-text" style="font-size: 16px;">This includes the ability to manage and perform all available operations.</p>
                        <hr>
                        <p class="card-text" style="font-size: 16px;">Are you sure you want to grant this level of access to the user?</p>
                        </p>
                        <form action="./processing-activate-admin" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="adminSpecialId" value="<?= $user_special_Id; ?>" />
                            </div>
                            <button class="btn btn-danger" name="btnDeactivateAdmin" type="submit">Yes am sure!</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>