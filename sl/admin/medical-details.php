<?php
include('client-header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ? 
AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = $row['client_first_name'] . ' ' . $row['client_last_name'] ?? null;
$stmt->close();

$uryyToeSS4 = isset($_GET['uryyToeSS4']) ? trim($_GET['uryyToeSS4']) : null;
$usr_compId = $_SESSION['usr_compId'] ?? null;

if ($uryyToeSS4 && $usr_compId) {
    $stmt = $conn->prepare("SELECT * FROM tbl_client_medical WHERE uryyToeSS4 = ? 
    AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $uryyToeSS4, $usr_compId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $result->free();
    $stmt->close();
    if ($row === null) {
        $row = [];
    }
} else {
    $row = [];
}
$colNhsNumber    = $row['col_nhs_number']    ?? '';
$col_medical_support  = $row['col_medical_support']  ?? '';
$col_dnar          = $row['col_dnar']           ?? '';
$col_allergies  = $row['col_allergies'] ?? '';
$col_gp_name    = $row['col_gp_name']     ?? '';
$col_phone_number = $row['col_phone_number'] ?? '';
$gp_email_address = $row['gp_email_address'] ?? '';
$gp_address = $row['gp_address'] ?? '';
$col_pharmancy_name = $row['col_pharmancy_name'] ?? '';
$pharmacy_phone = $row['pharmacy_phone'] ?? '';
$col_pharmancy_address = $row['col_pharmancy_address'] ?? '';
?>
<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }
</style>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h5 class="m-b-10"><?= $clientName; ?>
                            <p class="text-muted">Add more client next of kin and emergecy contacts.</p>
                        </h5>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-md-5">
                    <div style="width: 100%; height:auto; text-align:right;">
                        <a class="btn btn-info btn-sm text-decoration-none text-white"
                            href="./more-medical?<?php echo "uryyToeSS4=$uryyToeSS4" ?>&u7ye=<?= $crackEncryptedbinary ?>"><i
                                class="fas fa-edit"></i></a>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body" style="font-size: 16px;">
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">NHS No</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "<span style='color:orange;'><strong>" . $colNhsNumber . "</strong></span>" ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">Medical support</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $col_medical_support . "" ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">DNACPR</p>
                                </div>
                                <div class="col-sm-7">
                                    <a href="./future-planning?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>"
                                        class="btn btn-info btn-sm">Future Planning</a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">Allergies</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $col_allergies . "" ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">GP Details</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $col_gp_name . "" ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">GP Phone</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $col_phone_number . "" ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">GP Email</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $gp_email_address . "" ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">GP Address</p>
                                </div>
                                <div class="col-sm-7">
                                    <a target="_blank"
                                        href="https://www.google.fr/maps/place/<?php echo " " . $gp_address . ""; ?>">
                                        <p style="font-size: 16px;" class="text-muted mb-0">
                                            <?php echo "" . $gp_address . ""; ?></p>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">Pharmacy Details</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $col_pharmancy_name . ""; ?> </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">Pharmacy Phone</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $pharmacy_phone . ""; ?> </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <p style="font-size: 16px;" class="mb-0">Pharmacy Address</p>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                        <?php echo "" . $col_pharmancy_address . ""; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
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
                                You can <strong>view</strong>, <strong>update</strong>, or <strong>add new
                                    details</strong> using the button below.
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
                                            Quickly browse through all existing client medical details in an organized
                                            list.
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
                                            Insert new client medical details by clicking the <strong>Add New</strong>
                                            button.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add New Button -->
                        <div class="text-center">
                            <a href="./more-medical?<?php echo "uryyToeSS4=$uryyToeSS4" ?>&u7ye=<?= $crackEncryptedbinary ?>"
                                class="btn btn-primary shadow-lg">
                                <i class="fas fa-edit"></i> Add New Client Medical Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>