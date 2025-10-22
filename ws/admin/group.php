<?php include('header-contents.php'); ?>
<?php include('dbconnect.php'); ?>


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
                            <h5 class="m-b-10">Add new group</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Group</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Add more group</h5>
                    </div>
                    <div id="popupAlert"
                        style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                        Group already exist
                    </div>
                    <form method="POST" action="./auth-client-group" enctype="multipart/form-data" name="addClient-form"
                        autocomplete="off">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Group area - (example Pattingham,
                                                    Codsall)</label>
                                                <input style="height: 45px;" name="txtGroupArea" required type="text" class="form-control"
                                                    id="exampleInputPassword1" placeholder="Group area">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Group city - (example Wolverhampton,
                                                    Walsall)</label>
                                                <select style="height: 45px;" name="txtGroupCity" required type="text" class="form-control"
                                                    id="exampleFormControlSelect1" placeholder="City">
                                                    <optgroup label="England">England
                                                        <option value="Bath">Bath</option>
                                                        <option value="Birmingham">Birmingham</option>
                                                        <option value="Bradford">Bradford</option>
                                                        <option value="Brighton & Hove">Brighton & Hove</option>
                                                        <option value="Bristol">Bristol</option>
                                                        <option value="Cambridge">Cambridge</option>
                                                        <option value="Canterbury">Canterbury</option>
                                                        <option value="Carlisle">Carlisle</option>
                                                        <option value="Chelmsford">Chelmsford</option>
                                                        <option value="Chester">Chester</option>
                                                        <option value="Chichester">Chichester</option>
                                                        <option value="Colchester">Colchester</option>
                                                        <option value="Coventry">Coventry</option>
                                                        <option value="Derby">Derby</option>
                                                        <option value="Doncaster">Doncaster</option>
                                                        <option value="Durham">Durham</option>
                                                        <option value="Ely">Ely</option>
                                                        <option value="Exeter">Exeter</option>
                                                        <option value="Gloucester">Gloucester</option>
                                                        <option value="Hereford">Hereford</option>
                                                        <option value="Kingston-upon-Hull">Kingston-upon-Hull</option>
                                                        <option value="Lancaster">Lancaster</option>
                                                        <option value="Leeds">Leeds</option>
                                                        <option value="Leicester">Leicester</option>
                                                        <option value="Lichfield">Lichfield</option>
                                                        <option value="Lincoln">Lincoln</option>
                                                        <option value="Liverpool">Liverpool</option>
                                                        <option value="London">London</option>
                                                        <option value="Manchester">Manchester</option>
                                                        <option value="Milton Keynes">Milton Keynes</option>
                                                        <option value="Newcastle-upon-Tyne">Newcastle-upon-Tyne</option>
                                                        <option value="Norwich">Norwich</option>
                                                        <option value="Nottingham">Nottingham</option>
                                                        <option value="Oxford">Oxford</option>
                                                        <option value="Peterborough">Peterborough</option>
                                                        <option value="Plymouth">Plymouth</option>
                                                        <option value="Portsmouth">Portsmouth</option>
                                                        <option value="Preston">Preston</option>
                                                        <option value="Ripon">Ripon</option>
                                                        <option value="Salford">Salford</option>
                                                        <option value="Salisbury">Salisbury</option>
                                                        <option value="Sheffield">Sheffield</option>
                                                        <option value="Southampton">Southampton</option>
                                                        <option value="Southend-on-Sea">Southend-on-Sea</option>
                                                        <option value="St Albans">St Albans</option>
                                                        <option value="Stoke on Trent">Stoke on Trent</option>
                                                        <option value="Sunderland">Sunderland</option>
                                                        <option value="Truro">Truro</option>
                                                        <option value="Wakefield">Wakefield</option>
                                                        <option value="Wells">Wells</option>
                                                        <option value="Westminster">Westminster</option>
                                                        <option value="Winchester">Winchester</option>
                                                        <option value="Wolverhampton">Wolverhampton</option>
                                                        <option value="Worcester">Worcester</option>
                                                        <option value="York">York</option>
                                                    </optgroup>

                                                    <optgroup label="Northern Ireland">Northern Ireland
                                                        <option value="Armagh">Armagh</option>
                                                        <option value="Bangor">Bangor</option>
                                                        <option value="Belfast">Belfast</option>
                                                        <option value="Lisburn">Lisburn</option>
                                                        <option value="Londonderry">Londonderry</option>
                                                        <option value="Newry">Newry</option>
                                                    </optgroup>


                                                    <optgroup label="Scotland">Scotland
                                                        <option value="Aberdeen">Aberdeen</option>
                                                        <option value="Dundee">Dundee</option>
                                                        <option value="Dunfermline">Dunfermline</option>
                                                        <option value="Edinburgh">Edinburgh</option>
                                                        <option value="Glasgow">Glasgow</option>
                                                        <option value="Inverness">Inverness</option>
                                                        <option value="Perth">Perth</option>
                                                        <option value="Stirling">Stirling</option>
                                                    </optgroup>

                                                    <optgroup label="Wales">Wales
                                                        <option value="Bangor">Bangor</option>
                                                        <option value="Cardiff">Cardiff</option>
                                                        <option value="Newport">Newport</option>
                                                        <option value="St Asaph">St Asaph</option>
                                                        <option value="St Davids">St Davids</option>
                                                        <option value="Swansea">Swansea</option>
                                                        <option value="Wrexham">Wrexham</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div style="padding: 0px 0px 0px 15px;" class="form-group">
                                                <button type="submit" name="btnSubmitGroup" class="btn  btn-primary">Add
                                                    more group</button>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <h4>Group/Areas</h4>
                                            <div class="card table-card">
                                                <div class="card-header">
                                                    <h5>Recent group</h5>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Group/Area</th>
                                                                    <th>City located</th>
                                                                    <th>Date uploaded</th>
                                                                    <th class="text-right">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $limit = 10;
                                                                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
                                                                $offset = ($page - 1) * $limit;
                                                                $total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_group_list");
                                                                $total_result = mysqli_fetch_assoc($total_query);
                                                                $total_groups = $total_result['total'];
                                                                $total_pages = ceil($total_groups / $limit);
                                                                $result = mysqli_query($conn, "SELECT * FROM tbl_group_list ORDER BY group_id DESC LIMIT $limit OFFSET $offset");
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    echo "
                                                                        <tr>
                                                                            <td>
                                                                                <div class='d-inline-block align-middle'>
                                                                                    <div class='d-inline-block'>
                                                                                        <h6>" . $row['group_area'] . "</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>" . $row['group_city'] . "</td>
                                                                            <td>" . $row['dateTime'] . "</td>
                                                                            <td class='text-right'>
                                                                                <a href=''><button type='button' class='btn  btn-danger btn-sm'>Delete</button> </a>
                                                                            </td>
                                                                        </tr>
                                                                    ";
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <nav aria-label="Group pagination" class="mt-4 px-3">
                                                            <ul class="pagination justify-content-start">
                                                                <li class="page-item me-1 <?= $page <= 1 ? 'disabled' : '' ?>">
                                                                    <a class="page-link"
                                                                        href="?page=<?= max(1, $page - 1); ?>">Previous</a>
                                                                </li>

                                                                <?php
                                                                $range = 1;
                                                                $start = max(1, $page - $range);
                                                                $end = min($total_pages, $page + $range);
                                                                if ($start > 1) {
                                                                    echo '<li class="page-item me-1"><a class="page-link" href="?page=1">1</a></li>';
                                                                    if ($start > 2) echo '<li class="page-item disabled me-1"><span class="page-link">...</span></li>';
                                                                }

                                                                for ($i = $start; $i <= $end; $i++) {
                                                                    $activeClass = ($i == $page) ? 'active' : '';
                                                                    echo "<li class='page-item me-1 $activeClass'><a class='page-link' href='?page=$i'>$i</a></li>";
                                                                }

                                                                if ($end < $total_pages) {
                                                                    if ($end < $total_pages - 1) echo '<li class="page-item disabled me-1"><span class="page-link">...</span></li>';
                                                                    echo '<li class="page-item me-1"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                                                                }
                                                                ?>

                                                                <li
                                                                    class="page-item me-1 <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                                                    <a class="page-link"
                                                                        href="?page=<?= min($total_pages, $page + 1); ?>">Next</a>
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
                        </div>
                    </form>
                </div>
            </div>

            <?php include('bottom-panel-block.php'); ?>
            <?php include('footer-contents.php'); ?>