<?php
include('header-contents.php');
if (isset($_GET['user_special_Id'])) {
    $user_special_Id = $_GET['user_special_Id'];
}
?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Deactivate admin</h5>
                <hr>
                <div class="card">
                    <h5 class="card-header">Deactivate</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 16px;">Are you aware by deactivating this account the user will no longer have access to this portal and therefor won't be able to manage the overall activities?</p>
                        <p class="card-text" style="font-size: 16px;">This user wil also be restricted from all details and access to this platform.</p>
                        <hr>
                        <p class="card-text" style="font-size: 16px;">You won't be able to re-activate this user anytime soon.
                            <br>Are you sure you want to proceed with this deactivation?
                        </p>
                        <form action="./processing-deactivate-admin" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
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

    </div>
</div>


<?php include('footer-contents.php'); ?>