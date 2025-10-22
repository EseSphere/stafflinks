<?php
include('header-contents.php');
$limit = 10; // records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM (SELECT MAX(submitted_at) as latest 
FROM tbl_ratings GROUP BY uryyToeSS4) as grouped");
$countStmt->execute();
$totalRows = $countStmt->get_result()->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);
?>

<style>
    .pagination .page-link {
        font-size: 0.88rem;
        padding: 0.30rem 0.7rem;
        margin: 0 5px;
        background-color: #f8f9fa;
        color: #6c757d;
        border: 1x solid #dee2e6;
        transition: all 0.2s ease;
    }

    .pagination .active .page-link {
        background-color: #007bff;
        color: #ffffff;
        border-color: #6c757d;
    }

    .pagination .disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="mb-1">Client Feedback Overview</h5>
                            <p class="text-muted fs-6">A comprehensive summary of all submitted ratings and client
                                feedback.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card table-card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ratings & Feedback</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Stars</th>
                                        <th>Client Name</th>
                                        <th>Feedback</th>
                                        <th>Submitted At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $conn->prepare("
                                        SELECT r.* FROM tbl_ratings r
                                        INNER JOIN (
                                            SELECT uryyToeSS4, MAX(submitted_at) AS latest 
                                            FROM tbl_ratings 
                                            GROUP BY uryyToeSS4
                                        ) latest_ratings 
                                        ON r.uryyToeSS4 = latest_ratings.uryyToeSS4 
                                        AND r.submitted_at = latest_ratings.latest 
                                        ORDER BY r.submitted_at DESC
                                        LIMIT ? OFFSET ?
                                    ");
                                    $stmt->bind_param("ii", $limit, $offset);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $counter = $offset + 1;
                                    while ($row = $result->fetch_assoc()):
                                        $fullFeedback = htmlspecialchars($row['feedback']);
                                        $words = explode(' ', $fullFeedback);
                                        $shortFeedback = count($words) > 5 ? '... ' . implode(' ', array_slice($words, 0, 5)) : $fullFeedback;
                                        $feedbackId = 'feedbackModal' . $counter;
                                    ?>
                                        <tr>
                                            <td><?= $counter ?></td>
                                            <td><?= str_repeat('⭐', $row['stars']) ?> (<?= $row['stars'] ?>/5)</td>
                                            <td><?= htmlspecialchars($row['clientName']) ?></td>
                                            <td>
                                                <span title="<?= $fullFeedback ?>"
                                                    style="cursor:pointer; text-decoration:underline;" data-toggle="modal"
                                                    data-target="#<?= $feedbackId ?>">
                                                    <?= $shortFeedback ?>
                                                </span>
                                                <div class="modal fade" id="<?= $feedbackId ?>" tabindex="-1" role="dialog"
                                                    aria-labelledby="modalLabel<?= $counter ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel<?= $counter ?>">Full
                                                                    Feedback</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" style="white-space: pre-wrap; max-height: 60vh; overflow-y: auto;"><?= nl2br($fullFeedback) ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= date("d F Y", strtotime($row['submitted_at'])) ?></td>
                                        </tr>
                                    <?php
                                        $counter++;
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <nav aria-label="Feedback Pagination">
                            <ul class="pagination justify-content-left mb-0">
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1">Previous</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
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