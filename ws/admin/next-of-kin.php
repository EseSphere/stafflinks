<?php include_once('./next_of_kin_backend.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?= $clientName; ?>
                                <p class="text-muted">View client next of kin and emergecy contacts.</p>
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end gap-2">
                            <!-- Unique identifier button -->
                            <a type="button" href="./unique-identifier?<?php echo "uryyToeSS4=" . $uryyToeSS4; ?>"
                                class="btn btn-sm btn-info text-decoration-none text-white">
                                Unique identifier
                            </a>

                            <!-- Add More button -->
                            <a class="btn btn-sm btn-info text-decoration-none text-white"
                                href="./more-next-of-kin?<?php echo "uryyToeSS4=$uryyToeSS4" ?>">
                                <i class="feather icon-plus"></i> Add More
                            </a>
                        </div>
                    </div>

                </div>
                <hr>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-8">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM tbl_client_nok WHERE uryyToeSS4 = ? 
                    AND col_company_Id = ? GROUP BY col_first_name DESC");
                    $stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $lastUpdate = $row ? date('d M, Y', strtotime($row['dateTime'])) : null; ?>
                        <h5 class="w-100">Emergency contact
                            <a class="btn btn-sm btn-secondary text-right text-decoration-none"
                                href="./edit-next-of-kin?<?php echo "userId=" . $row['userId'] . "" ?>"><i
                                    class="feather icon-edit"></i></a>
                        </h5>
                        <div class="card mb-4">
                            <div class="card-body" style="font-size: 16px;">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Name</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <?php echo "" . $row['col_first_name'] . " " . $row['col_last_name'] . "" ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Relationship</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <?php echo "" . $row['col_relationship'] . "" ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Phone</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <?php echo "" . $row['col_phone_number'] . "" ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Type of contact</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <?php echo "" . $row['col_type_ofContact'] . "" ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Email address</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <?php echo "" . $row['nok_emailaddress'] . "" ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Documents</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <a
                                                href="<?php echo "" . $row['lpa_documents'] . "" ?>"><?php echo "" . $row['lpa_documents'] . "" ?></a>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Data updated</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0"><?php echo $lastUpdate; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p style="font-size: 16px;" class="mb-0">Statement</p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <?php echo "" . $row['col_client_statement'] . " "; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <br>
        </div>
    </div>


</div>
</div>
</div>
</div>


<?php include('footer-contents.php'); ?>