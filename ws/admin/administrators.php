<?php include('header-contents.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Admin</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Admin board</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Admin</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email address</th>
                                        <th>Date registered</th>
                                        <th>Time registered</th>
                                        <th>Decision </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $conn->prepare("SELECT user_fullname, verification_code, user_email_address, 
                                    date_registered, time_registered, user_special_Id, status1, status2 FROM tbl_goesoft_users 
                                    WHERE col_company_Id = ? ORDER BY userId DESC");
                                    $stmt->bind_param("s", $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($trans = $result->fetch_assoc()) {
                                        echo "
                                            <tr>
                                                <td>
                                                    <div class='d-inline-block align-middle'>
                                                        <img src='assets/images/profile/profile-icon.jpg' alt='user image' class='img-radius wid-40 align-top m-r-15'>
                                                        <div class='d-inline-block'>
                                                            <h6>" . htmlspecialchars($trans['user_fullname']) . "</h6>
                                                            <p style='color:red;' class='text-muted m-b-0'><strong>" . htmlspecialchars($trans['verification_code']) . "</strong></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>" . htmlspecialchars($trans['user_email_address']) . "</td>
                                                <td>" . (new DateTime($trans['date_registered']))->format('d, F Y') . "</td>
                                                <td>" . htmlspecialchars($trans['time_registered']) . "</td>
                                                <td>
                                                    <a style='text-decoration:none;' href='./deactivate-admin?user_special_Id=" . urlencode($trans['user_special_Id']) . "'>
                                                        <button title='Delete this admin' type='button' " . htmlspecialchars($trans['status1']) . " class='btn btn-primary btn-sm'>Deactivate</button>
                                                    </a>
                                                    <a style='text-decoration:none;' href='./activate-admin?user_special_Id=" . urlencode($trans['user_special_Id']) . "'>
                                                        <button title='Activate this admin' type='button' " . htmlspecialchars($trans['status2']) . " class='btn btn-info btn-sm'>Activate</button>
                                                    </a>
                                                    <a style='text-decoration:none;' href='./finance-access?user_special_Id=" . urlencode($trans['user_special_Id']) . "'>
                                                        <button title='Grant user finance access' type='button' class='btn btn-success btn-sm'>Finance</button>
                                                    </a>
                                                    <a style='text-decoration:none;' href='./admin-access?user_special_Id=" . urlencode($trans['user_special_Id']) . "'>
                                                        <button title='Grant user admin access' type='button' class='btn btn-secondary btn-sm'>Admin</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            ";
                                    }
                                    $stmt->close();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>