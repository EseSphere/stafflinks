<?php include('client-header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Error!</h4>
                        <p style="font-size:16px; font-weight:600;">Attempted dublicate, try again!</p>
                        <hr>
                        <p style="font-size:16px; font-weight:600;" class="mb-0">Care call already exist on this run, click on the button to try again.</p>
                        <br>
                        <button class="btn btn-danger" onclick="history.back();">Go back</button>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>