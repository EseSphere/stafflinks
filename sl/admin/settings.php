<?php
include('client-header-contents.php');
$sql_client_name = $conn->prepare("SELECT `client_first_name`, `geolocation`, `qrcode`, `client_last_name`, `col_qrcode_path` 
FROM `tbl_general_client_form` WHERE uryyToeSS4 = ? AND `col_company_Id` = ?");
$sql_client_name->bind_param('ss', $uryyToeSS4, $_SESSION['usr_compId']);
$sql_client_name->execute();
$sql_client_name->bind_result($varClientFirstName, $geolocation, $qrcode, $varClientLastName, $varQRcode);
if ($sql_client_name->fetch()) {
} else {
    echo "No client data found.";
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-9">
                <h4>Settings <br> <small><?php echo $varClientFirstName . ' ' . $varClientLastName ?> settings</small></h4>
            </div>
            <div class="col-md-3">
                <div>
                    <a style="text-decoration: none;" href="./generate-qrcode?uryyToeSS4=<?php echo $uryyToeSS4; ?>" class="btn btn-info" style="margin-top:-50px;">Generate</button></a>
                    <button onclick="printDiv('printableDiv')" class="btn btn-secondary">Print</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4 col-xl-5">
                <div class="w-100 h-auto p-4 bg-light rounded shadow-lg mt-3">
                    <form method="post" enctype="multipart/form-data" id="AGCForm" autocomplete="off" action="./geolocation-checkin"></form>
                    <form method="post" enctype="multipart/form-data" id="QRCForm" autocomplete="off" action="./qrcode-checkin"></form>
                    <input form="AGCForm" type="hidden" name="txtclientId" value="<?php echo $uryyToeSS4; ?>">
                    <input form="QRCForm" type="hidden" name="txtclientId" value="<?php echo $uryyToeSS4; ?>">
                    <h5>
                        Geo location check-in
                        <?php
                        $geoIsActive = ($geolocation === 'Active');
                        $buttonName = $geoIsActive ? 'btnActivateGeoLoc' : 'btnDisableGeoLoc';
                        $iconClass = $geoIsActive ? 'fas fa-times-circle' : 'fas fa-check-circle';
                        $iconColor = $geoIsActive ? 'red' : 'green';
                        $iconTitle = $geoIsActive ? 'Click to disable geolocation checkin' : 'Click to activate geolocation checkin';
                        echo "
                        <button form='AGCForm' style='background-color: inherit; border: none;' name='$buttonName' type='submit'>
                            <i title='$iconTitle' class='$iconClass' style='color: $iconColor; animation: pulse 1s infinite;'></i>
                        </button>
                        ";
                        ?>
                    </h5>
                    Verify the location of care workers at the time they check in for a visit.
                </div>
                <div class="w-100 h-auto p-4 bg-light rounded shadow-lg mt-3">
                    <h5>
                        QR code check-in
                        <?php
                        $isActive = ($qrcode === 'Active');
                        $buttonName = $isActive ? 'btnActivateQRCode' : 'btnDisableQRCode';
                        $iconClass = $isActive ? 'fas fa-times-circle' : 'fas fa-check-circle';
                        $iconColor = $isActive ? 'red' : 'green';
                        $iconTitle = $isActive ? 'Click to disable qrcode checkin' : 'Click to activate qrcode checkin';
                        echo "
                        <button form='QRCForm' style='background-color: inherit; border: none;' name='$buttonName' type='submit'>
                            <i title='$iconTitle' class='$iconClass' style='color: $iconColor; animation: pulse 1s infinite;'></i>
                        </button>
                        ";
                        ?>
                    </h5>
                    The carer scans a QR code in the client’s home to confirm their location. Disable the feature after generating a new code until it’s placed in the home.
                </div>
            </div>
            <div class="col-md-4 col-xl-7">
                <div class="form-cover" id="printableDiv" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <h1><strong>StaffLinks</strong></h1>
                    <br><br>
                    <h3><i class="fas fa-qrcode"></i> Check in with your QR code</h3>
                    <br>
                    <hr>
                    <br><br>
                    <div style="width: 100%; height:auto; padding:22px; text-align:center;">
                        <h1 style="font-size: 55px;"><strong><?php echo $varClientFirstName . ' ' . $varClientLastName ?></strong></h1>
                        <h2>Scan QR Code</h2>
                        <br><br>
                        <img src="./qrcodes/<?php print $varQRcode; ?>" style="width: 450px; height:450px;" alt="">
                        <div style="margin-top: 150px; width:100%;line-height: 2.0;">
                            <h2><strong>How to scan a QR code</strong></h2>
                            <h3>When the QR code scanner is open in the app, point your camera at the QR code. When the app recognizes the QR code the app will automatically scan the code and check you in.</h3>
                        </div>
                    </div>
                </div>
            </div>
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