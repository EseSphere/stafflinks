<?php include_once('unique_identifier_backend.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="col-md-12">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $clientName; ?>
                    <p class="text-muted">View and update <?= $clientName; ?>'s Unique identifier.</p>
                </h5>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <h5>Unique identifier</h5>
            <div class="row">
                <div style="border-radius: 8px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-md-4">
                    <form action="./unique-identifier?uryyToeSS4=<?php echo htmlspecialchars($uryyToeSS4); ?>"
                        method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="txtCompanyId" value="<?php echo htmlspecialchars($_SESSION['usr_compId']); ?>" />
                        <input type="hidden" name="txtcompanyClientId" value="<?php echo htmlspecialchars($uryyToeSS4); ?>" />
                        <?php
                        $companyId = $_SESSION['usr_compId'];
                        $clientId = $uryyToeSS4;
                        $query = "SELECT * FROM tbl_general_client_form 
                        WHERE uryyToeSS4 = ? AND col_company_Id = ? ORDER BY id DESC LIMIT 1";
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
                            <div class="col-lg-8 col-8">
                                <div class="form-group">
                                    <label for="uniqueClientId">Unique identifier</label>
                                    <input type="number" minlength="6" id="uniqueClientId" name="txtSecondBox" class="form-control" placeholder="e.g 388576" value="<?php echo htmlspecialchars($get_team_row['col_swn_number'] ?? ''); ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="clientPhone">Other phone number</label>
                                    <input type="tel" id="clientPhone" name="txtthirdBox" class="form-control" placeholder="e.g 075 *** ****" value="<?php echo htmlspecialchars($get_team_row['col_second_phone'] ?? ''); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" style="height: 45px;" value="Update details" name="btnUpdateClientInfo" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h3><strong>Unique Identifier</strong></h3>
                    This section allows authorised users to view and update the unique identifier associated with the individual’s records.
                    The unique identifier is a key reference number or code that helps to securely link all relevant information, documents, and care plans to the correct individual. Keeping this information accurate and up to date is essential for ensuring the right support, care, and decisions are provided.
                    <hr>
                    Please ensure any updates made are accurate and follow appropriate procedures.
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>