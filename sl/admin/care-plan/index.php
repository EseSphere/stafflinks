<?php
include('header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
// Fetch the data
if ($row = $result->fetch_assoc()) {
    $client_first_name = $row['client_first_name'];
    $client_last_name = $row['client_last_name'];
    $_SESSION['clientId'] = $uryyToeSS4;
    $_SESSION['clientName'] = $client_first_name . ' ' . $client_last_name;
}
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="w-100 p-3 mb-0">
                <h5>About <?php echo $client_first_name . ' ' . $client_last_name; ?></h5>
                <p style="font-size: 18px;">
                    Capture basic information about <?php echo $client_first_name . ' ' . $client_last_name; ?>, including their likes and preferences.
                </p>
                <div class="col-xl-4 mt-5">
                    <a href='../client-details?<?php echo "uryyToeSS4=" . $uryyToeSS4 . "" ?>' style='text-decoration:none; color:#000;'>
                        <div id="card-effects" class='card table-card'>
                            <div class='card-header'>
                                <h5><strong><i class='feather mr-2 icon-briefcase'></i> &nbsp; About <?php echo $client_first_name; ?></strong></h5>
                            </div>
                            <div class='card-body p-0'>
                                <div style=" width: 100%; height:auto; padding:18px; color:rgba(39, 174, 96,1.0);">
                                    <span style='font-weight:22px;'><i class='feather mr-2 icon-check-square'></i> Updated</span> <span style='font-weight:22px; position:absolute;'>&nbsp; &nbsp; 24 Jan 2024</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-3 mb-2 w-100 h-auto">
                <h3>Initial assessments</h3>
                <p style="font-size: 18px;"> You can add more than one assessment for a client. You can only add one assessment at a time</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Create Assessment</button>
            </div>
            <!-- Clients feed, team member start -->
            <?php
            $sql = "SELECT * FROM tbl_care_plan WHERE company_Id = ?";
            $query = $conn->prepare($sql);
            if ($query) {
                $query->bind_param("s", $_SESSION['usr_compId']);
                $query->execute();
                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <div class='col-xl-4'>
                            <a class='text-black text-decoration-none' href='./review-assessment?uryyToeSS4=<?= $uryyToeSS4 ?>&<?php echo "slug=" . htmlspecialchars($row["slug"]); ?>'>
                                <div id='card-effects' class='card table-card'>
                                    <div class='card-header'>
                                        <h5><strong><i class='feather mr-2 icon-briefcase'></i> &nbsp; <?php echo "" . htmlspecialchars($row["asm_name"]); ?></strong></h5>
                                    </div>
                                    <div class='card-body p-0'>
                                        <div style=' width: 100%; height:auto; padding:18px; color:rgba(39, 174, 96,1.0);'>
                                            <span style='font-weight:14px;'><i class='feather mr-2 icon-check-square'></i>
                                                <?php echo $client_first_name . ' ' . $client_last_name; ?>
                                                <?php echo "" . htmlspecialchars($row["asm_name"]); ?>.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
            <?php
                    }
                } else {
                    echo "No records found.";
                }
            } else {
                echo "Query preparation failed: " . $conn->error;
            }
            ?>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="./processing-assessment" method="post" autocomplete="off" enctype="multipart/form-data" id="AssessForm"></form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Assessment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name or Title:</label>
                                <input form="AssessForm" type="text" required name="txtAsmName" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Header:</label>
                                <textarea style="resize: none;" name="txtAsmHeader" rows="4" form="AssessForm" class="form-control" id=""></textarea>
                            </div>
                            <input form="AssessForm" name="txtUserName" value="<?php echo "" . $_SESSION['usr_userName'] . ""; ?>" hidden>
                            <input form="AssessForm" name="txtUserSpecId" value="<?php echo "" . $_SESSION['usr_specId'] . ""; ?>" hidden>
                            <input form="AssessForm" name="txtClientId" value="<?php echo $uryyToeSS4; ?>" hidden>
                            <input form="AssessForm" name="txtCompanyId" value="<?php echo "" . $_SESSION['usr_compId'] . ""; ?>" hidden>
                        </div>
                        <div class="modal-footer">
                            <button form="AssessForm" type="submit" class="btn btn-primary">Save Now!</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




<?php include('footer-contents.php'); ?>