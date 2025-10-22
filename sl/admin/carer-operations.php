<?php
include('team-header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_team_form 
WHERE uryyTteamoeSS4 = ? AND col_company_Id = ? ORDER BY userId LIMIT 1");
$stmt->bind_param("ss", $uryyTteamoeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$varCarerNames = $row['team_first_name'] . " " . $row['team_last_name'];
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5>Operation <br> <small>View and update <?php print $varCarerNames; ?>'s operation status.</small>
                        </h5>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div style="border-radius: 8px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-lg-8">
                    <h5>Travel information</h5>
                    <div style="text-align: right; width:100%;">
                        <a href="./edit-travel-info?<?php echo "uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style="text-decoration: none;" class="btn btn-outline-secondary">Edit</a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body" style="font-size: 16px;">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p style="font-size: 16px;" class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['team_first_name'] . " " . $row['team_last_name'] . "" ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p style="font-size: 16px;" class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <?php
                                    $full_address = $row['team_address_line_1'] . ', ' . $row['team_address_line_2'] . ', ' . $row['team_city'] . ', ' . $row['team_poster_code'];
                                    $map_url = 'https://www.google.com/maps?q=' . urlencode($full_address);
                                    ?>
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <a href="<?php echo $map_url; ?>" target="_blank" style="color: inherit; text-decoration: none;">
                                            <?php echo htmlspecialchars($full_address); ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p style="font-size: 16px;" class="mb-0">Map</p>
                                </div>
                                <div class="col-sm-9">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <a target="_blank" href="https://www.google.fr/maps/place/<?php echo " " . $row['team_poster_code'] . ""; ?>">
                                            Show map
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p style="font-size: 16px;" class="mb-0">Transport method</p>
                                </div>
                                <div class="col-sm-9">
                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['transportation'] . "" ?></p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div style="text-align: left;" class="col-lg-6">
                            <h5>Rates</h5>
                        </div>
                        <div style="text-align: right;" class="col-lg-6">
                            <a href="./new-carer-rates?<?php echo "uryyTteamoeSS4=" . $row['uryyTteamoeSS4'] . "" ?>" style="text-decoration: none;">
                                <button class="btn btn-outline-secondary">Edit</button>
                            </a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body" style="font-size: 16px;">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p style="font-size: 16px;" class="mb-0">Rate card</p>
                                </div>
                                <div class="col-sm-9">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <a href="./employment?<?php echo "uryyTteamoeSS4=$uryyTteamoeSS4"; ?>"><?php echo "" . $row['employment_type'] . "" ?></a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p style="font-size: 16px;" class="mb-0">Travel rate card</p>
                                </div>
                                <div class="col-sm-9">
                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['col_rate_type'] . "" ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <?php include('bottom-panel-block.php'); ?>
            </div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>