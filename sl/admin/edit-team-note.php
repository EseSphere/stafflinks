<?php
include('team-header-contents.php');
$userId = $_GET['userId'] ?? '';
$teamId = $_GET['spec'] ?? '';
$companyId = $_SESSION['usr_compId'];

$stmt = $conn->prepare("SELECT * FROM tbl_general_team_form 
WHERE uryyTteamoeSS4 = ? AND col_company_Id = ? 
ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $teamId, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$teamData = $result->fetch_assoc();
$teamName = $teamData['team_first_name'] . ' ' . $teamData['team_last_name'] ?? '';
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_team_notes 
WHERE userId = ? AND uryyTteamoeSS4 = ? AND col_company_Id = ? 
ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("iss", $userId, $teamId, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$teamData = $result->fetch_assoc();
$teamNote = $teamData['team_note'] ?? '';
$stmt->close();
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <h4>Edit Note</h4>
        <p class="fs-6">Edit <?php echo htmlspecialchars($teamName); ?>'s notes by using the form provided below.</p>
        <hr>
        <div class="row">
            <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px; height:300px;" class="col-md-5">
                <h5 class="mt-3">Write new note</h5>
                <form action="./update-team-note" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="textTeamName" value="<?php echo htmlspecialchars($_SESSION['usr_userName']); ?>" />
                    <input type="hidden" name="txtteamSpecialId" value="<?php echo htmlspecialchars($teamId); ?>" />
                    <input type="hidden" name="textNoteId" value="<?= $userId ?>" />

                    <div class="form-group">
                        <textarea name="txtteamNote" required style="resize: none;" class="form-control" placeholder="Notes" rows="6"><?= $teamNote ?></textarea>
                    </div>
                    <div class="form-group">
                        <button onclick="location.reload();" type="button" class="btn btn-small btn-danger">Reset form</button>
                        <input type="submit" name="btnUpdateTeamNote" class="btn btn-small btn-primary" value="Save note" />
                    </div>
                </form>
            </div>

            <div class="col-md-7">
                <div class="row">
                    <h5><strong>Notes</strong></h5>
                    <?php
                    $notesPerPage = 5;
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $notesPerPage;

                    $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_team_notes 
                    WHERE uryyTteamoeSS4 = ? AND col_company_Id = ?");
                    $countStmt->bind_param("ss", $teamId, $companyId);
                    $countStmt->execute();
                    $totalNotes = $countStmt->get_result()->fetch_assoc()['total'];
                    $totalPages = ceil($totalNotes / $notesPerPage);
                    $countStmt->close();

                    $stmt = $conn->prepare("SELECT * FROM tbl_team_notes 
                        WHERE uryyTteamoeSS4 = ? AND col_company_Id = ? 
                        ORDER BY userId DESC 
                        LIMIT ? OFFSET ?");
                    $stmt->bind_param("ssii", $teamId, $companyId, $notesPerPage, $offset);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()):
                        $noteId = htmlspecialchars($row['userId']) ?? '';
                        $teamName = htmlspecialchars($row['team_name']) ?? '';
                        $noteTime = htmlspecialchars($row['timeof_note']);
                        $noteDate = date('d M, Y', strtotime($row['dateof_note']));
                        $noteContent = nl2br(htmlspecialchars($row['team_note']));
                    ?>
                        <div class="col-xl-12 mb-3">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5><i class="feather mr-2 icon-briefcase"></i> &nbsp; Notes</h5>
                                    <span class="float-right"><i class="feather mr-2 icon-clock"></i> <?php echo $noteTime; ?></span>
                                </div>
                                <div class="card-body p-0">
                                    <div class="px-3 py-2" style="font-size:16px;">
                                        <?php echo $noteContent; ?>
                                    </div>
                                    <div class="px-3 py-2 bg-dark text-white">
                                        <a class="text-decoration-none text-white" href="./edit-team-note?userId=<?= $noteId ?>&spec=<?= $uryyTteamoeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>">
                                            <span><i class="feather mr-2 icon-check-square"></i> Notice</span> &nbsp; &nbsp;
                                            <span><i class="feather mr-2 icon-user"></i><?php echo $teamName; ?></span>
                                            <span style="float: right;"><i class="feather mr-2 icon-calendar"></i> <?php echo $noteDate; ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    $stmt->close();
                    ?>

                    <nav style="margin-top:-30px;" aria-label="Page navigation example">
                        <ul class="pagination justify-content-left">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>

        <div class="row">
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>