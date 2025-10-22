<?php

include('team-header-contents.php');
if (isset($_POST['btnUpdateTeamInfo'])) {

    $txtThirdBox = mysqli_real_escape_string($conn, $_REQUEST['txtThirdBox']);
    $txtFourthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFourthBox']);
    $txtFifthBox = mysqli_real_escape_string($conn, $_REQUEST['txtFifthBox']);
    $txtSixthBox = mysqli_real_escape_string($conn, $_REQUEST['txtSixthBox']);
    $txtSeventhBox = mysqli_real_escape_string($conn, $_REQUEST['txtSeventhBox']);
    $txtEightthBox = mysqli_real_escape_string($conn, $_REQUEST['txtEightthBox']);
    $txtcompanyTeamId = mysqli_real_escape_string($conn, $_REQUEST['txtcompanyTeamId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $insert_queryIns = mysqli_query($conn, "UPDATE tbl_team_employment SET `col_employee_no` = '$txtThirdBox', `col_team_role` = '$txtFourthBox', `col_contract_type` = '$txtFifthBox', `col_contract` = '$txtSixthBox', `col_weekly_contract_hour` = '$txtSeventhBox', `col_covid_vacin` = '$txtEightthBox' 
    WHERE (uryyTteamoeSS4 = '$txtcompanyTeamId' AND col_company_Id = '$txtCompanyId') ");
    if ($insert_queryIns) {
        if ($insert_queryIns) {
            header("Location: ./carer-onboarding?uryyTteamoeSS4=$txtcompanyTeamId");
            unset($txtThirdBox);
            unset($txtFourthBox);
            unset($txtFifthBox);
            unset($txtSixthBox);
            unset($txtSeventhBox);
            unset($txtEightthBox);
            unset($txtCompanyId);
        }
    } else {
        header("Location: ./carer-onboarding?uryyTteamoeSS4=$txtcompanyTeamId");
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
                            <h5 class="m-b-10">Employment information</h5>
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
                    }
                    $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_team_employment WHERE (uryyTteamoeSS4='$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
                    while ($get_team_row = mysqli_fetch_array($sel_team_data_result)) {
                    ?>
                        <div style="width: 100%; height:auto; text-align:right;">
                            <a href="./carer-onboarding?<?php echo "uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style="text-decoration: none; color:#000;">
                                <button class="btn btn-info">View details</button>
                            </a>
                        </div>
                        <div class="card-body" style="font-size: 16px;">
                            <div style="font-size:18px;"><span style="color:red;"><strong>Note:</strong></span> Your action is going to affect this carer availability status. Be sure you want to proceed with this action.</div>
                            <hr style="background-color: rgba(149, 165, 166,.7);">
                            <form action="./edit-team-employment?uryyTteamoeSS4=<?php echo $uryyTteamoeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="txtCompanyId" />
                                <input type="hidden" value="<?php echo $uryyTteamoeSS4; ?>" name="txtcompanyTeamId" />
                                <div class="row">
                                    <div class="col-lg-5 col-5">
                                        <div class="form-group">
                                            <label for="Employee number">Employee number</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['col_employee_no'] . "" ?>" class="form-control" placeholder="Employee number" required name="txtThirdBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label for="House number">Role</label>
                                            <select style="height: 50px;" name="txtFourthBox" class="form-control" id="">
                                                <option value="<?php echo "" . $get_team_row['col_team_role'] . "" ?>" selected><?php echo "" . $get_team_row['col_team_role'] . "" ?></option>
                                                <option value="Manager">Manager</option>
                                                <option value="Deputy Manager">Deputy Manager</option>
                                                <option value="HR">HR</option>
                                                <option value="Care Co-ordinator">Care Co-ordinator</option>
                                                <option value="Care worker non driver">Care worker non driver</option>
                                                <option value="Care worker driver">Care worker driver</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="Contract type">Contract type</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['col_contract_type'] . "" ?>" class="form-control" placeholder="Contract type" required name="txtFifthBox" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <label for="exampleInputContract">Contract<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="<?php echo "" . $get_team_row['col_contract'] . "" ?>" placeholder="Contract" required name="txtSixthBox" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Weekly contracted hours">Weekly contracted hours</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['col_weekly_contract_hour'] . "" ?>" class="form-control" placeholder="Weekly contracted hours" required name="txtSeventhBox" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Covid vaccination status">Covid vaccination status</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['col_covid_vacin'] . "" ?>" class="form-control" placeholder="Covid vaccination status" required name="txtEightthBox" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <input style="height: 45px;" type="submit" value="Update details" class="btn btn-primary" name="btnUpdateTeamInfo" />
                                    </div>
                            </form>
                        </div>
                </div>
                <div class="col-md-4">
                <?php
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