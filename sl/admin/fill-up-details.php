<?php

include('team-header-contents.php');

if (isset($_POST['btnUpdateTeamInfo'])) {



    $txtFirstName = mysqli_real_escape_string($conn, $_REQUEST['txtFirstName']);
    $txtLastName = mysqli_real_escape_string($conn, $_REQUEST['txtLastName']);
    $txtfirstBox = "Null";
    $txtSecondBox = "Null";
    $txtThirdBox = "Null";
    $txtFourthBox = "Null";
    $txtFiftBox = "Null";
    $txtSixthBox = "Null";
    $txtSeventBox = "Null";
    $txtEightBox = "Null";
    $txtcompanyTeamId = mysqli_real_escape_string($conn, $_REQUEST['txtcompanyTeamId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);


    $insert_employees_data_queryIns = mysqli_query($conn, "INSERT INTO tbl_team_employment (col_first_name, col_last_name, col_social_worker, col_employee_no, col_team_role, col_contract_type, col_contract, col_weekly_contract_hour, col_covid_vacin, col_transportation, uryyTteamoeSS4, col_company_Id) 
VALUES('" . $txtFirstName . "', '" . $txtLastName . "', '" . $txtfirstBox . "', '" . $txtSecondBox . "', '" . $txtThirdBox . "', '" . $txtFourthBox . "', '" . $txtFiftBox . "', '" . $txtSixthBox . "', '" . $txtSeventBox . "', '" . $txtEightBox . "', '" . $txtcompanyTeamId . "', '" . $txtCompanyId . "' ) ");
    if ($insert_employees_data_queryIns) {
        $txtfirstDocs = "Null";
        $txtSecondDocs = "Null";
        $txtThirdDocs = "Null";
        $txtFourthDocs = "Null";
        $txtFiftDocs = "Null";
        $txtSixthDocs = "Null";
        $insert_employees_docs_queryIns = mysqli_query($conn, "INSERT INTO tbl_team_documents (col_Id_image, col_drivers_licence_image, col_bank_statement_image, col_utility_bill_image, col_references_image, col_dbs_records_image, uryyTteamoeSS4, col_company_Id) 
VALUES('" . $txtfirstDocs . "', '" . $txtSecondDocs . "', '" . $txtThirdDocs . "', '" . $txtFourthDocs . "', '" . $txtFiftDocs . "', '" . $txtSixthDocs . "', '" . $txtcompanyTeamId . "', '" . $txtCompanyId . "' ) ");
        if ($insert_employees_docs_queryIns) {
            header("Location: ./carer-onboarding?uryyTteamoeSS4=$txtcompanyTeamId");
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
                            <h5 class="m-b-10">Add details</h5>
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
                                <a href="./carer-onboarding?<?php echo "uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style="text-decoration: none; color:#000;">
                                    <button class="btn btn-info">View details</button>
                                </a>
                            </div>

                            <form action="./fill-up-details?uryyTteamoeSS4=<?php echo $uryyTteamoeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="txtCompanyId" />
                                <input type="hidden" value="<?php echo $uryyTteamoeSS4; ?>" name="txtcompanyTeamId" />
                                <input type="hidden" value="<?php echo "" . $get_team_row['team_first_name'] . ""; ?>" name=" txtFirstName" />
                                <input type="hidden" value="<?php echo "" . $get_team_row['team_last_name'] . ""; ?>" name="txtLastName" />

                                <div class="row">

                                    <div class="form-group">
                                        <input style="height: 45px;" type="submit" value="Insert details" class="btn btn-primary" name="btnUpdateTeamInfo" />
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