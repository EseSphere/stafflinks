<?php include('client-header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <?php
                if (isset($_GET['uryyToeSS4'])) {
                    $uryyToeSS4 = $_GET['uryyToeSS4'];
                ?>
                    <a href="./setup-visits<?php echo "?uryyToeSS4=$uryyToeSS4";
                                        } ?>" style="text-decoration: none;">
                        <button class="btn btn-small btn-primary">Setup visit</button>
                    </a>
                    <a href="./download-visit" style="text-decoration: none;">
                        <button class="btn btn-small btn-info">Download visits</button>
                    </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>

            <div class="col-md-4 col-xl-7">
                <br><br>
                <br><br>
                <h3>Notice</h3>
                <hr>
                <h5>
                    Client visit is empty.
                    <br>
                    Kindly assign some calls to view client visits.
                </h5>
            </div>
        </div>
        <div class="col-md-4 col-xl-3"></div>
    </div>
    <!-- [ delete box ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>