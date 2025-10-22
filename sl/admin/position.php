<?php include('header-contents.php'); ?>


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
                            <h5 class="m-b-10">Add New Position</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Position</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Add Position</h5>
                    </div>
                    <div id="popupAlert"
                        style="display:none; width:100%; margin-bottom:5px; padding:22px; background-color:#c0392b; color:white;">
                        Position already exists
                    </div>
                    <form method="POST" action="./auth-position" enctype="multipart/form-data" autocomplete="off">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="client-form-body p-3">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="positionName">Position</label>
                                                <select style="height: 45px;" name="txtPositionName" required class="form-control"
                                                    id="positionName">
                                                    <option value="" selected disabled>-- Select Option --</option>
                                                    <option value="Health Care Assistant">Health Care Assistant</option>
                                                    <option value="Support worker">Support Worker</option>
                                                    <option value="Personal assistant">Personal Assistant</option>
                                                    <option value="Senior care assistant">Senior Care Assistant</option>
                                                    <option value="Live in carer">Live-in Carer</option>
                                                    <option value="kitchen assistant">Kitchen Assistant</option>
                                                    <option value="Senior Carer">Senior Carer</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Deputy manager">Deputy Manager</option>
                                                    <option value="Care co-ordinator">Care Co-ordinator</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="positionDetails">Position Description</label>
                                                <textarea name="txtPositionDetails" required id="positionDetails"
                                                    class="form-control" rows="5"
                                                    placeholder="Add description..."></textarea>
                                            </div>
                                            <div class="form-group pl-2">
                                                <button type="submit" name="btnSubmitPosition"
                                                    class="btn btn-primary">Add Position</button>
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <h5>Existing Positions</h5>
                                            <div class="card table-card">
                                                <div class="card-body p-0">
                                                    <?php
                                                    include('dbconnect.php');
                                                    $limit = 5;
                                                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
                                                    $offset = ($page - 1) * $limit;
                                                    $countQuery = mysqli_query($myConnection, "SELECT COUNT(*) AS total FROM tbl_position");
                                                    $countRow = mysqli_fetch_assoc($countQuery);
                                                    $total = $countRow['total'];
                                                    $totalPages = ceil($total / $limit);
                                                    $result = mysqli_query($myConnection, "SELECT * FROM tbl_position ORDER BY position_Id DESC LIMIT $limit OFFSET $offset");

                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo "<div class='p-3 border-bottom'>
                                                    <h6 class='mb-1 text-dark fw-semibold'>" . htmlspecialchars($row['position_name']) . "</h6>
                                                    <p class='mb-0 text-secondary'>" . nl2br(htmlspecialchars($row['position_details'])) . "</p>
                                                    </div>";
                                                    }
                                                    ?>


                                                    <nav aria-label="Pagination" class="mt-3 mb-3 text-start px-3">
                                                        <ul class="pagination">
                                                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                                                <a class="page-link"
                                                                    href="?page=<?= max(1, $page - 1) ?>">
                                                                    Previous</a>
                                                            </li>

                                                            <?php
                                                            $range = 5;
                                                            $start = max(1, $page - floor($range / 2));
                                                            $end = min($totalPages, $start + $range - 1);

                                                            if ($start > 1) {
                                                                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                            }

                                                            for ($i = $start; $i <= $end; $i++) {
                                                                $active = ($i == $page) ? 'active' : '';
                                                                echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                                                            }

                                                            if ($end < $totalPages) {
                                                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                                echo "<li class='page-item'><a class='page-link' href='?page=$totalPages'>$totalPages</a></li>";
                                                            }
                                                            ?>

                                                            <li
                                                                class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                                                <a class="page-link"
                                                                    href="?page=<?= min($totalPages, $page + 1) ?>">Next
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>