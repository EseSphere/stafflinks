<?php
include('client-header-contents.php');
$clientId = $_GET['uryyToeSS4'] ?? '';

$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("s", $clientId);
$stmt->execute();
$result = $stmt->get_result();
$clientData = $result->fetch_assoc();
$clientName = $clientData['client_first_name'] ?? '' . ' ' . $clientData['client_last_name'] ?? '';
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_client_notes 
WHERE uryyToeSS4 = ?");
$stmt->bind_param("s", $clientId);
$stmt->execute();
$result = $stmt->get_result();
$noteCount = $result->fetch_assoc()['total'] ?? 0;
$stmt->close();
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <h4>Note <sup>(<?php echo $noteCount; ?>)</sup></h4>
        <p class="fs-6">View all <?php echo htmlspecialchars($clientName); ?>'s notes and modify.</p>
        <hr>
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <h5><strong>Notes</strong></h5>
                    <?php
                    $notesPerPage = 5;
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $notesPerPage;

                    $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_client_notes 
                    WHERE uryyToeSS4 = ?");
                    $countStmt->bind_param("s", $clientId);
                    $countStmt->execute();
                    $totalNotes = $countStmt->get_result()->fetch_assoc()['total'];
                    $totalPages = ceil($totalNotes / $notesPerPage);
                    $countStmt->close();

                    $stmt = $conn->prepare("SELECT userId, team_name, uryyToeSS4, client_note, timeof_note, dateof_note 
                        FROM tbl_client_notes 
                        WHERE uryyToeSS4 = ? ORDER BY userId DESC 
                        LIMIT ? OFFSET ?");
                    $stmt->bind_param("sii", $clientId, $notesPerPage, $offset);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()):
                        $userId = htmlspecialchars($row['userId']) ?? '';
                        $teamName = htmlspecialchars($row['team_name']) ?? '';
                        $uryyToeSS4 = htmlspecialchars($row['uryyToeSS4']) ?? '';
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
                                    <div class="px-3 py-2 bg-dark text-white">
                                        <span><i class="feather mr-2 icon-check-square"></i> Notice</span> &nbsp; &nbsp;
                                        <span><i class="feather mr-2 icon-user"></i><?php echo $teamName; ?></span>
                                        <span style="float: right;"><i class="feather mr-2 icon-calendar"></i> <?php echo $noteDate; ?></span>
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
    </div>
</div>

<?php include('footer-contents.php'); ?>