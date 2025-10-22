<?php

include('header-contents.php');

if (isset($_POST['btnUpdateTeamInfo'])) {

    $txtSecondBox = mysqli_real_escape_string($conn, $_REQUEST['txtSecondBox']);
    $txtThirdBox = mysqli_real_escape_string($conn, $_REQUEST['txtThirdBox']);
    $txtFourthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFourthBox']);
    $txtFifthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFifthBox']);
    $txtSixthBox = mysqli_real_escape_string($conn, $_REQUEST['txtSixthBox']);
    $txtSeventhBox = mysqli_real_escape_string($conn, $_REQUEST['txtSeventhBox']);
    $txtEightthBox = mysqli_real_escape_string($conn, $_REQUEST['txtEightthBox']);
    $txtNinethBox = mysqli_real_escape_string($conn, $_REQUEST['txtNinethBox']);
    $txtTenBox = mysqli_real_escape_string($conn, $_REQUEST['txtTenBox']);
    $txtcompanyTeamId = mysqli_real_escape_string($conn, $_REQUEST['txtcompanyTeamId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $insert_queryIns = mysqli_query($conn, "UPDATE tbl_general_team_form SET `team_address_line_1` = '$txtSecondBox', `team_address_line_2` = '$txtThirdBox', 
    `team_city` = '$txtFourthBox', `team_county` = '$txtFifthBox', `team_poster_code` = '$txtSixthBox', `team_country` = '$txtSeventhBox', 
    `transportation` = '$txtEightthBox', `employment_type` = '$txtNinethBox', `col_start_date` = '$txtTenBox' WHERE uryyTteamoeSS4 = '$txtcompanyTeamId' AND col_company_Id = '$txtCompanyId' ");
    if ($insert_queryIns) {
        if ($insert_queryIns) {
            header("Location: ./team-details?uryyTteamoeSS4=$txtcompanyTeamId");

            unset($txtSecondBox);
            unset($txtThirdBox);
            unset($txtFourthBox);
            unset($txtFifthBox);
            unset($txtSixthBox);
            unset($txtSeventhBox);
            unset($txtEightthBox);
            unset($txtNinethBox);
            unset($txtcompanyTeamId);
            unset($txtCompanyId);
        }
    } else {
        header("Location: ./team-details?uryyTteamoeSS4=$txtcompanyTeamId");
    }
}

?>


<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }
</style>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit team details</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="container">

            <div class="row">
                <div class="col-md-8">

                    <?php
                    //change this line in your query as well
                    if (isset($_GET['uryyTteamoeSS4'])) {
                        $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                        $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4='$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                        while ($get_team_row = mysqli_fetch_array($sel_team_data_result)) {
                    ?>

                            <div style="width: 100%; height:auto; text-align:right;">
                                <a href="./team-details?<?php echo "uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style="text-decoration: none; color:#000;">
                                    <button class="btn btn-info">View details</button>
                                </a>
                            </div>

                            <form action="./edit-team-details-brief-7754658-984847-884735465?uryyTteamoeSS4=<?php echo $uryyTteamoeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="txtCompanyId" />
                                <input type="hidden" value="<?php echo $uryyTteamoeSS4; ?>" name="txtcompanyTeamId" />
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="Social number">Address line 1 (House no)</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_address_line_1'] . "" ?>" class="form-control" name="txtSecondBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="Employee number">Address line 2 (Street name)</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_address_line_2'] . "" ?>" class="form-control" name="txtThirdBox" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="House number">City</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_city'] . "" ?>" class="form-control" name="txtFourthBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Contract type">County</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_county'] . "" ?>" class="form-control" name="txtFifthBox" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputContract">Postal code<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="<?php echo "" . $get_team_row['team_poster_code'] . "" ?>" name="txtSixthBox" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">Country</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_country'] . "" ?>" class="form-control" name="txtSeventhBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">transportation</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['transportation'] . "" ?>" class="form-control" name="txtEightthBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Covid vaccination status">Employment type</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['employment_type'] . "" ?>" class="form-control" name="txtNinethBox" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">Start date</label>
                                            <input type="date" value="<?php echo "" . $get_team_row['col_start_date'] . "" ?>" class="form-control" name="txtTenBox" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <input style="height: 45px;" type="submit" value="Update details" class="btn btn-primary" name="btnUpdateTeamInfo" />
                                    </div>
                            </form>
                </div>
                <div class="col-md-4">


            <?php
                        }
                    }
            ?>
                </div>
            </div>
            <br>
        </div>
    </div>





</div>
<!-- Latest Customers end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>