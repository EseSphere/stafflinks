<?php
include('team-header-contents.php');
$stmt = $conn->prepare("SELECT cert_name, cert_file, dateUpload, cert_expire 
FROM tbl_team_certificates WHERE uryyTteamoeSS4 = ?");
$stmt->bind_param("s", $uryyTteamoeSS4);
$stmt->execute();
$result = $stmt->get_result();

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
                        <h5>Skills <br> <small>View and update <?php print $varCarerNames; ?>'s skills status.</small>
                        </h5>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div style="border-radius: 8px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-lg-8">
                <div class="text-end">
                    <a href="./add-carer-certificates?uryyTteamoeSS4=<?= $uryyTteamoeSS4 ?>" class="btn btn-sm btn-primary">Add</a>
                </div>
                <div class="card mb-4">
                    <div class="card-body" style="font-size: 16px;">
                        <div class="row">
                            <div class="col-sm-5 col-4">
                                <p style="font-size: 16px;" class="mb-0"><strong>Name</strong></p>
                            </div>
                            <div class="col-sm-3 col-3">
                                <p style="font-size: 16px;" class="text-muted mb-0"><strong>Document</strong></p>
                            </div>
                            <div class="col-sm-2 col-3">
                                <p style="font-size: 16px;" class="text-muted mb-0"><strong>Added</strong></p>
                            </div>
                            <div class="col-sm-2 col-2">
                                <p style="font-size: 16px;" class="text-muted mb-0"><strong>Expire</strong></p>
                            </div>
                        </div>
                        <hr>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <div class='row'>
                                    <div class='col-sm-5 col-4'>
                                        <p style='font-size: 16px;' class='mb-0'>{$row['cert_name']}</p>
                                    </div>
                                    <div class='col-sm-3 col-3'>
                                        <a target='_blank' title='{$row['cert_file']}' href='./Certificates/{$row['cert_file']}' onclick='window.open(\"{$row['cert_file']}.pdf\", \"_blank\", \"fullscreen=yes\"); return false;'>
                                            Certificate Mad...
                                        </a>
                                    </div>
                                    <div class='col-sm-2 col-3'>
                                        <p style='font-size: 14px;' class='text-muted mb-0'>{$row['dateUpload']}</p>
                                    </div>
                                    <div class='col-sm-2 col-2'>
                                        <p style='font-size: 14px;' class='text-muted mb-0'>{$row['cert_expire']}</p>
                                    </div>
                                </div>
                                <hr>
                            ";
                        }
                        $stmt->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>