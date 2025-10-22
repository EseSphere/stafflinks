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
    .table td,
    .table th {
        white-space: nowrap;
    }
</style>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10 font-semibold"><?php print $assessmentName; ?></h4>
                            <p class="fs-6">Capture outcomes, tasks and risks related to client <?php print $assessmentName; ?>.</p>
                            <hr>
                        </div>
                        <p class="fs-6">Click the button below to create multiple sections. Each section will be accessible in all client assessments.</p>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-plus"></i> Section</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div id="shadow-animate" class="col-md-4 col-lg-4 col-sm-4 col-xl-4 text-decoration-none mb-5">
                    <form id="SectionForm" action="processing-assessment-entries.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <?php
                        $sql = "SELECT * FROM tbl_care_plan_section WHERE slug = ? AND company_Id = ?";
                        $stmt = $conn->prepare($sql);
                        if (!$stmt) {
                            die('Query preparation failed: ' . $conn->error);
                        }
                        $stmt->bind_param('ss', $slug, $_SESSION['usr_compId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows) {
                            while ($row = $result->fetch_assoc()) {
                                $sectionTitle = $row['sectionTitle'];
                                $name = preg_replace('/[^a-z0-9_]/', '', strtolower(str_replace(' ', '_', $sectionTitle)));
                        ?>
                                <div class="form-group mb-3">
                                    <label class="col-form-label fs-6" for="<?= $name ?>"><?= htmlspecialchars($sectionTitle) ?></label>
                                    <textarea id="<?= $name ?>" name="<?= $name ?>" rows="3" style='resize:none;' class="form-control" placeholder="<?= htmlspecialchars($sectionTitle) ?>" required></textarea>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<p class="text-danger">No sections found for this assessment.</p>';
                        }
                        ?>
                        <input type="hidden" name="assessment" value="<?= htmlspecialchars($assessmentName) ?>">
                        <input type="hidden" name="assessmentId" value="<?= htmlspecialchars($assessmentId) ?>">
                        <input type="hidden" name="slug" value="<?= htmlspecialchars($slug) ?>">
                        <input type="hidden" name="username" value="<?= htmlspecialchars($_SESSION['usr_userName'] ?? '') ?>">
                        <input type="hidden" name="specId" value="<?= htmlspecialchars($_SESSION['usr_specId'] ?? '') ?>">
                        <input type="hidden" name="uryyToeSS4" value="<?= htmlspecialchars($_SESSION['clientId'] ?? '') ?>">
                        <button class="btn btn-danger" type="button">Reset</button>
                        <button class="btn btn-info" type="submit">Save</button>
                    </form>
                    <br>
                </div>
                <div id="printableArea" class="col-md-8 col-lg-8 col-sm-8 col-xl-8 text-decoration-none">
                    <h4><strong><?php echo "" . $_SESSION['usr_compName'] . ""; ?></strong></h4>
                    <p class="fs-6 fw-bold"><?= $_SESSION['clientName'] . ' ' . $assessmentName; ?> details</p>
                    <P class="text-collaps fw-semibold"><?= $asm_header ?></P>
                    <hr />
                    <div style="overflow-x: auto; width: 100%;">
                        <div class="row">
                            <div class="container">
                                <div class="row border text-center">
                                    <?php
                                    // Fetch sections
                                    $sql = "SELECT * FROM tbl_care_plan_section WHERE slug = ? AND company_Id = ?";
                                    $stmt = $conn->prepare($sql);
                                    if ($stmt === false) {
                                        die("Prepare failed: " . $conn->error);
                                    }
                                    $stmt->bind_param('ss', $slug, $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<div class="col border py-2 fw-bold">' . htmlspecialchars($row['sectionTitle']) . '</div>';
                                        }
                                    } else {
                                        echo '<div class="col border py-2">No Assessment</div>';
                                    }
                                    $stmt->close();
                                    ?>
                                </div>

                                <div>
                                    <?php
                                    // Fetch assessment entries
                                    $sql2 = "SELECT uniqueId, sectionContent FROM tbl_assessment_entries
                                    WHERE slug = '$slug' AND uryyToeSS4 = '$uryyToeSS4' ORDER BY uniqueId";
                                    $stmt2 = $conn->prepare($sql2);
                                    if ($stmt2 === false) {
                                        die("Prepare failed: " . $conn->error);
                                    }
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();

                                    // Group by uniqueId
                                    $grouped = [];
                                    while ($row = $result2->fetch_assoc()) {
                                        $grouped[$row['uniqueId']][] = $row['sectionContent'];
                                    }

                                    foreach ($grouped as $uniqueId => $contents) {
                                        echo '<div class="row text-center">';
                                        foreach ($contents as $content) {
                                            echo '<div class="col border py-2" style="font-size:14px;">' . htmlspecialchars($content) . '</div>';
                                        }
                                        echo '</div>';
                                    }

                                    $stmt2->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success p-2 mt-5" role="alert">
                            <h6 class="alert-heading">Assessment completed by <br><?= htmlspecialchars($created_by) ?>
                                <br>
                                <span style="font-size:12px;">Review Date: <?= htmlspecialchars($formattedDate) ?></span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="./processing-sections" method="post" autocomplete="off" enctype="multipart/form-data" id="AssessForm"></form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Header(s)
                            <button type="button" class="btn btn-info btn-sm" onclick="addTextbox()"><i class="fas fa-plus"></i></button>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div style="margin-top: -12px;" class="modal-body">
                        <div id="textboxContainer">
                            <div id="textboxContainer">
                                <div class="textbox-group">
                                    <label for="section-name-1" class="col-form-label">Header 1:</label>
                                    <input form="AssessForm" type="text" required name="items[]" class="form-control" id="section-name-1">
                                </div>
                            </div>
                        </div>

                        <input form="AssessForm" name="txtAssessmentName" value="<?php echo "" . $assessmentName . ""; ?>" hidden>
                        <input form="AssessForm" name="txtAssessmentSlug" value="<?php echo "" . $slug . ""; ?>" hidden>
                        <input form="AssessForm" name="txtAssessmentId" value="<?php echo "" . $assessmentId . ""; ?>" hidden>
                        <input form="AssessForm" name="txtUserName" value="<?php echo "" . $_SESSION['usr_userName'] . ""; ?>" hidden>
                        <input form="AssessForm" name="txtUserSpecId" value="<?php echo "" . $_SESSION['usr_specId'] . ""; ?>" hidden>
                        <input form="AssessForm" name="txtClientId" value="<?php echo $_SESSION['clientId']; ?>" hidden>
                        <input form="AssessForm" name="txtCompanyId" value="<?php echo "" . $_SESSION['usr_compId'] . ""; ?>" hidden>
                    </div>
                    <div class="modal-footer">
                        <button form="AssessForm" type="submit" class="btn btn-primary">Save Now!</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        let counter = 1; // track number of inputs

        function addTextbox() {
            counter++; // increase header number

            let container = document.getElementById("textboxContainer");

            // Create wrapper div
            let div = document.createElement("div");
            div.className = "textbox-group mt-2";

            // Create label
            let label = document.createElement("label");
            label.setAttribute("for", "section-name-" + counter);
            label.className = "col-form-label";
            label.innerText = "Header " + counter + ":";

            // Create input
            let input = document.createElement("input");
            input.type = "text";
            input.name = "items[]";
            input.required = true;
            input.className = "form-control";
            input.id = "section-name-" + counter;
            input.setAttribute("form", "AssessForm");

            // Create remove button
            let removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "btn btn-danger btn-sm mt-1";
            removeBtn.innerText = "Remove";
            removeBtn.onclick = function() {
                removeTextbox(removeBtn);
            };

            // Append label, input, and remove button
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(removeBtn);

            container.appendChild(div);
        }

        function removeTextbox(button) {
            let div = button.parentNode;
            div.parentNode.removeChild(div);
        }
    </script>

    <?php include('footer-contents.php'); ?>