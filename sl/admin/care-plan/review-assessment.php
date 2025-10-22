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
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10"><?php print $assessmentName; ?></h4>
                        </div>
                        <ul class="breadcrumb">
                            <li style="font-size: 16px;" class="breadcrumb-item">
                                Capture outcomes, tasks and risks related to <?php print "" . $_SESSION['clientName'] . ""; ?>'s <?php print $assessmentName; ?>.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <h5><?php print $assessmentName; ?></h5>
                    <span style="font-size: 16px;">
                        Record <?php print "" . $_SESSION['clientName'] . ""; ?>'s level of independence for each <?php print $assessmentName; ?> activity, and any support that is required.
                    </span>
                    <br><br>
                    <a href="./begin-assessment?slug=<?= $slug ?>&uryyToeSS4=<?= $uryyToeSS4 ?>" style="text-decoration: none;">
                        <button type="button" class="btn btn-dark">Begin Assessment</button>
                    </a>
                    <br><br>
                    <h5>Previous assessments</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <h5>Assessment summary and outcomes</h5>
                    <span style="font-size: 16px;">
                        Describe how your team can support this client
                    </span>
                    <form action="./review-assessment" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <textarea name="txtAssessmentTwo" id="" rows="4" class="form-control" required placeholder="e.g he/she need support with getting dressed in the morning"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnSaveAssessment" value="Save changes" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>