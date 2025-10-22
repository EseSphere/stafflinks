<?php
include('header-contents.php');
if (isset($_GET['slug'], $_GET['uryyToeSS4'])) {
    $slug = $_GET['slug'];
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}
$stmt = $conn->prepare("SELECT * FROM tbl_care_plan 
WHERE slug = ? AND company_Id = ?");
$stmt->bind_param("ss", $slug, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_ASSOC);
$assessmentName = $row['asm_name'];
$assessmentId = $row['assessm_Id'];
$asm_header = $row['asm_header'];
$slug = $row['slug'];
$created_by = $row['created_by'];
$dateTime = $row['dateTime'];
$formattedDate = date("d F Y", strtotime($dateTime));
?>
<style>
    body {
        background-color: #f8f9fa;
    }

    .delete-card {
        max-width: 450px;
        margin: 100px auto;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .delete-icon {
        font-size: 50px;
        color: #dc3545;
    }

    .btn-space {
        margin-right: 10px;
    }
</style>

<body>
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card delete-card text-center">
                            <div class="alert alert-danger" role="alert">
                                <h5>Delete Assessment</h5>
                            </div>
                            <div class="card-body p-4">
                                <h4 class="card-title mb-3">Are you sure?</h4>
                                <p class="card-text mb-4 fs-6">Deleting this assessment will permanently remove all related entries and data. This action cannot be undone.
                                    Do you want to proceed?</p>
                                <form id="delSectionData" action="./delete-section-data" method="post" enctype="multipart/form-data" autocomplete="off"></form>
                                <input form="delSectionData" value="<?= $slug ?>" name="txtSlug" hidden />
                                <input form="delSectionData" value="<?= $uryyToeSS4 ?>" name="txtClientId" hidden />
                                <input form="delSectionData" value="<?= $_SESSION['usr_compId'] ?>" name="txtCompany" hidden />
                                <button type="button" onclick="window.history.back()" class="btn btn-secondary">Cancel</button>
                                <button form="delSectionData" name="delSectionData" class="btn btn-danger" type="submit">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7"></div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer-contents.php'); ?>