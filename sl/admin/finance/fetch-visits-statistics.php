<div class="row">
    <div class="col-xl-4 col-md-4">
        <div class="card flat-card widget-primary-card">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="feather icon-credit-card"></i>
                </div>
                <div class="col-sm-9">
                    <h4>
                        <?php
                        $sql = "SELECT SUM(`col_carecall_rate`) AS total_payment FROM `tbl_daily_shift_records` 
                        WHERE ((`timesheet_date` >= ? AND `timesheet_date` <= ?) AND (col_carer_Id = ? OR shift_status = ?) 
                        AND col_call_status = ? AND col_company_Id = ?)";
                        $stmt = $conn->prepare($sql);
                        if ($stmt === false) {
                            die('Prepare failed: ' . $conn->error);
                        }
                        $stmt->bind_param("ssssss", $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $varCareCallStatus, $txtCompanyId);
                        $stmt->execute();
                        $stmt->bind_result($total_payment);
                        $stmt->fetch();
                        $total_payment = number_format((float)$total_payment, 2, '.', '');

                        $stmt->close();
                        echo '£' . $total_payment;
                        ?>
                        <br>
                        <small style="font-size:16px; font-weight:600;"> Balance </small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card flat-card widget-purple-card">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="col-sm-9">
                    <h4>
                        <?php
                        $query = "
                        SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`planned_timeOut`, `planned_timeIn`)))) AS total_worked_hours 
                        FROM `tbl_daily_shift_records` WHERE ((`planned_timeOut` IS NOT NULL AND `planned_timeIn` IS NOT NULL) 
                        AND (`timesheet_date` BETWEEN ? AND ?) AND (col_carer_Id = ? OR shift_status = ?)AND col_call_status = ? 
                        AND col_company_Id = ?)";
                        $stmt = $conn->prepare($query);
                        if (!$stmt) {
                            die("Prepare failed: " . $conn->error);
                        }
                        $stmt->bind_param("ssssss", $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $varCareCallStatus, $txtCompanyId);
                        if (!$stmt->execute()) {
                            die("Execute failed: " . $stmt->error);
                        }
                        $result = $stmt->get_result();
                        $row_total_hour = $result->fetch_assoc();
                        $total_hours = $row_total_hour['total_worked_hours'] ?? '00:00:00';
                        $result->free();
                        $stmt->close();
                        if (!empty($total_hours) && strpos($total_hours, ':') !== false) {
                            $parts = explode(':', $total_hours);
                            $hours = isset($parts[0]) ? (int)$parts[0] : 0;
                            $minutes = isset($parts[1]) ? (int)$parts[1] : 0;
                            $seconds = isset($parts[2]) ? (int)$parts[2] : 0;

                            $total_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                            $hours = floor($total_seconds / 3600);
                            $minutes = floor(($total_seconds % 3600) / 60);
                            $seconds = $total_seconds % 60;
                            $formatted_time = sprintf('%02d:%02d', $hours, $minutes);
                        } else {
                            $formatted_time = '00:00';
                        }
                        echo $formatted_time;
                        ?>
                        <br>
                        <small style="font-size:16px; font-weight:600;">Hour</small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div style="background-color:rgba(52, 152, 219,1.0); color:#fff;" class="card flat-card widget-blue-card">
            <div class="row-table">
                <div style="background-color:rgba(41, 128, 185,1.0); color:#fff;" class="col-sm-3 card-body">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
                <div class="col-sm-9">
                    <h4>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM tbl_daily_shift_records WHERE ((shift_date >= ? AND shift_date <= ?) 
                        AND (col_carer_Id = ? OR shift_status = ?) AND col_company_id = ?)");
                        $stmt->bind_param("sssss", $txtStartDate, $txtEndDate, $txtCareGiver, $txtCareGiver, $_SESSION['usr_compId']);
                        $stmt->execute();
                        $result_get_total_visits = $stmt->get_result();
                        $rowcount = $result_get_total_visits->num_rows;
                        printf($rowcount);
                        $stmt->close();
                        ?>
                        <br>
                        <small style="font-size:16px; font-weight:600;"> Visit </small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>