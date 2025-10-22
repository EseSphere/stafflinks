<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Share Family Access</h5>
                <hr>
                <div class="card">
                    <h5 class="card-header">Send to recipient</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <form action="./processing-share-access" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="form-group">
                                <input type="email" name="txtRecipient_Email" placeholder="Recipient email" class="form-control" required />
                            </div>
                            <input type="hidden" name="txtInviteeEmail" value="geosoftcare@geosoftcare.co.uk">
                            <div class="form-group">
                                <textarea name="txtShareCode" style="resize: none;" id="" cols="" rows="4" class="form-control" required>Hello. I hope this message finds you well. Please find the share access link attached. This link has been provided to allow you view he/her care details. It ensures you have up-to-date and transparent information regarding their care plan and progress. If you have any questions or need assistance accessing the link, feel free to reach out.</textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="txtShareUrl" value="https://care-access.geosoftcare.co.uk/client-visits?uryyToeSS4=<?= $uryyToeSS4; ?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="txtCompanySpecialId" value="<?= $uryyToeSS4; ?>">
                            </div>
                            <button class="btn btn-primary btn-lg" name="btnshareAccessCode" type="submit">Send access</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>