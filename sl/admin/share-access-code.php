<?php
include('header-contents.php');
if (isset($_GET['col_company_Id'])) {
    $col_company_Id = $_GET['col_company_Id'];
    $stmt = $conn->prepare("SELECT * FROM tbl_goesoft_users 
    WHERE col_company_Id = ? ORDER BY userId DESC LIMIT 1");
    $stmt->bind_param("s", $col_company_Id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Share Access Code</h5>
                <hr>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div style="text-align:right;" class="col-md-4">
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">Send to recipient</h5>
                    <div class="card-body" style="font-size: 16px;">
                        <form action="./processing-company-share-code" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="form-group">
                                <input type="email" name="txtRecipient_Email" placeholder="Recipient email" class="form-control" required />
                            </div>
                            <input type="hidden" name="txtInviteeEmail" value="<?php echo "" . $row['user_email_address'] . ""; ?>">
                            <div class="form-group">
                                <textarea name="txtShareCode" id="" cols="" rows="6" class="form-control" required>You have been provided with an access code that allows you to create an account, log in, and manage activities within the dashboard. By using this access code, you agree to our terms and conditions. Please click the link below to create your account. For security reasons, do not share this link with anyone.</textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="txtShareUrl" value="https://admin.geosoftcare.co.uk/54655-476564-99iu955-4h4657/share-access-signup?col_company_Id=<?php echo "" . $row['col_company_Id'] . ""; ?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="txtCompanySpecialId" value="<?php echo "" . $row['col_company_Id'] . ""; ?>">
                            </div>
                            <button class="btn btn-primary" name="btnshareAccessCode" type="submit">Send Code</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>