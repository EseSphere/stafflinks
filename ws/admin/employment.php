<?php
include('header-contents.php');
if (isset($_GET['uryyTteamoeSS4'])) {
    $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">
                                Employment <br>
                                <small>Team employment details</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-sm-12 col-lg-12 col-md-12">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Pay Rate</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
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
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Employment Type</th>
                                        <th>DBS</th>
                                        <th>NI</th>
                                        <th>Pay Rate</th>
                                        <th>Rate Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_general_team_form 
                                    WHERE uryyTteamoeSS4 = ? AND col_company_Id = ?");
                                    $stmt->bind_param("ss", $uryyTteamoeSS4, $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo <<<HTML
                                            <tr>
                                            <td>{$row['employment_type']}</td>
                                            <td>{$row['team_dbs']}</td>
                                                <td>{$row['team_nin']}</td>
                                                <td style="font-weight:600;">£{$row['col_pay_rate']}</td>
                                                <td>{$row['col_rate_type']}</td>
                                            </tr>
                                            HTML;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-12 col-sm-12 col-lg-12 col-md-12 mt-5">
                <div class="card tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <div class="card-header">
                        <h5>Mileage Rate</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
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
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Employment Type</th>
                                        <th>DBS</th>
                                        <th>NI</th>
                                        <th>Mileage</th>
                                        <th>Transportation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM tbl_general_team_form 
                                    WHERE uryyTteamoeSS4 = ? AND col_company_Id = ?");
                                    $stmt->bind_param("ss", $uryyTteamoeSS4, $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo <<<HTML
                                            <tr>
                                            <td>{$row['employment_type']}</td>
                                            <td>{$row['team_dbs']}</td>
                                                <td>{$row['team_nin']}</td>
                                                <td style="font-weight:600;">£{$row['col_mileage']}</td>
                                                <td>{$row['transportation']}</td>
                                            </tr>
                                            HTML;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>
</div>
</div>

<?php include('footer-contents.php'); ?>