<?php include_once('future_planning_backend.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="col-md-12">
            <div class="page-header-title">
                <a style="position: absolute; right:0;" class="btn btn-sm btn-info text-decoration-none text-white" href="./modify-future-planning?<?php echo "uryyToeSS4=$uryyToeSS4" ?>">
                    <i class="feather icon-plus">Modify</i>
                </a>
                <h5 class="m-b-10"><?= $clientName; ?>
                    <p class="text-muted">View and update <?= $clientName; ?>'s future planing.</p>
                </h5>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <h5></h5>
            <div class="row">
                <div style="border-radius: 8px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-md-4">
                    <form action="./future-planning?uryyToeSS4=<?php echo htmlspecialchars($uryyToeSS4); ?>"
                        method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="txtCompanyId" value="<?php echo htmlspecialchars($_SESSION['usr_compId']); ?>" />
                        <input type="hidden" name="txtcompanyClientId" value="<?php echo htmlspecialchars($uryyToeSS4); ?>" />
                        <?php
                        $companyId = $_SESSION['usr_compId'];
                        $clientId = $uryyToeSS4;
                        $query = "SELECT * FROM tbl_future_planning 
                        WHERE uryyToeSS4 = ? AND col_company_Id = ? ORDER BY userId DESC LIMIT 1";
                        if ($stmt = $conn->prepare($query)) {
                            $stmt->bind_param("ss", $clientId, $companyId);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $get_team_row = $result->fetch_array(MYSQLI_ASSOC);
                            $stmt->close();
                        } else {
                            error_log("Prepare failed: " . $conn->error);
                        }
                        ?>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="uniqueClientId">Does he/she have capacity to make decisions related to their health and wellbeing?</label>
                                    <p class="text-muted fs-6">
                                        <?php echo htmlspecialchars($get_team_row['col_first_box'] ?? 'Null'); ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="uniqueClientId">Health and Welfare LPA</label>
                                    <p class="text-muted fs-6">
                                        <?php echo htmlspecialchars($get_team_row['col_second_box'] ?? 'Null'); ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="uniqueClientId">Property and Financial Affairs LPA</label>
                                    <p class="text-muted fs-6">
                                        <?php echo htmlspecialchars($get_team_row['col_third_box'] ?? 'Null'); ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="uniqueClientId">Do Not Attempt Cardiopulmonary Resuscitation (DNACPR)</label>
                                    <p class="text-muted fs-6">
                                        <?php echo htmlspecialchars($get_team_row['col_fourt_box'] ?? 'Null'); ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="uniqueClientId">Advance Decision to Refuse Treatment (ADRT / Living Will)</label>
                                    <p class="text-muted fs-6">
                                        <?php echo htmlspecialchars($get_team_row['col_fift_box'] ?? 'Null'); ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="uniqueClientId">Recommended Summary Plan for Emergency Care and Treatment (ReSPECT)</label>
                                    <p class="text-muted fs-6">
                                        <?php echo htmlspecialchars($get_team_row['col_sixth_box'] ?? 'Null'); ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="uniqueClientId">Where is it kept?</label>
                                    <p class="text-muted fs-6">
                                        <?php echo htmlspecialchars($get_team_row['col_seventh_box'] ?? 'Null'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h3 class="mt-4"><strong>Future Planning</strong></h3>
                    This section provides an overview of key arrangements and decisions that help ensure a person's wishes and best interests are respected in the future, particularly regarding health, welfare, and financial matters.
                    <br>
                    It covers important information such as decision-making capacity, legal authorisations, and advance care preferences. The details included on this page are designed to support individuals, families, and professionals in understanding and accessing the necessary documents or plans when required.
                    <br><br>
                    The following information is included:
                    <ul>
                        <li>Capacity to make decisions about health and wellbeing</li>
                        <li>Health and Welfare Lasting Power of Attorney (LPA)</li>
                        <li>Property and Financial Affairs Lasting Power of Attorney (LPA)</li>
                        <li>Do Not Attempt Cardiopulmonary Resuscitation (DNACPR)</li>
                        <li>Advance Decision to Refuse Treatment (ADRT / Living Will)</li>
                        <li>Recommended Summary Plan for Emergency Care and Treatment (ReSPECT)</li>
                        <li>Location of the relevant documents</li>
                    </ul>
                    <hr>
                    This information helps ensure that, in the event of a health crisis or life-changing situation, clear guidance is available to those providing support or making decisions on the individual's behalf.
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>