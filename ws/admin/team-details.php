<?php
include('team-header-contents.php');
$stmt = $conn->prepare("
    SELECT gtf.*, th.* 
    FROM tbl_general_team_form AS gtf
    LEFT JOIN tbl_team_highlight AS th 
      ON gtf.uryyTteamoeSS4 = th.uryyTteamoeSS4 AND gtf.col_company_Id = th.col_company_Id
    WHERE gtf.uryyTteamoeSS4 = ? AND gtf.col_company_Id = ?
");
$stmt->bind_param("ss", $uryyTteamoeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientDOB = date('d M, Y', strtotime($row['team_date_of_birth']));
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <section style="background-color: #eee; margin-bottom:50px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-6 mb-4">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row" style="font-size: 18px; font-weight:600;">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="assets/images/user/profile-icon.jpg" alt="avatar"
                                        class="rounded-circle img-fluid" style="width: 120px;">
                                    <h5 class="my-3">
                                        <?php echo "" . $row['team_first_name'] . "&nbsp;" . $row['team_last_name'] . "" ?>
                                    </h5>
                                    <p style="font-size: 16px;" class="text-muted mb-1">
                                        <?php echo "" . $row['team_sexuality'] . "" ?></p>
                                    <p style="font-size: 16px;" class="text-muted mb-4">
                                        <?php echo "" . $row['team_city'] . ", " . $row['team_county'] . "" ?></p>
                                    <div class="d-flex justify-content-center mb-2">
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div style="width: 100%; height:auto; text-align:right; font-weight:600;">
                                    <a href="./edit-team-details-brief-7754658-984847-884735465<?php echo "?uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style="text-decoration: none;" class="btn btn-sm btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="card-body" style="font-size: 16px; font-weight:600;">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0">
                                                <a class="text-dark text-underline" href="https://www.google.com/maps?q=<?php echo urlencode($row['team_address_line_1'] . ' ' . $row['team_address_line_2'] . ', ' . $row['team_city'] . ', ' . $row['team_county'] . ', ' . $row['team_poster_code']); ?>" target="_blank">
                                                    <?php echo $row['team_address_line_1'] . " " . $row['team_address_line_2'] . ", " . $row['team_city'] . ", " . $row['team_county'] . ", " . $row['team_poster_code']; ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Nationality</p>
                                        </div>
                                        <div class="col-sm-7">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0">
                                                <?php echo "" . $row['team_nationality'] . ""; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div style="width: 100%; height:auto; text-align:right;">
                                    <a href="./edit-team-details-brief-7754658-984847-48884<?php echo "?uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style="text-decoration: none;" class="btn btn-sm btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="card-body" style="font-size: 16px; font-weight:600;">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0">
                                                <?php echo "" . $row['team_title'] . " " . $row['team_middle_name'] . " | <span>Prefered name: </span> " . $row['team_preferred_name'] . "" ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo "" . $row['team_email_address'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo "+44 " . $row['team_primary_phone'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Date of birth</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo $clientDOB ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class=" row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">DBS</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo "" . $row['team_dbs'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">NIN</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo "" . $row['team_nin'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Refered to</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo "" . $row['team_referred_to'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Culture/Religion
                                            </p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo "" . $row['team_culture_religion'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Gender</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"> <?php echo "" . $row['team_sexuality'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px; font-weight:600;" class="mb-0">Pay Rate</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px; font-weight:600;" class="text-muted mb-0"><?php echo "" . $row['col_rate_type'] . "" ?>
                                                <a href="./team-pay-rate<?php echo "?uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style='text-decoration:none;' class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Highlights</h5>
                            <a href="./team-highlight?uryyTteamoeSS4=<?php echo urlencode($uryyTteamoeSS4); ?>" class="btn btn-sm btn-info"> <i class="fas fa-edit"></i></a>
                        </div>
                        <div class="card-body" style="font-size: 16px;">
                            <?php echo htmlspecialchars($row['team_highlight']) . "" ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>