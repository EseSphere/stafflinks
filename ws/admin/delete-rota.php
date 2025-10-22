<?php

include('header-contents.php');

if (isset($_GET['col_area_Id'])) {
    $col_area_Id = $_GET['col_area_Id'];
}
//change this line in your query as well
$result = mysqli_query($conn, "SELECT * FROM tbl_manage_runs WHERE run_area_nameId='$col_area_Id' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
$row = mysqli_fetch_array($result);
$carecall_run_name = $row['col_run_name'];
?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Delete Rota</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <h5 class="card-title">Notice</h5>
                        <p class="card-text" style="font-size: 16px;">Think about this carefully.</p>
                        <p class="card-text" style="font-size: 16px;">You must understand, if you click the delete button you are going to delete the entire visits on <span style="text-decoration: underline;"><?php echo $carecall_run_name; ?></span> run from rota completely.</p>
                        <hr>
                        If this is what you want to do, then click the delete button below.
                        </p>
                        <form action="./processing-delete-rota" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="txtRunRotaId" value="<?php echo $col_area_Id; ?>" />
                                <input type="hidden" name="txtRunRotaCarerId" value="<?php echo $_SESSION['first_carer_Id']; ?>" />
                                <input type="hidden" name="txtRotaDate" value="<?php echo $_SESSION['Clientshift_Date']; ?>" />
                            </div>

                            <button class="btn btn-primary" type="button" onclick="history.back()">Go back</button>
                            <button class="btn btn-danger" name="btnDeleteRotaRun" type="submit">Yes am sure!</button>
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