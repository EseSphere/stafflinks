<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Delete admin</h5>
                <hr>
                <div class="card">
                    <h5 class="card-header">Delete</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <h5 class="card-title">Delete notice</h5>
                        <p class="card-text" style="font-size: 16px;">Dear Geosoft.</p>
                        <p class="card-text" style="font-size: 16px;">You have chosen to delete this admin.</p>
                        <p class="card-text" style="font-size: 16px;">If this was the action that you wanted to do. Please confirm your choice or cancel and return to home page.</p>
                        <hr>
                        <br>Are you sure you want to delete this admin?
                        </p>

                        <?php
                        include('dbconnect.php');

                        if (isset($_GET['user_special_Id'])) {
                            $user_special_Id = $_GET['user_special_Id'];
                            //change this line in your query as well
                            $result = mysqli_query($myConnection, "SELECT * FROM tbl_goesoft_users WHERE user_special_Id='$user_special_Id'");
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <form action="./processing-admin-delete-system" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                    <div class="form-group">
                                        <input type="hidden" name="adminSpecialId" value="<?php echo "" . $row['user_special_Id'] . "";
                                                                                        }
                                                                                    } ?>" />
                                    </div>

                                    <button class="btn btn-danger" name="btnDeleteAdmin" type="submit">Yes am sure!</button>
                                    <a href="./administrator-list" style="text-decoration: none;" class="btn btn-primary">Go back</a>
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