<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Delete purchase order</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <h5 class="card-title">Delete notice</h5>
                        <p class="card-text" style="font-size: 16px;">If this was the action that you wanted to do. Please confirm your choice or cancel and return to purchase order.</p>
                        <hr>
                        </p>

                        <?php
                        if (isset($_GET['col_special_Id'])) {
                            $col_special_Id = $_GET['col_special_Id'];
                            //change this line in your query as well
                            $result = mysqli_query($conn, "SELECT * FROM tbl_purchase_order WHERE col_special_Id='$col_special_Id'");
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <form action="./processing-purchase-delete-system" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                    <div class="form-group">
                                        <input type="hidden" name="purchaseSpecialId" value="<?php echo "" . $row['col_special_Id'] . "";
                                                                                            }
                                                                                        } ?>" />
                                    </div>

                                    <button class="btn btn-danger" name="btnDeletePurchase" type="submit">Yes am sure!</button>
                                    <a href="./purchase-orders" style="text-decoration: none;" class="btn btn-primary">Go back</a>
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