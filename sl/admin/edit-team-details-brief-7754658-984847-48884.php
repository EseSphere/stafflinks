<?php

include('header-contents.php');

if (isset($_POST['btnUpdateTeamInfo'])) {

    $txtFirstBox = mysqli_real_escape_string($conn, $_REQUEST['txtFirstBox']);
    $txtSecondBox = mysqli_real_escape_string($conn, $_REQUEST['txtSecondBox']);
    $txtThirdBox = mysqli_real_escape_string($conn, $_REQUEST['txtThirdBox']);
    $txtFourthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFourthBox']);
    $txtFifthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFifthBox']);
    $txtSixthBox = mysqli_real_escape_string($conn, $_REQUEST['txtSixthBox']);
    $txtSeventhBox = mysqli_real_escape_string($conn, $_REQUEST['txtSeventhBox']);
    $txtEightthBox = mysqli_real_escape_string($conn, $_REQUEST['txtEightthBox']);
    $txtNinethBox = mysqli_real_escape_string($conn, $_REQUEST['txtNinethBox']);
    $txtTenBox = mysqli_real_escape_string($conn, $_REQUEST['txtTenBox']);
    $txtEleventhBox = mysqli_real_escape_string($conn, $_REQUEST['txtEleventhBox']);
    $txtTwelvthBox = mysqli_real_escape_string($conn, $_REQUEST['txtTwelvthBox']);
    $txtThirtenBox = mysqli_real_escape_string($conn, $_REQUEST['txtThirtenBox']);
    $txtFourtenBox = mysqli_real_escape_string($conn, $_REQUEST['txtFourtenBox']);
    $txtcompanyTeamId = mysqli_real_escape_string($conn, $_REQUEST['txtcompanyTeamId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $insert_queryIns = mysqli_query($conn, "UPDATE tbl_general_team_form SET `team_title` = '$txtFirstBox', `team_first_name` = '$txtSecondBox', `team_last_name` = '$txtThirdBox', 
    `team_middle_name` = '$txtFourthBox', `team_preferred_name` = '$txtFifthBox', `team_email_address` = '$txtSixthBox', `team_referred_to` = '$txtSeventhBox', 
    `team_date_of_birth` = '$txtEightthBox', `team_nationality` = '$txtNinethBox', `team_primary_phone` = '$txtTenBox', `team_culture_religion` = '$txtEleventhBox', `team_sexuality` = '$txtTwelvthBox'
    , `team_dbs` = '$txtThirtenBox', `team_nin` = '$txtFourtenBox' WHERE uryyTteamoeSS4 = '$txtcompanyTeamId' AND col_company_Id = '$txtCompanyId' ");
    if ($insert_queryIns) {
        if ($insert_queryIns) {
            header("Location: ./team-details?uryyTteamoeSS4=$txtcompanyTeamId");

            unset($txtFirstBox);
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

                            <form action="./edit-team-details-brief-7754658-984847-48884?uryyTteamoeSS4=<?php echo $uryyTteamoeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="txtCompanyId" />
                                <input type="hidden" value="<?php echo $uryyTteamoeSS4; ?>" name="txtcompanyTeamId" />
                                <div class="row">
                                    <div class="col-lg-2 col-2">
                                        <div class="form-group">
                                            <label for="Social number">Title</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_title'] . "" ?>" class="form-control" name="txtFirstBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-5">
                                        <div class="form-group">
                                            <label for="Social number">First name</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_first_name'] . "" ?>" class="form-control" name="txtSecondBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-5">
                                        <div class="form-group">
                                            <label for="Employee number">Last name</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_last_name'] . "" ?>" class="form-control" name="txtThirdBox" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="House number">Middle name</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_middle_name'] . "" ?>" class="form-control" name="txtFourthBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Contract type">Prefered name</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_preferred_name'] . "" ?>" class="form-control" name="txtFifthBox" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputContract">Email<span style="color: red;"></span></label>
                                        <input type="email" class="form-control" value="<?php echo "" . $get_team_row['team_email_address'] . "" ?>" name="txtSixthBox" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">Referred to</label>
                                            <input type="tel" value="<?php echo "" . $get_team_row['team_referred_to'] . "" ?>" class="form-control" name="txtSeventhBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">Date of birth</label>
                                            <input type="date" value="<?php echo "" . $get_team_row['team_date_of_birth'] . "" ?>" class="form-control" name="txtEightthBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Covid vaccination status">Nationality</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_nationality'] . "" ?>" class="form-control" name="txtNinethBox" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">Phone number</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_primary_phone'] . "" ?>" class="form-control" name="txtTenBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">Religion/Culture</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_culture_religion'] . "" ?>" class="form-control" name="txtEleventhBox" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Covid vaccination status">Gender</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_sexuality'] . "" ?>" class="form-control" name="txtTwelvthBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">DBS</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_dbs'] . "" ?>" class="form-control" name="txtThirtenBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Covid vaccination status">NIN</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_nin'] . "" ?>" class="form-control" name="txtFourtenBox" />
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