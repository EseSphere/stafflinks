<?php
include('client-header-contents.php');
$userId = $_GET['userId'] ?? '';
$clientId = $_GET['uryyToeSS4'] ?? '';
$companyId = $_SESSION['usr_compId'];

$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? AND col_company_Id = ? 
ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $clientId, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$clientData = $result->fetch_assoc();
$clientName = ($clientRow['col_firstName'] ?? '') . ' ' . ($clientRow['col_lastName'] ?? '');
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM tbl_client_notes 
WHERE userId = ? AND uryyToeSS4 = ? AND col_company_Id = ? 
ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("iss", $userId, $clientId, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$clientData = $result->fetch_assoc();
$clientNote = $clientData['client_note'] ?? '';
$stmt->close();
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <h4>Edit Note</h4>
        <p class="fs-6">Edit current <?php echo htmlspecialchars($clientName); ?>'s notes and modify.</p>
        <hr>
        <div class="row">
            <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px; height:300px;" class="col-md-5">
                <h5 class="mt-3">Update note</h5>
                <form action="./update-client-note" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="textTeamName" value="<?php echo htmlspecialchars($_SESSION['usr_userName']); ?>" />
                    <input type="hidden" name="txtClientSpecialId" value="<?php echo htmlspecialchars($clientId); ?>" />
                    <input type="hidden" name="txtClientId" value="<?= $userId ?>" />

                    <div class="form-group">
                        <textarea name="txtClientNote" required style="resize: none;" class="form-control" rows="6"><?php echo htmlspecialchars($clientNote); ?></textarea>
                    </div>
                    <div class="form-group">
                        <button onclick="location.reload();" type="button" class="btn btn-small btn-danger">Reset form</button>
                        <input type="submit" name="btnUpdateClientNote" class="btn btn-small btn-primary" value="Save note" />
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
                    $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_client_notes 
                    WHERE uryyToeSS4 = ? AND col_company_Id = ?");
                    $countStmt->bind_param("ss", $clientId, $companyId);
                    $countStmt->execute();
                    $totalNotes = $countStmt->get_result()->fetch_assoc()['total'];
                    $totalPages = ceil($totalNotes / $notesPerPage);
                    $countStmt->close();

                    $stmt = $conn->prepare("SELECT * FROM tbl_client_notes 
                    WHERE uryyToeSS4 = ? AND col_company_Id = ? ORDER BY userId 
                    DESC LIMIT ? OFFSET ?");
                    $stmt->bind_param("ssii", $clientId, $companyId, $notesPerPage, $offset);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()):
                        $noteId = htmlspecialchars($row['userId']) ?? '';
                        $teamName = htmlspecialchars($row['team_name']) ?? '';
                        $noteTime = htmlspecialchars($row['timeof_note']);
                        $noteDate = date('d M, Y', strtotime($row['dateof_note']));
                        $noteContent = nl2br(htmlspecialchars($row['client_note']));
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
                                    <a href="./edit-client-note?userId=<?= $noteId ?>&uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" style="text-decoration:none; color:#000;">
                                        <div class="px-3 py-2 bg-dark text-white">
                                            <span><i class="feather mr-2 icon-check-square"></i> Notice</span> &nbsp; &nbsp;
                                            <span><i class="feather mr-2 icon-user"></i><?php echo $teamName; ?></span>
                                            <span style="float: right;"><i class="feather mr-2 icon-calendar"></i> <?php echo $noteDate; ?></span>
                                        </div>
                                    </a>
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
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&uryyToeSS4=<?php echo urlencode($clientId); ?>">&laquo; Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&uryyToeSS4=<?php echo urlencode($clientId); ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&uryyToeSS4=<?php echo urlencode($clientId); ?>">Next &raquo;</a>
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