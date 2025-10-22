<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <div class="card">
                    <h5 class="card-header">Notice</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 18px;"><strong>Delete medication</strong></p>
                        <p class="card-text" style="font-size: 16px;">If this was the action that you wanted to do. Please confirm your choice or cancel and return to home page.</p>
                        <hr>
                        Are you sure you want to delete this medication?
                        </p>

                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM tbl_clients_medication_records WHERE med_Id=$_GET[med_Id] AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <form action="./processing-client-meds-delete-system" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" name="MedsSpecialId" value="<?php echo "" . $row['med_Id'] . ""; ?>" />
                                    <input type="hidden" name="myEcrypted" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                                } ?>" />
                                </div>

                                <button onclick="history.back()" class="btn btn-primary">Go back</button>
                                <button class="btn btn-danger" name="btnDeleteMedication" type="submit">Yes am sure!</button>
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