<?php include('client-header-contents.php');
$sql_query = "SELECT col_time, col_reason, col_start_date, col_end_date, col_note, MAX(userId) 
AS latestUserId FROM tbl_client_status_records WHERE col_client_Id = '$uryyToeSS4' 
AND col_company_Id = '" . $_SESSION['usr_compId'] . "' GROUP BY col_reason, col_start_date 
ORDER BY latestUserId ASC";
$result = $conn->query($sql_query);
?>
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

    /* Make the Note column fixed at 300px */
    table.table th.note-column,
    table.table td.note-column {
        width: 600px;
        max-width: 300px;
        word-wrap: break-word;
        /* ensures long text wraps */
        white-space: normal;
    }

    /* Optional: fix the table layout to respect column widths */
    table.table {
        table-layout: fixed;
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Status History<br>
                                <small>View all <?= $_SESSION['clientNames'] ?>'s status history</small>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-8">
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
                        <div class="dataTables">
                            <div class=" table-responsive">
                                <table class="table table-striped table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th style="width: 150px;">Reason</th>
                                            <th style="width: 100px;">Time</th>
                                            <th style="width: 100px;">Start Date</th>
                                            <th style="width: 100px;">Status</th>
                                            <th class="note-column">Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $startDate = date('d M, Y', strtotime($row['col_start_date']));
                                                $endDate = $row['col_end_date'];
                                        ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-inline-block align-middle">
                                                            <div class="d-inline-block">
                                                                <h6><?php echo $row["col_reason"]; ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row["col_time"]; ?></td>
                                                    <td><?php echo $startDate; ?></td>
                                                    <td><?php echo $endDate; ?></td>
                                                    <td class="note-column"><?php echo $row["col_note"]; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>0 results</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">

            </div>
        </div>
    </div>
</div>
<?php include('footer-contents.php'); ?>