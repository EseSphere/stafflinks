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
                            <h5 class="m-b-10">Add new task</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Task</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Add more task</h5>
                    </div>
                    <div id="popupAlert"
                        style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                        Task already exist
                    </div>
                    <form method="POST" action="./auth-client-task" enctype="multipart/form-data" name="addClient-form"
                        autocomplete="off">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Task title</label>
                                                <input style="height: 45px;" name="txtTaskTitle" required type="text" class="form-control"
                                                    id="exampleInputPassword1" placeholder="Add task">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Task categories</label>
                                                <select style="height: 45px;" name="txtTaskCategories" required class="form-control"
                                                    id="exampleInputPassword1">
                                                    <option value="" selected disabled>--Select Option--</option>
                                                    <option value="Environmental">Environmental</option>
                                                    <option value="Social support">Social support</option>
                                                    <option value="Personal care">Personal care</option>
                                                    <option value="Administrative">Administrative</option>
                                                    <option value="Everyday activities">Everyday activities</option>
                                                    <option value="Nutrition and hydration">Nutrition and hydration
                                                    </option>
                                                    <option value="Medical">Medical</option>
                                                    <option value="Psychological">Psychological</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div style="padding: 0px 0px 0px 15px;" class="form-group">
                                                <button type="submit" name="btnSubmitTask" class="btn btn-primary">Add
                                                    more task</button>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <h4>Tasks</h4>
                                            <br>
                                            <div class="card table-card">
                                                <div class="card-header">
                                                    <h5>Recent task</h5>
                                                    <div class="card-header-right">
                                                        <div class="btn-group card-option">
                                                            <button type="button" class="btn dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="feather icon-more-horizontal"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tasks title</th>
                                                                    <th>Category</th>
                                                                    <th>Date uploaded</th>
                                                                    <th class="text-left">Decision</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                include('dbconnect.php');
                                                                $limit = 10;
                                                                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
                                                                $offset = ($page - 1) * $limit;
                                                                $result = mysqli_query($myConnection, "SELECT * FROM tbl_task_list ORDER BY task_id DESC LIMIT $limit OFFSET $offset");
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    echo "
                                                                        <tr>
                                                                            <td>
                                                                                <div class='d-inline-block align-middle'>
                                                                                    <div class='d-inline-block'>
                                                                                        <h6>" . $row['task_title'] . "</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>" . $row['task_category'] . "</td>
                                                                            <td>" . $row['dateTime'] . "</td>
                                                                            <td class='text-right'>
                                                                                <a href=''><button type='button' class='btn btn-danger btn-sm'>Delete</button></a>
                                                                            </td>
                                                                        </tr>
                                                                    ";
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php
                                                $total_result = mysqli_query($myConnection, "SELECT COUNT(*) as total FROM tbl_task_list");
                                                $row = mysqli_fetch_assoc($total_result);
                                                $total_pages = ceil($row['total'] / $limit);
                                                if ($total_pages > 1) {
                                                    echo '<div class="card-footer">';
                                                    echo '<nav><ul class="pagination justify-content-start mt-2 px-0">';

                                                    $prev = $page > 1 ? $page - 1 : 1;
                                                    $next = $page < $total_pages ? $page + 1 : $total_pages;

                                                    echo '<li class="page-item ' . ($page == 1 ? 'disabled' : '') . '"><a class="page-link" href="?page=' . $prev . '">Previous</a></li>';

                                                    $range = 5;
                                                    $start = max(1, $page - floor($range / 2));
                                                    $end = min($total_pages, $start + $range - 1);

                                                    if ($start > 1) {
                                                        echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                                        if ($start > 2) {
                                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                        }
                                                    }

                                                    for ($i = $start; $i <= $end; $i++) {
                                                        $active = ($i == $page) ? 'active' : '';
                                                        echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                                    }

                                                    if ($end < $total_pages) {
                                                        if ($end < $total_pages - 1) {
                                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                        }
                                                        echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                                                    }

                                                    echo '<li class="page-item ' . ($page == $total_pages ? 'disabled' : '') . '"><a class="page-link" href="?page=' . $next . '">Next</a></li>';

                                                    echo '</ul></nav></div>';
                                                }
                                                ?>
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
</div>

<?php include('footer-contents.php'); ?>