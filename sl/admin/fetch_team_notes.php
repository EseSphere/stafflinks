<?php
include('dbconnections.php'); // include DB connection and session
$teamId = $_GET['teamId'] ?? '';
$companyId = $_SESSION['usr_compId'];
$searchKeyword = trim($_GET['search'] ?? '');
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$notesPerPage = 5;
$offset = ($page - 1) * $notesPerPage;

// Count total notes
$countSql = "SELECT COUNT(*) as total FROM tbl_team_notes WHERE uryyTteamoeSS4 = ? AND col_company_Id = ?";
if ($searchKeyword !== '') {
    $countSql .= " AND team_note LIKE ?";
    $likeKeyword = "%$searchKeyword%";
    $stmt = $conn->prepare($countSql);
    $stmt->bind_param("sss", $teamId, $companyId, $likeKeyword);
} else {
    $stmt = $conn->prepare($countSql);
    $stmt->bind_param("ss", $teamId, $companyId);
}
$stmt->execute();
$totalNotes = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
$stmt->close();

$totalPages = ceil($totalNotes / $notesPerPage);

// Fetch notes
$selectSql = "SELECT * FROM tbl_team_notes WHERE uryyTteamoeSS4 = ? AND col_company_Id = ?";
if ($searchKeyword !== '') {
    $selectSql .= " AND team_note LIKE ?";
    $stmt = $conn->prepare($selectSql . " ORDER BY userId DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("sssii", $teamId, $companyId, $likeKeyword, $notesPerPage, $offset);
} else {
    $stmt = $conn->prepare($selectSql . " ORDER BY userId DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ssii", $teamId, $companyId, $notesPerPage, $offset);
}
$stmt->execute();
$result = $stmt->get_result();

// Display notes
while ($row = $result->fetch_assoc()):
    $noteId = htmlspecialchars($row['userId']);
    $teamName = htmlspecialchars($row['team_name']);
    $noteTime = htmlspecialchars($row['timeof_note']);
    $noteDate = date('d M, Y', strtotime($row['dateof_note']));
    $noteContent = nl2br(htmlspecialchars($row['team_note']));
?>
    <div class="col-xl-12 mb-3">
        <div class="card table-card">
            <div class="card-header">
                <h5><i class="feather mr-2 icon-briefcase"></i> &nbsp; Notes</h5>
                <span class="float-right"><i class="feather mr-2 icon-clock"></i> <?= $noteTime ?></span>
            </div>
            <div class="card-body p-0">
                <div class="px-3 py-2" style="font-size:16px;">
                    <?= $noteContent ?>
                </div>
                <div class="px-3 py-2 bg-dark text-white">
                    <a class="text-decoration-none text-white" href="./edit-team-note?userId=<?= $noteId ?>&spec=<?= $teamId ?>&u7ye=<?= $crackEncryptedbinary ?>">
                        <span><i class="feather mr-2 icon-check-square"></i> Notice</span> &nbsp; &nbsp;
                        <span><i class="feather mr-2 icon-user"></i><?= $teamName ?></span>
                        <span style="float: right;"><i class="feather mr-2 icon-calendar"></i> <?= $noteDate ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<!-- Pagination -->
<nav style="margin-top:-30px;" aria-label="Page navigation example">
    <ul class="pagination justify-content-left">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>&teamId=<?= urlencode($teamId) ?>">« Previous</a>
            </li>
        <?php endif; ?>

        <?php
        $range = 2;
        for ($i = max(1, $page - $range); $i <= min($totalPages, $page + $range); $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '&teamId=' . urlencode($teamId) . '">' . $i . '</a></li>';
        }
        ?>
        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>&teamId=<?= urlencode($teamId) ?>">Next »</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>