<?php include('client-header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Error!</h4>
                        <p style="font-size:16px; font-weight:600;">Duplicate entry detected!</p>
                        <hr>
                        <p style="font-size:16px; font-weight:600;" class="mb-0">
                            This email address already exists in the system. Please use a different email or go back to try again.
                        </p>
                        <br>
                        <button class="btn btn-danger" onclick="window.location.href='add-new-team.php';">Go back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>