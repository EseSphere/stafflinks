<?php include('client-header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Delete client</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 16px;">Dear Geosoft.</p>
                        <p class="card-text" style="font-size: 16px;">You have chosen to delete this service user.</p>
                        <p class="card-text" style="font-size: 16px;">If this was the action that you wanted to do. Please confirm your choice or cancel and return to home page.</p>
                        <hr>
                        <br>Are you sure you want to delete this service user?
                        </p>

                        <?php
                        include('dbconnect.php');

                        if (isset($_GET['uryyToeSS4'])) {
                            $uryyToeSS4 = $_GET['uryyToeSS4'];
                            //change this line in your query as well
                            $result = mysqli_query($myConnection, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' ORDER BY userId DESC LIMIT 1");
                            while ($row = mysqli_fetch_array($result)) {
                        ?>

                                <form action="./processing-delete-client-system" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                    <div class="form-group">
                                        <input type="hidden" name="clientSpecialId" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                                        }
                                                                                    } ?>" />
                                    </div>

                                    <button class="btn btn-danger" name="btnDeleteClient" type="submit">Yes am sure!</button>
                                    <a href="./client-list" style="text-decoration: none;" class="btn btn-primary">Client list</a>
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