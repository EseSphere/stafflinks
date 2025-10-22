<?php include('header-contents.php'); ?>
<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Annual Leave <br>
                                <small>Notification</small>
                            </h5>
                        </div>
                        <ul class="breadcrumb">
                            <li style="font-size:16px;" class="breadcrumb-item">
                                Use annual leave to manage your team's time off
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
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
                        <div style="margin-top: 15px;" class="row"></div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Team Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_notification = "SELECT * FROM tbl_team_status WHERE (col_approval = 'Awaiting Approval' 
                                    AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
                                    $result_notific = $conn->query($sql_notification);
                                    if ($result_notific->num_rows > 0) {
                                        while ($row_notific = $result_notific->fetch_assoc()) {
                                    ?>
                                            <tr style="background-color:<?php print "" . $row_notific["col_color_code"] . ""; ?>;">
                                                <td>
                                                    <div class="d-inline-block align-middle">
                                                        <div class="d-inline-block">
                                                            <h6><?php print "" . $row_notific["col_full_name"] . ""; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php print "" . $row_notific["col_startDate"] . ""; ?></td>
                                                <td><?php print "" . $row_notific["col_endDate"] . ""; ?></td>
                                                <td><?php print "" . $row_notific["col_team_condition"] . ""; ?></td>
                                                <td><?php print "" . $row_notific["col_approval"] . ""; ?></td>
                                                <td>
                                                    <a style="text-decoration:none;" href="./carer-availability?uryyTteamoeSS4=<?php print "" . $row_notific["uryyTteamoeSS4"] . ""; ?>">
                                                        <button title="View annual leave details" type="button" class="btn btn-info btn-sm"><i class="feather mr-2 icon-eye"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
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