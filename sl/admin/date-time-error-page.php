<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Error message</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 16px;">Possible error!
                            <br>
                            - Time in must not be less than time out
                            <br>
                            - The time out might either be behind client start time or same.
                            <br>
                            - Care call might already exist on the same date
                        </p>
                        <hr>
                        Kindly go back and try again.
                        </p>
                        <button class="btn btn-info" onclick="history.back();">Go back</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>