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

    @page {
        size: A4 landscape;
    }

    .table td,
    th {
        max-width: 200px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
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
                        <a href="./delete-section-and-data?slug=<?= $slug ?>&uryyToeSS4=<?= $uryyToeSS4 ?>" form="delSectionData" name="delSectionData" class="btn btn-sm btn-danger" type="submit">Reset</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Section Form -->
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

                        $textareaIds = []; // store textarea IDs for JS

                        if ($result->num_rows) {
                            while ($row = $result->fetch_assoc()) {
                                $sectionId = $row['userId'];
                                $sectionTitle = $row['sectionTitle'];
                                $name = preg_replace('/[^a-z0-9_]/', '', strtolower(str_replace(' ', '_', $sectionTitle)));
                                $textareaIds[] = $name;
                        ?>
                                <div class="form-group mb-3 textarea-wrapper" style="position: relative;" data-id="<?= $sectionId ?>">
                                    <label class="col-form-label fs-6" for="<?= $name ?>"><?= htmlspecialchars($sectionTitle) ?></label>
                                    <textarea id="<?= $name ?>" name="<?= $name ?>" rows="3" style="resize:none;" class="form-control" placeholder="<?= htmlspecialchars($sectionTitle) ?>" required></textarea>
                                    <span class="delete-textarea" style="position: absolute; top: 0; right: 0; cursor: pointer; color: red; font-size: 1.2rem; padding: 5px;" title="Delete this section">&times;</span>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<p class="text-danger">No sections found for this assessment.</p>';
                        }
                        ?>
                        <!-- Hidden fields -->
                        <input type="hidden" name="assessment" value="<?= htmlspecialchars($assessmentName) ?>">
                        <input type="hidden" name="assessmentId" value="<?= htmlspecialchars($assessmentId) ?>">
                        <input type="hidden" name="slug" value="<?= htmlspecialchars($slug) ?>">
                        <input type="hidden" name="username" value="<?= htmlspecialchars($_SESSION['usr_userName'] ?? '') ?>">
                        <input type="hidden" name="specId" value="<?= htmlspecialchars($_SESSION['usr_specId'] ?? '') ?>">
                        <input type="hidden" name="uryyToeSS4" value="<?= htmlspecialchars($_SESSION['clientId'] ?? '') ?>">
                        <!-- Hidden uniqueId for edit functionality -->
                        <input type="hidden" name="uniqueId" id="uniqueId" value="">
                        <button class="btn btn-info" type="submit">Save</button>
                    </form>
                    <br>
                </div>

                <!-- Assessment Table -->
                <div id="printableArea" class="col-md-8 col-lg-8 col-sm-8 col-xl-8 text-decoration-none">
                    <h4><strong><?php echo "" . $_SESSION['usr_compName'] . ""; ?></strong></h4>
                    <p class="fs-6 fw-bold"><?= $_SESSION['clientName'] . ' ' . $assessmentName; ?> details</p>
                    <p class="text-collaps fw-semibold"><?= $asm_header ?></p>
                    <hr />
                    <div style="overflow-x: auto; width: 100%;">
                        <div class="print-table-container">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <?php
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
                                                echo "<th style='max-width: 200px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;'>" . htmlspecialchars($row['sectionTitle']) . "</th>";
                                            }
                                        } else {
                                            echo "<th>No Assessment</th>";
                                        }
                                        $stmt->close();
                                        ?>
                                        <th style="width: 120px; text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-bordered">
                                    <?php
                                    $sql = "SELECT * FROM tbl_care_plan_section WHERE slug = ? AND company_Id = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param('ss', $slug, $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $sections = [];
                                    while ($row = $result->fetch_assoc()) {
                                        $sections[] = $row['sectionTitle'];
                                    }
                                    $stmt->close();

                                    $sql = "SELECT uniqueId, uryyToeSS4, sectionContent FROM tbl_assessment_entries 
                                    WHERE slug = ? AND uryyToeSS4 = ? AND company_Id = ? ORDER BY uniqueId";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param('sss', $slug, $uryyToeSS4, $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $grouped = [];
                                    while ($row = $result->fetch_assoc()) {
                                        $grouped[$row['uniqueId']][] = $row['sectionContent'];
                                    }

                                    foreach ($grouped as $uniqueId => $titles) {
                                        $jsonData = htmlspecialchars(json_encode($titles), ENT_QUOTES);
                                        echo "<tr data-contents='{$jsonData}'>";

                                        // Render section cells
                                        for ($i = 0; $i < count($sections); $i++) {
                                            $content = $titles[$i] ?? ''; // insert empty cell if no content
                                            echo "<td style='max-width: 200px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;'>" . htmlspecialchars($content) . "</td>";
                                        }

                                        // Always render action column last
                                        echo "<td class='text-center'>
                                            <div class='btn-group' role='group'>
                                                <!-- Edit button -->
                                                <button type='button' class='btn btn-warning btn-sm edit-btn' 
                                                    data-uniqueid='" . htmlspecialchars($uniqueId) . "' 
                                                    data-contents='{$jsonData}'
                                                    style='padding: .15rem .3rem; font-size: .75rem; line-height: 1; border-radius: .2rem; margin-right:3px;'>
                                                    <i class='fas fa-edit'></i>
                                                </button>
                                                
                                                <!-- Delete button -->
                                                <form method='post' action='delete_assessment.php' onsubmit='return confirm(\"Are you sure you want to delete this entry?\");' style='display:inline;'>
                                                    <input type='hidden' name='uniqueId' value='" . htmlspecialchars($uniqueId) . "'>
                                                    <input type='hidden' name='clientId' value='" . htmlspecialchars($uryyToeSS4) . "'>
                                                    <button type='submit' class='btn btn-danger btn-sm' 
                                                            style='padding: .15rem .3rem; font-size: .75rem; line-height: 1; border-radius: .2rem;'>
                                                        <i class='fas fa-trash'></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="alert alert-success p-2 mt-5 print-footer" role="alert">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="alert-heading">Assessment created by <br><?= htmlspecialchars($created_by) ?>
                                    <br>
                                    <span style="font-size:12px;">Review Date: <?= htmlspecialchars($formattedDate) ?></span>
                                </h6>
                            </div>
                            <div class="col-6">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM tbl_assessment_entries WHERE slug = ? AND uryyToeSS4 = ? AND company_Id = ? 
                                ORDER BY userId DESC LIMIT 1");
                                $stmt->bind_param("sss", $slug, $uryyToeSS4, $_SESSION['usr_compId']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                $created_at = $row['created_at'] ?? '';
                                $varAssessor = $row['assessor'] ?? '';
                                if ($created_at) {
                                    $formattedDate2 = date("d F Y", strtotime($created_at));
                                    if ($varAssessor) {
                                        echo "<h6 class='alert-heading'>Recently updated by <br>$varAssessor
                                                <br>
                                                <span style='font-size:12px;'>Review Date: $formattedDate2</span>
                                              </h6>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Sections -->
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
                        <div class="textbox-group">
                            <label for="section-name-1" class="col-form-label">Header 1:</label>
                            <input form="AssessForm" type="text" required name="items[]" class="form-control" id="section-name-1">
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
    document.addEventListener('DOMContentLoaded', function() {
        // Delete section functionality
        const deleteIcons = document.querySelectorAll('.delete-textarea');
        deleteIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                if (!confirm('Are you sure you want to delete this section?')) return;

                const wrapper = this.closest('.textarea-wrapper');
                const sectionId = wrapper.getAttribute('data-id');

                // Fetch deletion from backend
                fetch('delete_section.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'userId=' + encodeURIComponent(sectionId)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove textarea from form
                            wrapper.remove();

                            // Hide corresponding table header and body column
                            const sectionName = wrapper.querySelector('label').innerText.trim();
                            const table = document.querySelector('#printableArea table');
                            const headers = table.querySelectorAll('thead th');
                            let colIndex = -1;

                            headers.forEach((th, index) => {
                                if (th.innerText.trim() === sectionName) colIndex = index;
                            });

                            if (colIndex > -1) {
                                // Remove header
                                headers[colIndex].remove();

                                // Hide all cells in that column
                                table.querySelectorAll('tbody tr').forEach(tr => {
                                    if (tr.children[colIndex]) {
                                        tr.children[colIndex].style.display = 'none';
                                    }
                                });
                            }

                            alert('Section deleted successfully.');
                        } else {
                            alert('Error deleting section: ' + data.message);
                        }
                    })
                    .catch(err => alert('AJAX error: ' + err));
            });
        });

        // Edit button functionality
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const contents = JSON.parse(this.getAttribute('data-contents'));
                const textareas = document.querySelectorAll('#SectionForm textarea');

                textareas.forEach((ta, index) => {
                    ta.value = contents[index] !== undefined ? contents[index] : '';
                });

                document.getElementById('uniqueId').value = this.getAttribute('data-uniqueid');

                document.getElementById('SectionForm').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });

    let counter = 1;

    function addTextbox() {
        counter++;
        let container = document.getElementById("textboxContainer");

        let div = document.createElement("div");
        div.className = "textbox-group mt-2";

        let label = document.createElement("label");
        label.setAttribute("for", "section-name-" + counter);
        label.className = "col-form-label";
        label.innerText = "Header " + counter + ":";

        let input = document.createElement("input");
        input.type = "text";
        input.name = "items[]";
        input.required = true;
        input.className = "form-control";
        input.id = "section-name-" + counter;
        input.setAttribute("form", "AssessForm");

        let removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.className = "btn btn-danger btn-sm mt-1";
        removeBtn.innerText = "Remove";
        removeBtn.onclick = function() {
            removeTextbox(removeBtn);
        };

        div.appendChild(label);
        div.appendChild(input);
        div.appendChild(removeBtn);

        container.appendChild(div);

        // Show previously hidden column if header already exists
        const newHeaderName = input.value.trim();
        const table = document.querySelector('#printableArea table');
        if (table) {
            const headers = table.querySelectorAll('thead th');
            headers.forEach((th, index) => {
                if (th.innerText.trim() === newHeaderName) {
                    table.querySelectorAll('tbody tr').forEach(tr => {
                        if (tr.children[index]) tr.children[index].style.display = '';
                    });
                }
            });
        }
    }

    function removeTextbox(button) {
        let div = button.parentNode;
        div.parentNode.removeChild(div);
    }
</script>

<?php include('footer-contents.php'); ?>