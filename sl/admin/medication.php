<?php
include('header-contents.php');
include('processing-add-medication.php');
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
                            <h5 class="m-b-10">Add new medicine</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Medicine</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Add more medicine</h5>
                    </div>
                    <div id="popupAlert"
                        style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                        Medicine already exist
                    </div>
                    <form method="POST" action="./auth-new-medication" enctype="multipart/form-data"
                        name="addClient-form" autocomplete="off">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                    <div class="row">
                                        <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-md-4">
                                            <h5>Medication Form</h5>
                                            <hr>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Medicine name</label>
                                                <input style="height: 45px;" name="txtMedName" required type="text" class="form-control"
                                                    placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Dosage</label>
                                                <input style="height: 45px;" name="txtMedDosage" required type="text" class="form-control"
                                                    placeholder="Dosage">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Type</label>
                                                <select style="height: 45px;" name="txtMedType" required class="form-control">
                                                    <option value="" disabled selected>--Select Option--</option>
                                                    <option value="Tablets">Tablets</option>
                                                    <option value="General cream">General cream</option>
                                                    <option value="Capsule">Capsule</option>
                                                    <option value="Syrup">Syrup</option>
                                                    <option value="Body cream">Body cream</option>
                                                    <option value="Harm cream">Harm cream</option>
                                                    <option value="Let cream">Let cream</option>
                                                    <option value="Face cream">Face cream</option>
                                                    <option value="Barrier cream">Barrier cream</option>
                                                    <option value="Cream">Cream</option>
                                                    <option value="Air spray">Air spray</option>
                                                    <option value="Air freshner">Air freshner</option>
                                                    <option value="Body spray">Body spray</option>
                                                    <option value="Perfume">Perfume</option>
                                                    <option value="Patches">Patches</option>
                                                    <option value="Oral Solution">Oral Solution</option>
                                                    <option value="Roll-on deodorants">Roll-on deodorants</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="btnSubmitNewMed" class="btn btn-primary">Save Medicine</button>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h5>Medication</h5>
                                            <div class="card table-card">
                                                <div class="card-header">
                                                    <h5>Recent meds</h5>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Medicine name</th>
                                                                    <th>Dosage</th>
                                                                    <th>Type</th>
                                                                    <th class="text-right">Decision</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $limit = 10;
                                                                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
                                                                $offset = ($page - 1) * $limit;
                                                                $result = mysqli_query($conn, "SELECT * FROM tbl_medication_list ORDER BY id DESC LIMIT $limit OFFSET $offset");
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    echo "<tr>
                                                                        <td><h6>{$row['med_name']}</h6></td>
                                                                        <td>{$row['med_dosage']}</td>
                                                                        <td>{$row['med_type']}</td>
                                                                        <td class='text-right'><button class='btn btn-danger btn-sm'>Delete</button></td>
                                                                    </tr>";
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <nav>
                                                        <ul class="pagination justify-content-start mt-2 px-0">
                                                            <li class=" page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                                                <a class="page-link"
                                                                    href="?page=<?= max(1, $page - 1) ?>">Previous</a>
                                                            </li>

                                                            <?php
                                                            $resultTotal = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_medication_list");
                                                            $totalRows = mysqli_fetch_assoc($resultTotal)['total'];
                                                            $totalPages = ceil($totalRows / $limit);
                                                            $range = 5;
                                                            $start = max(1, $page - floor($range / 2));
                                                            $end = min($totalPages, $start + $range - 1);

                                                            if ($start > 1) {
                                                                echo "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li>";
                                                                echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                                                            }

                                                            for ($i = $start; $i <= $end; $i++) {
                                                                $active = $i == $page ? 'active' : '';
                                                                echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                                                            }

                                                            if ($end < $totalPages) {
                                                                echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                                                                echo "<li class='page-item'><a class='page-link' href='?page=$totalPages'>$totalPages</a></li>";
                                                            }
                                                            ?>

                                                            <li
                                                                class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                                                <a class="page-link"
                                                                    href="?page=<?= min($totalPages, $page + 1) ?>">Next</a>
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
        </div>
    </div>
</div>
<?php include('footer-contents.php'); ?>