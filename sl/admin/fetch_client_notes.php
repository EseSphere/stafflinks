<?php
include('dbconnections.php'); // include DB connection and session
$clientId = $_GET['clientId'] ?? '';
$companyId = $_SESSION['usr_compId'];
$searchKeyword = trim($_GET['search'] ?? '');
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$notesPerPage = 5;
$offset = ($page - 1) * $notesPerPage;

// Count total notes
$countSql = "SELECT COUNT(*) as total FROM tbl_client_notes WHERE uryyToeSS4 = ? AND col_company_Id = ?";
if ($searchKeyword !== '') {
    $countSql .= " AND client_note LIKE ?";
    $likeKeyword = "%$searchKeyword%";
    $stmt = $conn->prepare($countSql);
    $stmt->bind_param("sss", $clientId, $companyId, $likeKeyword);
} else {
    $stmt = $conn->prepare($countSql);
    $stmt->bind_param("ss", $clientId, $companyId);
}
$stmt->execute();
$totalNotes = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
$stmt->close();

$totalPages = ceil($totalNotes / $notesPerPage);

// Fetch notes
$selectSql = "SELECT userId, team_name, uryyToeSS4, client_note, timeof_note, dateof_note 
              FROM tbl_client_notes WHERE uryyToeSS4 = ? AND col_company_Id = ?";
if ($searchKeyword !== '') {
    $selectSql .= " AND client_note LIKE ?";
    $stmt = $conn->prepare($selectSql . " ORDER BY userId DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("sssii", $clientId, $companyId, $likeKeyword, $notesPerPage, $offset);
} else {
    $stmt = $conn->prepare($selectSql . " ORDER BY userId DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ssii", $clientId, $companyId, $notesPerPage, $offset);
}
$stmt->execute();
$result = $stmt->get_result();

// Display notes
while ($row = $result->fetch_assoc()):
    $userId = htmlspecialchars($row['userId']);
    $teamName = htmlspecialchars($row['team_name']);
    $uryyToeSS4 = htmlspecialchars($row['uryyToeSS4']);
    $noteTime = htmlspecialchars($row['timeof_note']);
    $noteDate = date('d M, Y', strtotime($row['dateof_note']));
    $noteContent = nl2br(htmlspecialchars($row['client_note']));
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
                <a href="./edit-client-note?userId=<?= $userId ?>&uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>" style="text-decoration:none; color:#000;">
                    <div class="px-3 py-2 bg-dark text-white">
                        <span><i class="feather mr-2 icon-check-square"></i> Notice</span> &nbsp; &nbsp;
                        <span><i class="feather mr-2 icon-user"></i><?= $teamName ?></span>
                        <span style="float: right;"><i class="feather mr-2 icon-calendar"></i> <?= $noteDate ?></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<!-- Pagination -->
<nav style="margin-top:0px;" aria-label="Page navigation example">
    <ul class="pagination justify-content-left">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>&clientId=<?= urlencode($clientId) ?>">« Previous</a>
            </li>
        <?php endif; ?>

        <?php
        $range = 2;
        if ($page > ($range + 2)) {
            echo '<li class="page-item"><a class="page-link" href="?page=1&clientId=' . urlencode($clientId) . '">1</a></li>';
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        for ($i = max(1, $page - $range); $i <= min($totalPages, $page + $range); $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '&clientId=' . urlencode($clientId) . '">' . $i . '</a></li>';
        }
        if ($page < ($totalPages - $range - 1)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '&clientId=' . urlencode($clientId) . '">' . $totalPages . '</a></li>';
        }
        ?>
        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>&clientId=<?= urlencode($clientId) ?>">Next »</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>