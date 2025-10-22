<?php
include('team-header-contents.php');
?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <div class="row">
            <!-- table card-1 start -->
            <section style="background-color: #eee; margin-bottom:50px;">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-6 mb-4">
                                <ol class="breadcrumb mb-0">
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <?php
                    $sel_team_data = mysqli_query($conn, "SELECT * FROM tbl_general_team_form 
                    WHERE (uryyTteamoeSS4='$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') 
                    ORDER BY userId Limit 1 ");
                    $row = mysqli_fetch_array($sel_team_data);

                    $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_team_employment 
                    WHERE (uryyTteamoeSS4='$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') 
                    ORDER BY userId Limit 1 ");
                    while ($get_team_data_row = mysqli_fetch_array($sel_team_data_result)) { ?>

                        <div class="row">
                            <div class="col-lg-1"> </div>
                            <div class="col-lg-8">
                                <h5>Employment</h5>
                                <div style="text-align: right; width:100%;">
                                    <a href="./edit-team-employment?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                        <button class="btn btn-outline-secondary">Edit</button>
                                    </a>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-body" style="font-size: 16px;">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p style="font-size: 16px;" class="mb-0 font-semibold">Start</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p style="font-size: 16px;" class="mb-0 font-bold"> <?php echo "" . $row['col_start_date'] . "" ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p style="font-size: 16px;" class="mb-0">Employee number</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p style="font-size: 16px;" class="text-muted mb-0"> <?php echo "" . $get_team_data_row['col_employee_no'] . "" ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p style="font-size: 16px;" class="mb-0">Role</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p style="font-size: 16px;" class="text-muted mb-0"> <?php echo "" . $get_team_data_row['col_team_role'] . "" ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p style="font-size: 16px;" class="mb-0">Contract type</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $get_team_data_row['col_contract_type'] . "" ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p style="font-size: 16px;" class="mb-0">Contract</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p style="font-size: 16px;" class="text-muted mb-0"> <?php echo "" . $get_team_data_row['col_contract'] . "" ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p style="font-size: 16px;" class="mb-0">Weekly contracted hours</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $get_team_data_row['col_weekly_contract_hour'] . "" ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p style="font-size: 16px;" class="mb-0">Covid vaccination status</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $get_team_data_row['col_covid_vacin'] . "";
                                                                                                } ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_team_documents WHERE (uryyTteamoeSS4='$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "')  ORDER BY userId Limit 1 ");
                                while ($get_team_data_row = mysqli_fetch_array($sel_team_data_result)) { ?>

                                    <h5>Right to work</h5>
                                    <div style="text-align: right; width:100%;">
                                        <a href="./more-documents?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                            <button class="btn btn-outline-secondary">Add More</button>
                                        </a>
                                    </div>
                                    <div class="card mb-4">
                                        <div class="card-body" style="font-size: 16px;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p style="font-size: 16px;" class="mb-0">ID</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <a style="text-decoration: none;" href="./team_documents/<?php echo "" . $get_team_data_row['col_Id_image'] . "" ?>" target="_blank">
                                                            <?php echo "" . $get_team_data_row['col_Id_image'] . "" ?>
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div style="text-align: right; width:100%;">
                                                        <a style="text-decoration: none;" href="./upload-idcard-documents?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                                            <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p style="font-size: 16px;" class="mb-0">Drivers licence</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <a style="text-decoration: none;" href="./team_documents/<?php echo "" . $get_team_data_row['col_drivers_licence_image'] . "" ?>" target="_blank">
                                                            <?php echo "" . $get_team_data_row['col_drivers_licence_image'] . "" ?>
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div style="text-align: right; width:100%;">
                                                        <a style="text-decoration: none;" href="./upload-drivers-licence-documents?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                                            <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p style="font-size: 16px;" class="mb-0">Bank statement</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <a style="text-decoration: none;" href="./team_documents/<?php echo "" . $get_team_data_row['col_bank_statement_image'] . "" ?>" target="_blank">
                                                            <?php echo "" . $get_team_data_row['col_bank_statement_image'] . "" ?>
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div style="text-align: right; width:100%;">
                                                        <a style="text-decoration: none;" href="./upload-bank-statement-documents?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                                            <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p style="font-size: 16px;" class="mb-0">Utility bill</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <a style="text-decoration: none;" href="./team_documents/<?php echo "" . $get_team_data_row['col_utility_bill_image'] . "" ?>" target="_blank">
                                                            <?php echo "" . $get_team_data_row['col_utility_bill_image'] . "" ?>
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div style="text-align: right; width:100%;">
                                                        <a style="text-decoration: none;" href="./upload-utility-bill-documents?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                                            <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p style="font-size: 16px;" class="mb-0">References</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <a style="text-decoration: none;" href="./team_documents/<?php echo "" . $get_team_data_row['col_references_image'] . "" ?>" target="_blank">
                                                            <?php echo "" . $get_team_data_row['col_references_image'] . "" ?>
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div style="text-align: right; width:100%;">
                                                        <a style="text-decoration: none;" href="./upload-references-documents?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                                            <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p style="font-size: 16px;" class="mb-0">DBS record</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <a style="text-decoration: none;" href="./team_documents/<?php echo "" . $get_team_data_row['col_dbs_records_image'] . "" ?>" target="_blank">
                                                            <?php echo "" . $get_team_data_row['col_dbs_records_image'] . ""; ?>
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div style="text-align: right; width:100%;">
                                                        <a style="text-decoration: none;" href="./upload-dbs-record-documents?<?php echo "uryyTteamoeSS4=" . $get_team_data_row['uryyTteamoeSS4'] . "";
                                                                                                                            } ?>" style="text-decoration: none;">
                                                            <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $sel_more_documents = mysqli_query($conn, "SELECT * FROM tbl_documents 
                                            WHERE (uryyTteamoeSS4='$uryyTteamoeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') 
                                            ORDER BY userId ASC");
                                            while ($row_more_documents = mysqli_fetch_array($sel_more_documents)) {
                                                echo "
                                            <hr>
                                            <div class='row'>
                                                <div class='col-sm-4'>
                                                    <p style='font-size: 16px;' class='mb-0'>" . $row_more_documents['col_description'] . "</p>
                                                </div>
                                                <div class='col-sm-5'>
                                                    <p style='font-size: 16px;' class='text-muted mb-0'>
                                                        <a style='text-decoration: none;' href='./team_documents/" . $row_more_documents['col_document'] . "' target='_blank'>
                                                            " . $row_more_documents['col_document'] . "
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class='col-sm-3'>
                                                    <div style='text-align: right; width:100%;'>
                                                        <a style='text-decoration: none;' href='./edit-documents?userId=" . $row_more_documents['userId'] . "' style='text-decoration: none;'>
                                                            <button class='btn btn-outline-secondary btn-sm'>Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            ";
                                            } ?>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                </div>
            </section>


            <?php include('bottom-panel-block.php'); ?>


        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>