<div style="width:400px; max-height:600px;">
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
            <h5>Recently added</h5>
        </div>
        <div style="z-index: 1000; background-color:#fff;" class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Care calls</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "
                        SELECT r.* FROM tbl_manage_runs r WHERE r.run_area_nameId = ? AND r.col_company_Id = ? 
                        AND NOT EXISTS (SELECT 1 FROM tbl_client_status_records s WHERE s.col_client_Id = r.uryyToeSS4 
                        AND s.col_end_date = 'TFN' AND s.col_company_Id = r.col_company_Id) ORDER BY r.userId ASC
                        ";

                        $stmt = $conn->prepare($sql);
                        if (!$stmt) {
                            die('SQL error: ' . $conn->error);
                        }

                        $stmt->bind_param("ss", $_SESSION['run_Id'], $_SESSION['usr_compId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($trans = $result->fetch_array()) {
                            echo "
                                                        <tr>
                                                            <td>
                                                                <div class='d-inline-block'>
                                                                    <h6>" . $trans['client_name'] . "</h6>
                                                                </div>
                                                            </td>
                                                            <td>" . $trans['care_calls'] . "</td>
                                                            <td>
                                                                <form action='./processing-delete-client-from-run' method='post'>
                                                                    <input type='hidden' name='txtUserId' value='" . $trans['userId'] . "'>
                                                                    <input type='hidden' name='txtClientSpecialId' value='" . $trans['uryyToeSS4'] . "'>
                                                                    <input type='hidden' name='txtcare_calls' value='" . $trans['care_calls'] . "'>
                                                                    <input type='hidden' name='txtRunSpecialId' value='" . $trans['run_area_nameId'] . "'>
                                                                    <button style='width:25px; height:25px; padding:0;' type='submit' name='btnDeleteClientList' class='btn btn-danger btn-sm'>
                                                                        <i class='feather icon-x'></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>