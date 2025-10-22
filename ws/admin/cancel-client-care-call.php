<?php
include('client-header-contents.php');
if (isset($_GET['userId'], $_GET['spec'], $_GET['name'], $_GET['date'], $_GET['visit'])) {
    $userId         = $_GET['userId'];
    $client_Spec_Id = $_GET['spec'];
    $clientName     = $_GET['name'];
    $visit          = $_GET['visit'];
    $shiftDate      = $_GET['date'];
}
?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-4">
                <h5><strong>Cancel visit</strong></h5>
                <p class="fs-6">Cancel <?php echo $clientName . ', ' . $visit ?> visit</p>
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
                        <a type="button" href="./complete-visit?userId=<?= $userId ?>&uryyToeSS4=<?= $client_Spec_Id ?>&name=<?= $clientName ?>&date=<?= $shiftDate ?>&visit=<?= $visit ?>" class="btn btn-info text-white text-decoration-none">
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
                <div class="alert alert alert-danger" style="font-size: 17px; font-weight: 600;">
                    Are you sure you want to cancel <?php echo $clientName . ', ' . $visit ?> visit?
                    <br>
                    Please note: By taking this action will remove this visit from the carer run and won't be able to attent to it.
                </div>
                <p class="card-text" style="font-size: 16px;"></p>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <form action="./processing-client-cancel-visit" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="row">
                                <input name="txtClientName" value="<?php echo "" . $clientName . "" ?>" class="form-control" hidden />
                                <input name="txtClientCareCall" value="<?php echo "" . $visit . "" ?>" class="form-control" hidden />
                                <input name="txtClientId" value="<?php echo "" . $client_Spec_Id . "" ?>" class="form-control" hidden />
                                <input type="hidden" name="clientSpecialId" value="<?php echo "" . $userId . ""; ?>" />
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="For date">Cancellation date<span style="font-size:16px; color:red;">*</span></label>
                                        <input type="date" class="form-control" value="<?php echo $shiftDate; ?>" required name="txtDateOfVisit" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="For time">Cancellation time<span style="font-size:16px; color:red;">*</span></label>
                                        <input type="time" class="form-control" value="<?php echo $today; ?>" required name="txtTimeOfVisit" />
                                    </div>
                                </div>
                                <div class="col-md-5 col-5">
                                    <div class="form-group">
                                        <label for="For cancellation by">Cancellation by<span style="font-size:16px; color:red;">*</span></label>
                                        <select style="height: 50px;" name="txtCancellationby" class="form-control" required id="">
                                            <option value="Client">Client</option>
                                            <option value="Care manager">Care manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7 col-7">
                                    <div class="form-group">
                                        <label for="For reason">Reason<span style="font-size:16px; color:red;">*</span></label>
                                        <select style="height: 50px;" name="txtClientReason" class="form-control" required id="">
                                            <option value="--Select options--">--Select options--</option>
                                            <option value="Active">Active</option>
                                            <option value="Hospitalized">Hospitalized</option>
                                            <option value="On a trip">On a trip</option>
                                            <option value="With family">With family</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="For date">Pay carer<span style="font-size:16px; color:red;">*</span></label>
                                        <br>
                                        <input type="checkbox" name="txtPayCarer" value="Pay carer" id="txtPayCarer" />
                                        &nbsp;
                                        <span>Pay carer</span>
                                        <br>
                                        <input type="checkbox" name="txtDontPayCarer" value="Don't pay carer" id="txtPayCarer" />
                                        &nbsp;
                                        <span>Don't pay carer</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="For date">Invoice<span style="font-size:16px; color:red;">*</span></label>
                                        <br>
                                        <input type="checkbox" name="txtInvoice" value="Invoice" id="txtPayCarer" />
                                        &nbsp;
                                        <span>Invoice payer</span>
                                        <br>
                                        <input type="checkbox" name="txtDontInvoice" value="Dont Invoice" id="txtPayCarer" />
                                        &nbsp;
                                        <span>Don't invoice payer</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="For reason">Note</label>
                                        <textarea name="txtcancelNote" class="form-control" required rows="5" placeholder="Kindly state reasons!" id=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <button onclick="history.back();" type="button" class="btn btn-danger">Go back</button>
                            <button class="btn btn-info" name="btnCancelCareCall" type="submit">Cancel call</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-7">
                <div class="container mt-5">
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
                                            <h6 class="card-title">Cancel Visit</h6>
                                            <p class="card-text small">
                                                Temporarily cancel a scheduled visit. Cancelled visits are not deleted and can be restored later if needed.
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