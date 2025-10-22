<?php include('team-header-contents.php');
if (isset($_GET['userId'], $_GET['logs'])) {
    $userId = $_GET['userId'];
    $uryyTteamoeSS4 = $_GET['logs'];
    $stmt = $conn->prepare("SELECT * FROM tbl_team_status 
    WHERE userId = ? ORDER BY userId DESC LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $sel_team_data_row = $result->fetch_assoc();
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-5">
                <h5>Approve Availability<br> <small>Approve annual leave status.</small></h5>
            </div>
            <div class="col-md-8 col-xl-7">
                <div class="text-end">
                    <form action="./cancel-carer-abasence" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="txtUserId" value="<?= $userId ?>" />
                        <input type="hidden" name="txtTeamId" value="<?= $uryyTteamoeSS4 ?>" />
                        <button type="submit" class="btn btn-primary btn-sm block text-decoration-none">Cancel Absence</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-5 col-xl-5">
                <div class="card" style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
                    <div class="card-body" style="font-size: 16px;">
                        <div style="font-size:18px;"><span style="color:red;"><strong>Note:</strong></span> Your action is going to affect this carer availability status. Be sure you want to proceed with this action.</div>
                        <hr style="background-color: rgba(149, 165, 166,.7);">
                        <form action="./processing-approve-availability" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <input type="hidden" name="txtUserSpecialId" value="<?php echo htmlspecialchars($sel_team_data_row['uryyTteamoeSS4']); ?>" />
                            <input type="hidden" name="txtUserId" value="<?php echo htmlspecialchars($sel_team_data_row['userId']); ?>" />
                            <input type="hidden" name="txtStartDate" value="<?php echo htmlspecialchars($sel_team_data_row['col_startDate']); ?>" />
                            <input type="hidden" name="txtEndDate" value="<?php echo htmlspecialchars($sel_team_data_row['col_endDate']); ?>" />

                            <div class="form-group">
                                <label for="For reason">Select option</label>
                                <select style="height:50px;" name="txtTeamStatus" class="form-control" required id="">
                                    <option selected value="Approved">Approve</option>
                                    <option value="Dicline">Dicline</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="history.back();" class="btn btn-danger">Go back</button>
                                <button class="btn btn-primary" name="btnTeamStatus" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-7"></div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>