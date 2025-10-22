<?php include('client-header-contents.php'); ?>

<?php
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}
?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">
                        <button onclick="history.back()" style="background-color: inherit; border:none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg></button> Notice
                    </h5>
                    <div class="card-body" style="font-size: 18px;">
                        <p class="card-text" style="font-size: 18px;"><strong>Can't proceed!</strong></p>
                        Kindly select invoice option for the cancellation.
                        <hr>
                        <button onclick="history.back();" class="btn btn-info">Go back</button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>