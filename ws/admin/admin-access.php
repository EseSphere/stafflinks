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
                <h5>Admin Access</h5>
                <hr>
                <div class="card">
                    <h5 class="card-header">Grant Full Access</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 16px;">
                            By granting this user access to the administrative portal, you acknowledge and authorize that the user will have full permissions to manage and oversee all system activities, settings, and user-related operations within the platform.
                        </p>
                        <hr>
                        <p class="card-text" style="font-size: 16px;">
                            Are you certain you want to proceed with granting full administrative access to this user? This action will provide them with unrestricted control over key system functionalities.
                        </p>
                        </p>
                        <form action="./processing-admin-grant" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="adminSpecialId" value="<?= $user_special_Id; ?>" />
                            </div>
                            <button class="btn btn-danger" name="btnGrantAccess" type="submit">Yes am sure!</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>