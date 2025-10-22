<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <br><br><br><br>
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <div class="card">
                    <h5 class="card-header">Not successful!</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 16px;">
                            Possible error:
                            <br>
                            Start period and end period already exists.
                        </p>
                        Choose a different start and end date to create another pay run.
                        <hr>
                        </p>
                        <button onclick="history.back();" class="btn btn-danger">Go back</button>
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