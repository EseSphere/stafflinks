<?php include_once('edit_client_details_backend.php'); ?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Update details
                                <p class="fs-6">Modify <?php echo "" . $get_team_row['client_first_name'] . "" ?> <?php echo "" . $get_team_row['client_last_name'] . "" ?>'s details</p>
                            </h5>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div style="box-shadow: rgba(0, 0, 0, 0.2) 0px 18px 50px -10px;" class="col-md-5">
                    <div style="width: 100%; height:auto; text-align:right;">
                        <a href="./client-details?<?php echo "uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none; color:#fff;" class="btn btn-info">View</a>
                    </div>
                    <form action="./edit-client-details-220059-958847-488950?uryyToeSS4=<?php echo $uryyToeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="txtCompanyId" />
                        <input type="hidden" value="<?php echo $uryyToeSS4; ?>" name="txtcompanyClientId" />
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Social number">First name</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_first_name'] . "" ?>" class="form-control" name="txtSecondBox" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Employee number">Last name</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_last_name'] . "" ?>" class="form-control" name="txtThirdBox" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="House number">Middle name</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_middle_name'] . "" ?>" class="form-control" name="txtFourthBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Contract type">Prefered name</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_preferred_name'] . "" ?>" class="form-control" name="txtFifthBox" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputContract">Email<span style="color: red;"></span></label>
                                <input type="email" class="form-control" value="<?php echo "" . $get_team_row['client_email_address'] . "" ?>" name="txtSixthBox" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Weekly contracted hours">Phone number</label>
                                    <input type="tel" value="<?php echo "" . $get_team_row['client_primary_phone'] . "" ?>" class="form-control" name="txtSeventhBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Weekly contracted hours">Date of birth</label>
                                    <input type="date" value="<?php echo "" . $get_team_row['client_date_of_birth'] . "" ?>" class="form-control" name="txtEightthBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Covid vaccination status">Address line 1 (house no)</label>
                                    <input type="number" value="<?php echo "" . $get_team_row['client_address_line_1'] . "" ?>" class="form-control" name="txtNinethBox" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="Weekly contracted hours">Address line 2 (Street name)</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_address_line_2'] . "" ?>" class="form-control" name="txtTenBox" />
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="Weekly contracted hours">City</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_city'] . "" ?>" class="form-control" name="txtEleventhBox" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Covid vaccination status">County</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_county'] . "" ?>" class="form-control" name="txtTwelvthBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Weekly contracted hours">Postal code</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_poster_code'] . "" ?>" class="form-control" name="txtThirtenBox" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Covid vaccination status">Country</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_country'] . "" ?>" class="form-control" name="txtFourtenBox" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Covid vaccination status">Culture</label>
                                    <input type="text" value="<?php echo "" . $get_team_row['client_culture_religion'] . "" ?>" class="form-control" name="txtFiftenBox" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input style="height: 45px;" type="submit" value="Update" class="btn btn-primary" name="btnUpdateClientInfo" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <div class="card shadow-sm border-0 mt-5">
                        <div class="card-header bg-danger text-white d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <h5 class="mb-0 text-white">Page Information</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Use this page to update or modify client details. Changes will automatically reflect across all related sections:</p>

                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item p-2 d-flex align-items-center">
                                    <i class="bi bi-calendar-check-fill text-success me-2"></i>
                                    <strong>Runs: </strong> Scheduled client visits and tasks.
                                </li>
                                <li class="list-group-item p-2 d-flex align-items-center">
                                    <i class="bi bi-people-fill text-info me-2"></i>
                                    <strong>Rota: </strong> Staff assignments and shifts.
                                </li>
                                <li class="list-group-item p-2 d-flex align-items-center">
                                    <i class="bi bi-person-badge-fill text-warning me-2"></i>
                                    <strong>Profile: </strong> Client personal information and history.
                                </li>
                            </ul>

                            <div class="alert alert-warning mb-0 py-2 d-flex align-items-center" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Ensure all information is accurate before submitting to avoid inconsistencies in other modules.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer-contents.php'); ?>