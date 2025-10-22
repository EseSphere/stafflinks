<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("si", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();

$clientDOB = date('d M, Y', strtotime("" . $row['client_date_of_birth'] . ""));
$clientStartDate = date('d M, Y', strtotime("" . $row['clientStart_date'] . ""));
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <section style="background-color: #eee; margin-bottom:50px;">
                <div class="container py-5">
                    <div class="card mb-4">
                        <div class="card-body" style="font-size: 16px;">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div
                                        style="width: 100%; height:auto; padding:22px; text-align:center; position:relative;">
                                        <h3>About Me</h3>

                                        <!-- ✅ New View Details Button -->
                                        <a type="button"
                                            href="./view-client-details?<?php echo "uryyToeSS4=" . $row['uryyToeSS4']; ?>"
                                            class="btn btn-sm btn-info"
                                            style="position:absolute; top:22px; right:22px;">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                    </div>

                                    <div class="card mb-4">
                                        <div class="card-body" style="font-size: 16px;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>Highlights</strong>
                                                    </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo nl2br(htmlspecialchars($row['client_highlights'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- ✅ rest of your existing sections stay unchanged -->

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>What is important
                                                            to me</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./what-is-important-to-me<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['what_is_important_to_me'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>My likes and
                                                            dislikes</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./my-likes-and-dislikes<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['my_likes_and_dislikes'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>My current
                                                            condition</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./my-current-condition<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['my_current_condition'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>My medical
                                                            history</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./my-medical-history<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['my_medical_history'] . "" ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>My physical
                                                            health</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./my-physical-health<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['my_physical_health'] . "" ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>My mental
                                                            health</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./my-mental-health<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['my_mental_health'] . "" ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>How i
                                                            communicate</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./how-i-communicate<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['how_i_communicate'] . "" ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0"><strong>Assistive equipment
                                                            is use.</strong></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="./assistive-equipment-is-use<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                                        style="text-decoration: none; position:absolute; right:50px;">
                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                    </a>
                                                    <br>
                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['assistive_equipment_i_use'] . ""; ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>