<?php

include('team-header-contents.php');

if (isset($_POST['btnUpdateDocInfo'])) {
    $target = "team_documents/" . basename($_FILES['file']['name']);

    $txtDocument =  mysqli_real_escape_string($conn, $_FILES['file']['name']);
    $txtDescription = mysqli_real_escape_string($conn, $_REQUEST['txtDescription']);
    $txtcompanyTeamId = mysqli_real_escape_string($conn, $_REQUEST['txtcompanyTeamId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    if (is_uploaded_file($_FILES['file']['tmp_name']) and copy($_FILES['file']['tmp_name'], $target)) {
        $insert_queryIns = mysqli_query($conn, "UPDATE tbl_documents SET `col_description` = '$txtDescription', `col_document` = '$txtDocument' 
        WHERE (userId = '$txtcompanyTeamId' AND col_company_Id = '$txtCompanyId') ");
        if ($insert_queryIns) {
            unset($txtDescription);
            unset($txtDocument);
            unset($txtcompanyTeamId);
            unset($txtCompanyId);
        }
    } else {
        header("Location: ./carer-onboarding?uryyTteamoeSS4=$txtcompanyTeamId");
    }
}

?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Upload more document <br>
                                <small>More documents</small>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <?php
                    //change this line in your query as well
                    $myUserId = $_GET['userId'];
                    $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_documents WHERE (userId = '$myUserId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                    while ($get_team_row = mysqli_fetch_array($sel_team_data_result)) {
                    ?>
                        <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                            <form action="./edit-documents?uryyTteamoeSS4=<?php echo $uryyTteamoeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="txtCompanyId" />
                                <input type="hidden" value="<?php echo $myUserId; ?>" name="txtcompanyTeamId" />
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label for="Description">Description</label>
                                            <input type="text" name="txtDescription" class="form-control" required value="<?php echo "" . $get_team_row['col_description'] . "" ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="More documents">Document <span style="color:rgba(189, 195, 199,1.0);">(Optional)</span></label>
                                            <input type="text" disabled value="--" class="form-control" placeholder="--" />
                                            <div>
                                                <label for="files" class="btn btn-dark btn-sm">Upload Doc</label>
                                                <input id="files" multiple onchange="GetFileSizeNameAndType()" value="<?php echo "" . $get_team_row['col_document'] . "" ?>" name="file" style="visibility:hidden;" type="file">
                                            </div>
                                        </div>
                                        <div style="margin-top: -10px;" class="form-group">
                                            <div id="fp"></div>
                                            <p>
                                            <div id="divTotalSize"></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input style="height: 45px;" type="submit" value="Update Document" class="btn btn-primary" name="btnUpdateDocInfo" />
                                </div>
                            </form>
                        </div>
                </div>
                <div class="col-md-8">
                    <div class="form-cover" style="font-weight:800; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                        <h5>Document view</h5>
                        <!--<iframe frameborder="0" scrolling="no" width="100%" height="100%"
                                    src="./team_documents/" name="imgbox" id="imgbox">
                                </iframe>-->
                        <img style="width: 100%; height:auto;" src="./team_documents/<?php echo "" . $get_team_row['col_document'] . "" ?>" alt="">
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>




</div>
<!-- Latest Customers end -->
</div>
<!-- [ Main Content ] end -->



<?php include('footer-contents.php'); ?>