<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
    $sql_client_name = mysqli_query($conn, "SELECT `client_first_name`,`client_last_name`,`col_qrcode_path` FROM `tbl_general_client_form` 
    WHERE (uryyToeSS4 = '$uryyToeSS4' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
    $row_client_name = mysqli_fetch_array($sql_client_name, MYSQLI_ASSOC);
    $varClientFirstName = $row_client_name['client_first_name'];
    $varClientLastName = $row_client_name['client_last_name'];
    $varQRcode = $row_client_name['col_qrcode_path'];
}
?>


<div class="pcoded-main-container">
    <div class="pcoded-content">
        <h4>QR Code
            <br>
            <small><?php echo $varClientFirstName . ' ' . $varClientLastName ?> QR code</small>
        </h4>
        <div style="float: right;">
            <a style="text-decoration: none;" href="./generate-qrcode?uryyToeSS4=<?php echo $uryyToeSS4; ?>">
                <button class="btn btn-sm btn-info" style="margin-top:-50px;">Generate</button>
            </a>
            <button onclick="printDiv('printableDiv')" class="btn btn-sm btn-secondary" style="margin-top:-50px;">Print</button>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <div class="form-cover" id="printableDiv" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <h1><strong>Geosoft</strong></h1>
                    <br><br>
                    <h3>
                        <i class="fas fa-qrcode"></i> Check in with your QR code
                    </h3>
                    <br>
                    <hr>
                    <br><br>
                    <div style="width: 100%; height:auto; padding:22px; text-align:center;">
                        <h1 style="font-size: 55px;">
                            <strong>
                                <?php echo $varClientFirstName . ' ' . $varClientLastName ?>
                            </strong>
                        </h1>
                        <h2>Scan QR Code</h2>
                        <br><br>
                        <img src="./qrcodes/<?php print $varQRcode; ?>" style="width: 450px; height:450px;" alt="">
                        <div style="margin-top: 150px; width:100%;line-height: 2.0;">
                            <h2><strong>How to scan a QR code</strong></h2>
                            <h3>
                                When the QR code scanner is open in the app, point your camera at the QR code. When the app recognizes the QR code the app will automatically scan the code and check you in.
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
    </div>
</div>

<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

<?php include('footer-contents.php'); ?>