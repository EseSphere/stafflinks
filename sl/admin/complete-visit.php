<?php
include('client-header-contents.php');
if (isset($_GET['userId'], $_GET['uryyToeSS4'], $_GET['name'], $_GET['date'], $_GET['visit'])) {
    $userId = $_GET['userId'];
    $client_Spec_Id = $_GET['uryyToeSS4'];
    $clientName     = $_GET['name'];
    $visit          = $_GET['visit'];
    $shiftDate      = $_GET['date'];
}

$sql = "SELECT * FROM tbl_schedule_calls WHERE userId = '$userId' AND uryyToeSS4 = '$client_Spec_Id' 
AND Clientshift_Date = '$shiftDate' AND care_calls = '$visit' ORDER BY userId DESC";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$timeIn  = new DateTime($row['dateTime_in']);
$timeOut = new DateTime($row['dateTime_out']);

$interval = $timeIn->diff($timeOut);

$sql2 = "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = '$client_Spec_Id' ORDER BY userId DESC";
$result = $conn->query($sql2);
$row2 = $result->fetch_assoc();
?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-4">
                <h5><strong>Complete visit</strong></h5>
                <p class="fs-6">Complete <?php echo $clientName . ', ' . $visit ?> visit</p>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" href="./restore-visit?uryyToeSS4=<?= $client_Spec_Id ?>&name=<?= $clientName ?>&date=<?= $shiftDate ?>&visit=<?= $visit ?>" class="btn btn-primary text-white text-decoration-none">
                            Restore
                        </a>
                        <a type="button" href="./remove-visit?uryyToeSS4=<?= $client_Spec_Id ?>&name=<?= $clientName ?>&date=<?= $shiftDate ?>&visit=<?= $visit ?>" class="btn btn-danger text-white text-decoration-none">
                            Remove
                        </a>
                        <a type="button" href="./complete-visit?uryyToeSS4=<?= $client_Spec_Id ?>&name=<?= $clientName ?>&date=<?= $shiftDate ?>&visit=<?= $visit ?>" class="btn btn-info text-white text-decoration-none">
                            Complete
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-md-5 col-xl-5">
                <div class="alert alert alert-info" style="font-size: 17px; font-weight: 600;">
                    Kindly use the form below to complete <?php echo $clientName . ', ' . $visit ?> visit?
                </div>
                <p class="card-text" style="font-size: 16px;"></p>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <form action="./processing-complete-visits" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="row">
                                <input name="txtDateOfVisit" value="<?php echo $shiftDate; ?>" class="form-control" hidden />
                                <input name="txtTimeIn" value="<?php echo $row['dateTime_in']; ?>" class="form-control" hidden />
                                <input name="txtTimeOut" value="<?php echo $row['dateTime_out']; ?>" class="form-control" hidden />
                                <input name="txtClientName" value="<?php echo "" . $clientName . "" ?>" class="form-control" hidden />
                                <input name="txtClientId" value="<?php echo "" . $client_Spec_Id . "" ?>" class="form-control" hidden />
                                <input name="txtClientCareCall" value="<?php echo "" . $visit . "" ?>" class="form-control" hidden />
                                <input name="txtClientArea" value="<?php echo $row['client_area']; ?>" class="form-control" hidden />
                                <input name="txtCarerName" value="<?php echo $row['first_carer']; ?>" class="form-control" hidden />
                                <input type="hidden" name="clientSpecialId" value="<?php echo "" . $userId . ""; ?>" />
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="For date">Enter pay rate <?php echo $interval->format("%Hh %im"); ?><span style="font-size:16px; color:red;">*</span></label>
                                        <input name="txtPayRate" required class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="For date">General observation<span style="font-size:16px; color:red;">*</span></label>
                                        <textarea name="txtGeneralObservation" required class="form-control" rows="5" placeholder="General observation" id=""></textarea>
                                    </div>
                                </div>
                                <input name="txtCarerId" value="<?php echo $row['first_carer_Id']; ?>" class="form-control" hidden />
                                <input name="txtTimesheetDate" value="<?php echo $row['Clientshift_Date']; ?>" class="form-control" hidden />
                                <input name="txtAreaId" value="<?php echo $row['col_area_Id']; ?>" class="form-control" hidden />
                                <input name="txtCompanyId" value="<?php echo $row['col_company_Id']; ?>" class="form-control" hidden />
                                <input name="txtCompleted" value="Completed" class="form-control" hidden />
                                <input name="txtTrue" value="True" class="form-control" hidden />
                                <input name="txtUnconfirmed" value="Unconfirmed" class="form-control" hidden />
                                <input name="txtUserId" value="<?php echo $row['userId']; ?>" class="form-control" hidden />
                                <input name="txtPostalCode" value="<?php echo $row2['client_poster_code']; ?>" class="form-control" hidden />
                            </div>
                            <button onclick="history.back();" type="button" class="btn btn-danger">Go back</button>
                            <button class="btn btn-info" name="btnCompleteVisit" type="submit">Complete call</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-7">
                <div class="container">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-info text-white d-flex align-items-center">
                            <i class="bi bi-calendar-check me-2"></i> <!-- Bootstrap Icons -->
                            <h5 class="mb-0 text-white">Manage Client Visits</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-4">
                                Use the options below to manage client visits for the selected date. Each action affects the client’s schedule, staff assignments, and related records. Please review carefully before performing any action.
                            </p>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="card h-100 border-warning">
                                        <div class="card-body text-center">
                                            <i class="bi bi-x-circle-fill text-warning fs-2 mb-2"></i>
                                            <h6 class="card-title">Complete Visit</h6>
                                            <p class="card-text small">
                                                Complete a scheduled visit. Uncompleted visits can be completed and updated in this page.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card h-100 border-success">
                                        <div class="card-body text-center">
                                            <i class="bi bi-arrow-counterclockwise text-success fs-2 mb-2"></i>
                                            <h6 class="card-title">Restore Visit</h6>
                                            <p class="card-text small">
                                                Reinstate a previously cancelled visit to its original schedule. Use this if the client becomes available again.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card h-100 border-danger">
                                        <div class="card-body text-center">
                                            <i class="bi bi-trash-fill text-danger fs-2 mb-2"></i>
                                            <h6 class="card-title">Remove Visit</h6>
                                            <p class="card-text small">
                                                Permanently delete a visit. This action cannot be undone, and all associated notes or records will be lost.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info" role="alert">
                                <h6 class="alert-heading">Important Guidelines:</h6>
                                <ul class="mb-0">
                                    <li>Always verify the selected date and client before performing any action.</li>
                                    <li>Cancelled visits can be restored; removed visits cannot.</li>
                                    <li>Changes are applied immediately and may impact staff schedules, reporting, and notifications.</li>
                                    <li>Use the buttons above to perform the corresponding action for the selected client visit.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>