<?php include_once('more_medical_backend.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="col-md-12">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $clientName; ?>
                    <p class="text-muted">View and update <?= $clientName; ?>'s medical details.</p>
                </h5>
            </div>
        </div>

        <hr>
        <div class="container-fluid">
            <div class="row text-decoration-none mt-3">
                <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-md-6">
                    <div style="width: 100%; height:auto; text-align:right;">
                        <a href="./medical-details?<?php echo "uryyToeSS4=$uryyToeSS4" ?>" style="text-decoration: none; color:#000;">
                            <button class="btn btn-info">View details</button>
                        </a>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <h5>Health details</h5>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="NHS Number">NHS number</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['col_nhs_number'] ?? ''); ?>" placeholder="NHS Number" name="txtNhsNumber" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Medical support">Medical support</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['col_medical_support'] ?? ''); ?>" placeholder="Medical support" name="txtMedicalsupport" />
                                </div>
                            </div>
                        </div>

                        <div class="row text-decoration-none mt-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label id="FormLabel" for="Profile picture">DNAR</label>
                                    <h5>Upload DNAR File (Screenshots, document, images, etc.)</h5>
                                    <div style="justify-content:center; align-items:center; display:flex; text-align:center; border:2px dashed rgba(41, 128, 185,1.0); width: 100%; height:200px; padding:22px;">
                                        <input style="display: none;" type="file" id="file-input" name="file">
                                        <label for="file-input" class="upload-button">Browse File</label>
                                    </div>
                                    <span style="font-weight: 800;" id="file-name">No file selected</span>
                                </div>
                            </div>
                        </div>

                        <div class="row text-decoration-none mt-3">
                            <h5>Allergies and intolerances</h5>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="Allergies and intolerances">Allergies and intolerances</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['col_allergies'] ?? ''); ?>" placeholder="Allergies and intolerances" required name="txtAllergiesInfo" />
                                </div>
                            </div>
                        </div>

                        <div class="row text-decoration-none mt-3">
                            <h5>Doctor/GP</h5>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="GP's name">GP's name</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['col_gp_name'] ?? ''); ?>" placeholder="GP's name" required name="txtGPsname" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Phone number">Phone number</label>
                                    <input type="tel" class="form-control" value="<?= htmlspecialchars($row['col_phone_number'] ?? ''); ?>" placeholder="Phone number" required name="txtPhoneNumber" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="Email address">Email address</label>
                                    <input type="email" class="form-control" value="<?= htmlspecialchars($row['gp_email_address'] ?? ''); ?>" placeholder="Email address" name="txtEmailAddress" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['gp_address'] ?? ''); ?>" placeholder="Address" name="txtAddress" />
                                </div>
                            </div>
                        </div>

                        <div class="row text-decoration-none mt-3">
                            <h5>Pharmacist</h5>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Pharmacy name">Pharmacy name</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['col_pharmancy_name'] ?? ''); ?>" placeholder="Pharmacy name" name="txtPharmacyname" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Pharmacy phone">Pharmacy phone</label>
                                    <input type="tel" class="form-control" value="<?= htmlspecialchars($row['pharmacy_phone'] ?? ''); ?>" placeholder="Pharmacy phone" name="txtPharmacyPhone" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="Pharmacy address">Pharmacy address</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['col_pharmancy_address'] ?? ''); ?>" placeholder="Pharmacy address" name="txtPharmacyAddress" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $uryyToeSS4; ?>" name="txtClientId" />
                        <div class="form-group">
                            <input type="submit" value="Save details" class="btn btn-primary btn-lg" name="btnSaveClientMdForm" />
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="container my-5">
                        <!-- Page Header -->
                        <div class="text-center mb-4">
                            <h4 class="fw-bold">
                                <i class="bi bi-file-medical text-primary me-2"></i> Client Medical Details
                            </h4>
                            <p class="text-muted">
                                Manage and keep track of all client medical records in one place.
                            </p>
                        </div>
                        <!-- Info Alert -->
                        <div class="alert alert-info shadow-sm d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                            <p class="mb-0">
                                This page contains a record of all clients’ medical details.
                                You can <strong>view</strong>, <strong>update</strong>, or <strong>add new details</strong> using the button below.
                            </p>
                        </div>

                        <!-- Feature Highlights -->
                        <div class="row text-center my-4">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <i class="bi bi-eye-fill text-success fs-1 mb-3"></i>
                                        <h5 class="card-title">View Records</h5>
                                        <p class="card-text text-muted">
                                            Quickly browse through all existing client medical details in an organized list.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <i class="bi bi-pencil-square text-warning fs-1 mb-3"></i>
                                        <h5 class="card-title">Update Records</h5>
                                        <p class="card-text text-muted">
                                            Edit and update client medical details to ensure accuracy at all times.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <i class="bi bi-plus-circle-fill text-primary fs-1 mb-3"></i>
                                        <h5 class="card-title">Add New</h5>
                                        <p class="card-text text-muted">
                                            Insert new client medical details by clicking the <strong>Add New</strong> button.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add New Button -->
                        <div class="text-center">
                            <a href="./more-medical?<?php echo "uryyToeSS4=$uryyToeSS4" ?>&u7ye=<?= $crackEncryptedbinary ?>" class="btn btn-primary shadow-lg">
                                <i class="fas fa-edit"></i> Add New Client Medical Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const fileInput = document.getElementById('file-input');
    const fileNameDisplay = document.getElementById('file-name');

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name;
        } else {
            fileNameDisplay.textContent = 'No file chosen';
        }
    });
</script>

<?php include('footer-contents.php'); ?>