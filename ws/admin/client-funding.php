<?php
include('client-header-contents.php');
include('client_funding_backend.php');
?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <h4>Funding<br><small><?= $varClientFirstName . ' ' . $varClientLastName ?> funding plan</small></h4>
        <hr>
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <h5>
                        <span style="background-color:rgba(189, 195, 199,.3); padding:6px; cursor:pointer; font-size:22px;" onclick="history.back();"><strong>&larr;</strong></span>
                        <span>Funding arrangements</span>
                    </h5>
                    <hr>

                    <!-- Success/Error Alerts -->
                    <?php if (!empty($successMsg)): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $successMsg ?>
                        </div>
                    <?php elseif (!empty($errorMsg)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errorMsg ?>
                        </div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-body" style="font-size: 16px;">
                            <p class="card-text" style="font-size: 16px;">
                                Current funding
                            </p>
                            <div style="width: 100%; height:auto; padding:15px; background-color:rgba(26, 188, 156,.9); color:#fff; font-weight:600; border-left: 30px solid rgba(22, 160, 133,1.0);">
                                <?php
                                $fundings = [];
                                if (!empty($la_funding)) $fundings[] = 'Local Authority';
                                if (!empty($private_funding)) $fundings[] = 'Private';
                                if (!empty($nhs_funding)) $fundings[] = 'NHS';
                                if (!empty($order_funding)) $fundings[] = 'Order';

                                echo !empty($fundings) ? implode(' | ', $fundings) : 'No funding selected';
                                ?>
                            </div>

                            <br>
                            <p class="card-text" style="font-size: 16px;">Please select one or more funding options:</p>

                            <form action="" method="POST" id="clientFundForm" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                <div class="list-group list-group-light">
                                    <div class="form-group">
                                        <input type="hidden" name="txtClientFullName" value="<?= $varClientFirstName . ' ' . $varClientLastName; ?>" />
                                        <input type="hidden" name="txtClientId" value="<?= $uryyToeSS4; ?>" />
                                        <input type="hidden" name="txtCompanyId" value="<?= $_SESSION['usr_compId']; ?>" />
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-xl-6">
                                            <li class="list-group-item">
                                                <input name="txtLAFunding" class="form-check-input" type="checkbox" value="Local Authority" id="checkboxExample1"
                                                    <?= !empty($la_funding) ? 'checked' : '' ?> />
                                                &nbsp; &nbsp;
                                                <label class="form-check-label" for="checkboxExample1">Local Authority</label>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <li class="list-group-item">
                                                <input name="txtPrivateFunding" class="form-check-input" type="checkbox" value="Private" id="checkboxExample2"
                                                    <?= !empty($private_funding) ? 'checked' : '' ?> />
                                                &nbsp; &nbsp;
                                                <label class="form-check-label" for="checkboxExample2">Private</label>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <li class="list-group-item">
                                                <input name="txtNHSFunding" class="form-check-input" type="checkbox" value="NHS" id="checkboxExample3"
                                                    <?= !empty($nhs_funding) ? 'checked' : '' ?> />
                                                &nbsp; &nbsp;
                                                <label class="form-check-label" for="checkboxExample3">NHS</label>
                                            </li>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <li class="list-group-item">
                                                <input name="txtOrderFunding" class="form-check-input" type="checkbox" value="Order" id="checkboxExample4"
                                                    <?= !empty($order_funding) ? 'checked' : '' ?> />
                                                &nbsp; &nbsp;
                                                <label class="form-check-label" for="checkboxExample4">Order</label>
                                            </li>
                                        </div>
                                    </div>
                                </div>

                                <br><br>
                                <div class="form-group">
                                    <h5>Local authority ID</h5>
                                    <input type="text" class="form-control" name="txtLocalAuthority" value="<?= $varLocalAuth; ?>" />
                                </div>

                                <button class="btn btn-info" name="btnSaveClientFunding" type="submit">Save funding</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer-contents.php'); ?>