<?php
include('header-contents.php');
$result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_users 
WHERE (col_qrcode != '' AND col_company_Id='" . $_SESSION['usr_compId'] . "') 
ORDER BY userId DESC LIMIT 1");
$row = mysqli_fetch_array($result);
$varCompanyName = $row['company_name'];
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h4>Check In QR Code
                    <button onclick="printDiv('printableArea')" class="btn btn-sm btn-outline-secondary">Print</button>
                </h4>
                <br><br>
                <div style="justify-content: center; display:flex; text-align:center;" id="printableArea" class="card">
                    <div class="card-body text-center">
                        <h3 class="card-header">Scan to check in & out</h3>
                        <br><br>
                        <h1><strong><?php print $varCompanyName; ?></strong></h1>
                        <p style="font-size: 18px;">This QR Code is for check in and check out purpose only</p>
                        <p style="font-size: 18px;">Please do not remove, ensure it kept properly and safe after use and do not take it out of the house.</p>
                        <hr>
                        <br><br>
                        <img src="https://esesphere.online/geosoft/xiehtuI4UIR8rnnak8IyuIE84HKacce848ss8s/qrcodes/<?php print $row['col_qrcode']; ?>" alt="qrcode" width="300" height="300">
                        <br><br><br><br>
                        <p style="font-size: 18px;">For further information do not hesistate to give us a call or send us an email via our company email and phone number.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
    </div>
</div>

<script>
    function printDiv(divId) {
        var divToPrint = document.getElementById(divId);
        var newWindow = window.open('', '', 'width=800,height=600');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('</head><body style="justify-content: center; display:flex; text-align:center;">');
        newWindow.document.write(divToPrint.innerHTML);
        newWindow.document.write('</body></html>');
        newWindow.document.close();
        newWindow.focus();
        newWindow.print();
        newWindow.close();
    }
</script>
<?php include('footer-contents.php'); ?>