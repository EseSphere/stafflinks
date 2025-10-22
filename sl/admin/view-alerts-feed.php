<?php
include_once('feeds-header.php');
$myIduser = $_GET['userId'];
$stmt = $conn->prepare("SELECT * FROM tbl_schedule_calls 
WHERE userId = ? AND col_company_Id = ? ORDER BY userId DESC LIMIT 1
");

$stmt->bind_param("ss", $myIduser, $_SESSION['usr_compId']);
$stmt->execute();

$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $varShiftDate        = $row['Clientshift_Date'];
    $varClientSpecialId  = $row['uryyToeSS4'];
    $varClientCareCall   = $row['care_calls'];
    $varClientName       = $row['client_name'];
    $varDateTimeIn       = $row['dateTime_in'];
    $varDateTimeOut      = $row['dateTime_out'];
    $_SESSION['clientName']       = $varClientName;
    $_SESSION['CareCall']         = $varClientCareCall;
    $_SESSION['userid']           = $myIduser;
    $_SESSION['Clientshift_Date'] = $varShiftDate;
    $_SESSION['uryyToeSS4']       = $varClientSpecialId;
    $myEncryptedId = hash('sha256', $myIduser);
    $clientVisitDate = date('d M, Y', strtotime($varShiftDate));
} else {
    $clientVisitDate = null;
}
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div style="width: 100%; height:auto;" id="printableArea">
            <div class="row">
                <div style="width:100%; height:auto; padding:22px; justify-content:right; display:flex;">
                    <a href="./cancel-client-care-call?userId=<?php echo "" . $myIduser . "" ?>" class="btn btn-info">Cancel visit</a>
                    &nbsp;
                    <a href="./change-visit-settings?userId=<?php echo "" . $myIduser . "" ?>" class="btn btn-secondary">Re-adjust time</a>
                </div>
                <hr>
                <div class="col-xl-4">
                    <div class='card table-card'>
                        <div class='card-header'>
                            <h4 style="float: right;"><i class='feather mr-2 icon-log-in'></i></h4>
                            <br>
                            <p style="font-size: 22px;">
                            <div style="font-weight:600; font-size:20px;">Date</div>
                            <span style="font-size: 17px; font-weight:600;"><?php echo "" . $clientVisitDate . "" ?></span>
                            </p>
                            <hr>
                            <p style="font-size: 22px;">
                            <div style="font-weight:600; font-size:20px;">Name</div>
                            <span style="font-size: 17px; font-weight:600;"><?php echo "" . $varClientName . "" ?></span>
                            </p>
                            <hr>
                            <div style="font-weight:600; font-size:20px;">Planned time</div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 style=" font-weight:600;">Time in</h5>
                                    <br>
                                    <span style="font-size: 17px; font-weight:600;"><?php echo $varDateTimeIn ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <h5 style=" font-weight:600;">Time out</h5>
                                    <br>
                                    <span style="font-size: 17px; font-weight:600;"><?php echo $varDateTimeOut ?></span>
                                </div>
                            </div>
                            <hr>
                            <div style="font-weight:600; font-size:20px;">Status</div>
                            <span style="font-size: 17px; font-weight:600;">Completed</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class='card table-card'>
                        <div class='card-header'>
                            <?php
                            $stmt1 = $conn->prepare("SELECT * FROM tbl_daily_shift_records 
                            WHERE uryyToeSS4 = ? AND shift_date = ? AND col_care_call = ? AND col_company_Id = ?
                            ORDER BY userId DESC LIMIT 1");
                            $stmt1->bind_param(
                                "ssss",
                                $varClientSpecialId,
                                $varShiftDate,
                                $varClientCareCall,
                                $_SESSION['usr_compId']
                            );
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            if ($row1 = $result1->fetch_assoc()) {
                                $get_firstCarerid = $row1['col_carer_Id'];
                            ?>
                                <h4 style="float: right;"><i class='feather mr-2 icon-user'></i></h4>
                                <div style="font-weight:600; font-size:20px;">Carer 1<br>
                                    <small style="font-weight:600;"><?= htmlspecialchars($row1['carer_Name']) ?></small>
                                </div>
                                <hr>
                                <div style="padding: 12px;" class="row">
                                    <div style="font-weight:600; font-size:20px;">Actual time</div>
                                    <div class="col-sm-6">
                                        <div style="font-weight:600; font-size:18px;">Time in</div>
                                        <span style="font-size: 17px; font-weight:600;"><?= htmlspecialchars($row1['shift_start_time']) ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div style="font-weight:600; font-size:18px;">Time out</div>
                                        <span style="font-size: 17px; font-weight:600;"><?= htmlspecialchars($row1['shift_end_time']) ?></span>
                                    </div>
                                </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4">
                    <div class='card table-card'>
                        <div class='card-header'>
                            <?php
                            $stmt2 = $conn->prepare("SELECT * FROM tbl_daily_shift_records WHERE col_carer_Id != ? 
                            AND col_care_call = ? AND shift_date = ? AND uryyToeSS4 = ? AND col_company_Id = ?");
                            $stmt2->bind_param(
                                "sssss",
                                $get_firstCarerid,
                                $varClientCareCall,
                                $varShiftDate,
                                $varClientSpecialId,
                                $_SESSION['usr_compId']
                            );
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();
                            while ($row2 = $result2->fetch_assoc()) {
                            ?>
                                <h4 style="float: right;"><i class='feather mr-2 icon-log-in'></i></h4>
                                <div style="font-weight:600; font-size:20px;">Carer 2<br>
                                    <small style="font-weight:600;"><?= htmlspecialchars($row2['carer_Name']) ?></small>
                                </div>
                                <hr>
                                <div style="padding: 12px;" class="row">
                                    <div style="font-weight:600; font-size:20px;">Actual time</div>
                                    <div class="col-sm-6">
                                        <div style="font-weight:600; font-size:18px;">Time in</div>
                                        <span style="font-size: 17px; font-weight:600;"><?= htmlspecialchars($row2['shift_start_time']) ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div style="font-weight:600; font-size:18px;">Time out</div>
                                        <span style="font-size: 17px; font-weight:600;"><?= htmlspecialchars($row2['shift_end_time']) ?></span>
                                    </div>
                                </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>


                <div class="m-1 w-100 h-100 p-3 font-semibold">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class='card table-card'>
                                <div class='card-header'>
                                    <h5 style="font-weight:600;">Medications</h5>
                                </div>
                                <?php
                                $stmt3 = $conn->prepare("SELECT * FROM tbl_finished_meds 
                                WHERE med_date = ? AND uryyToeSS4 = ? AND care_calls = ? AND col_company_Id = ?");
                                $stmt3->bind_param(
                                    "ssss",
                                    $varShiftDate,
                                    $varClientSpecialId,
                                    $varClientCareCall,
                                    $_SESSION['usr_compId']
                                );
                                $stmt3->execute();
                                $result3 = $stmt3->get_result();
                                while ($row3 = $result3->fetch_assoc()) {
                                    echo "
                                    <div style='padding: 5px 5px 0px 10px; width:100%; height:auto;'>
                                        <span class='font-bold'>" . htmlspecialchars($row3['task_name']) . "</span><br>
                                        <span style='color:rgba(127, 140, 141,1.0);'>" . htmlspecialchars($row3['task_note']) . "</span><br>
                                        <span style='float: right; font-size:14px; color:rgba(39, 174, 96,1.0);'>
                                            <i class='feather mr-2 icon-clock'></i> " . htmlspecialchars($row3['task_timeIn']) . "
                                        </span><br><hr>
                                    </div>";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class='card table-card'>
                                <div class='card-header'>
                                    <h5 style="font-weight:600;">Task</h5>
                                </div>
                                <?php
                                $stmt4 = $conn->prepare("SELECT * FROM tbl_finished_tasks 
                                WHERE task_date = ? AND care_calls = ? AND uryyToeSS4 = ? AND col_company_Id = ?");
                                $stmt4->bind_param(
                                    "ssss",
                                    $varShiftDate,
                                    $varClientCareCall,
                                    $varClientSpecialId,
                                    $_SESSION['usr_compId']
                                );
                                $stmt4->execute();
                                $result4 = $stmt4->get_result();
                                while ($row4 = $result4->fetch_assoc()) {
                                    echo "
                                <div style='padding: 5px 5px 0px 10px; width:100%; height:auto;'>
                                    <span>" . htmlspecialchars($row4['task_name']) . "</span><br>
                                    <span style='color:rgba(127, 140, 141,1.0);'>" . htmlspecialchars($row4['task_note']) . "</span><br>
                                    <span style='float: right; font-size:14px; color:rgba(39, 174, 96,1.0);'>
                                        <i class='feather mr-2 icon-clock'></i> " . htmlspecialchars($row4['task_timeIn']) . "
                                    </span><br><hr>
                                </div>";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class='card table-card'>
                                <div class='card-header'>
                                    <h5 style="font-weight:600;">Observations</h5>
                                </div>
                                <div class='card-body'>
                                    <div style="padding: 12px; width:100%; height:auto;">
                                        <?php
                                        $stmt5 = $conn->prepare("SELECT task_note FROM tbl_daily_shift_records 
                                        WHERE shift_date = ? AND col_care_call = ? AND uryyToeSS4 = ? AND col_company_Id = ? 
                                        ORDER BY userId DESC LIMIT 1");
                                        $stmt5->bind_param(
                                            "ssss",
                                            $varShiftDate,
                                            $varClientCareCall,
                                            $varClientSpecialId,
                                            $_SESSION['usr_compId']
                                        );
                                        $stmt5->execute();
                                        $stmt5->bind_result($task_note);
                                        $stmt5->fetch();
                                        echo htmlspecialchars($task_note);
                                        $stmt5->close();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="button" class="btn btn-secondary btn-large" style="width: 150px;" onclick="printDiv('printableArea')" value="Download file" />
            </div>
        </div>
    </div>
</div>
</div>






<?php include('footer-contents.php'); ?>