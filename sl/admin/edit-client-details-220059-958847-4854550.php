<?php
include('client-header-contents.php');
if (isset($_POST['btnUpdateClientInfo'])) {
    $txtSecondBox = mysqli_real_escape_string($conn, $_REQUEST['txtSecondBox']);
    $txtThirdBox = mysqli_real_escape_string($conn, $_REQUEST['txtThirdBox']);
    $txtFourthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFourthBox']);
    $txtFifthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFifthBox']);
    $txtSixthBox = mysqli_real_escape_string($conn, $_REQUEST['txtSixthBox']);
    $txtSeventhBox = mysqli_real_escape_string($conn, $_REQUEST['txtSeventhBox']);
    $txtEightthBox = mysqli_real_escape_string($conn, $_REQUEST['txtEightthBox']);
    $txtNinethBox = mysqli_real_escape_string($conn, $_REQUEST['txtNinethBox']);
    $txtTenBox = mysqli_real_escape_string($conn, $_REQUEST['txtTenBox']);
    $txtcompanyClientId = mysqli_real_escape_string($conn, $_REQUEST['txtcompanyClientId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $insert_queryIns = mysqli_query($conn, "UPDATE tbl_general_client_form SET `client_referred_to` = '$txtSecondBox', `client_ailment` = '$txtThirdBox', 
    `client_culture_religion` = '$txtFourthBox', `client_sexuality` = '$txtFifthBox', `client_access_details` = '$txtSixthBox', `clientStart_date` = '$txtSeventhBox', 
    `clientEnd_date` = '$txtEightthBox', `client_area` = '$txtNinethBox', `client_highlights` = '$txtTenBox' WHERE uryyToeSS4 = '$txtcompanyClientId' AND col_company_Id = '$txtCompanyId' ");
    if ($insert_queryIns) {
        $update_tblclienttimecall = mysqli_query($conn, "UPDATE tbl_clienttime_calls SET `client_area` = '$txtNinethBox' WHERE (uryyToeSS4 = '$txtcompanyClientId' AND col_company_Id = '$txtCompanyId')");
        if ($update_tblclienttimecall) {
            header("Location: ./client-details?uryyToeSS4=$txtcompanyClientId");

            unset($txtSecondBox);
            unset($txtThirdBox);
            unset($txtFourthBox);
            unset($txtFifthBox);
            unset($txtSixthBox);
            unset($txtSeventhBox);
            unset($txtEightthBox);
            unset($txtNinethBox);
            unset($txtcompanyClientId);
            unset($txtCompanyId);
        }
    } else {
        header("Location: ./client-details?uryyToeSS4=$txtcompanyClientId");
    }
}

$sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
$get_team_row = mysqli_fetch_array($sel_team_data_result);
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

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit client details</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
                    <div style="width: 100%; height:auto; text-align:right;">
                        <a href="./client-details?<?php echo "uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none; color:#000;">
                            <button class="btn btn-info">View details</button>
                        </a>
                    </div>
                    <form action="./edit-client-details-220059-958847-4854550?uryyToeSS4=<?php echo $uryyToeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="txtCompanyId" />
                        <input type="hidden" value="<?php echo $uryyToeSS4; ?>" name="txtcompanyClientId" />
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Social number">Referred to</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_referred_to'] . "" ?>" class="form-control" name="txtSecondBox" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Employee number">Medical Condition</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_ailment'] . "" ?>" class="form-control" name="txtThirdBox" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="House number">Relogion</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_culture_religion'] . "" ?>" class="form-control" name="txtFourthBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Contract type">Gender</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_sexuality'] . "" ?>" class="form-control" name="txtFifthBox" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputContract">Access details<span style="color: red;"></span></label>
                                <input type="text" class="form-control" value="<?php echo "" . $get_team_row['client_access_details'] . "" ?>" name="txtSixthBox" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Weekly contracted hours">Start date</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['clientStart_date'] . "" ?>" class="form-control" name="txtSeventhBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Weekly contracted hours">End date</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['clientEnd_date'] . "" ?>" class="form-control" name="txtEightthBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Covid vaccination status">Client area</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_area'] . "" ?>" class="form-control" name="txtNinethBox" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="Transport method">Highlights</label>
                                    <textarea name="txtTenBox" id="" value="" class="form-control" rows="5"><?php echo "" . $get_team_row['client_highlights'] . ""; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input style="height: 45px;" type="submit" value="Update details" class="btn btn-primary" name="btnUpdateClientInfo" />
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer-contents.php'); ?>