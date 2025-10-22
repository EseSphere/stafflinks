<?php include('header-contents.php'); ?>
<style>
    body {
        color: #2e323c;
        background: #f5f6fa;
        position: relative;
        height: 100%;
    }

    .invoice-container {
        padding: 1rem;
    }

    .invoice-container .invoice-header .invoice-logo {
        margin: 0.8rem 0 0 0;
        display: inline-block;
        font-size: 1.6rem;
        font-weight: 700;
        color: #2e323c;
    }

    .invoice-container .invoice-header .invoice-logo img {
        max-width: 130px;
    }

    .invoice-container .invoice-header address {
        font-size: 0.8rem;
        color: #9fa8b9;
        margin: 0;
    }

    .invoice-container .invoice-details {
        margin: 1rem 0 0 0;
        padding: 1rem;
        line-height: 180%;
        background: #f5f6fa;
    }

    .invoice-container .invoice-details .invoice-num {
        text-align: right;
        font-size: 0.8rem;
    }

    .invoice-container .invoice-body {
        padding: 1rem 0 0 0;
    }

    .invoice-container .invoice-footer {
        text-align: center;
        font-size: 0.7rem;
        margin: 5px 0 0 0;
    }

    .invoice-status {
        text-align: center;
        padding: 1rem;
        background: #ffffff;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    .invoice-status h2.status {
        margin: 0 0 0.8rem 0;
    }

    .invoice-status h5.status-title {
        margin: 0 0 0.8rem 0;
        color: #9fa8b9;
    }

    .invoice-status p.status-type {
        margin: 0.5rem 0 0 0;
        padding: 0;
        line-height: 150%;
    }

    .invoice-status i {
        font-size: 1.5rem;
        margin: 0 0 1rem 0;
        display: inline-block;
        padding: 1rem;
        background: #f5f6fa;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
    }

    .invoice-status .badge {
        text-transform: uppercase;
    }

    @media (max-width: 767px) {
        .invoice-container {
            padding: 1rem;
        }
    }


    .custom-table {
        border: 1px solid #e0e3ec;
    }

    .custom-table thead {
        background: #007ae1;
    }

    .custom-table thead th {
        border: 0;
        color: #ffffff;
    }

    .custom-table>tbody tr:hover {
        background: #fafafa;
    }

    .custom-table>tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }

    .custom-table>tbody td {
        border: 1px solid #e6e9f0;
    }


    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }

    .text-success {
        color: #00bb42 !important;
    }

    .text-muted {
        color: #9fa8b9 !important;
    }

    .custom-actions-btns {
        margin: auto;
        display: flex;
        justify-content: flex-end;
    }

    .custom-actions-btns .btn {
        margin: .3rem 0 .3rem .3rem;
    }
</style>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <?php
        if (isset($_POST['btnGetInfo'])) {
            $txtStartDateY = mysqli_real_escape_string($conn, $_REQUEST['txtStartDateY']);
            $txtEndDateX = mysqli_real_escape_string($conn, $_REQUEST['txtEndDateX']);
            $txtClientId = mysqli_real_escape_string($conn, $_REQUEST['txtClientId']);
        }
        $result = mysqli_query($conn, "SELECT * FROM tbl_invoices WHERE (col_invoice_start_date = '$txtStartDateY' AND col_invoice_end_date = '$txtEndDateX' AND col_client_Id = '$txtClientId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "')");
        $row = mysqli_fetch_array($result);
        $varPayer = $row['col_payer'];
        $varInvoiceId = $row['col_invoice_Id'];
        $varClientId = $row['col_client_Id'];
        $varClientName = $row['col_care_recipient'];
        $varInvoices = $row['userId'];
        $varInvoicesSD = $row['col_invoice_start_date'];
        $varInvoicesED = $row['col_invoice_end_date'];
        $varStartDate = date('d M', strtotime("" . $row['col_invoice_start_date'] . ""));
        $varEndDate = date('d M, Y', strtotime("" . $row['col_invoice_end_date'] . ""));
        $varInvoiceDate = date('d M, Y', strtotime("" . $row['col_invoice_start_date'] . ""));

        $sql_total_balance = mysqli_query($conn, "SELECT SUM(`col_payer_rate`) AS total_payment FROM `tbl_invoices` WHERE (col_invoice_start_date = '$txtStartDateY' AND col_invoice_end_date = '$txtEndDateX' AND col_client_Id = '$txtClientId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
        $row_total_balance = mysqli_fetch_array($sql_total_balance, MYSQLI_ASSOC);
        $total_clientPayment = number_format((float)$row_total_balance['total_payment'], 2, '.', '');
        ?>
        <!-- [ breadcrumb ] start -->
        <div style="font-size: 18px;" class="container">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-actions-btns mb-5">
                        <input class="btn btn-info" type="button" value="Download" onclick="PrintElem('#yourdiv')" />
                    </div>
                </div>
            </div>
            <div id="yourdiv" class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="invoice-container">
                                <div class="invoice-header">
                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="myInvoice-header">
                                                Invoice to
                                                <br>
                                                <?php echo $varPayer; ?>
                                                <br>
                                                <?php echo $varPayer; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="myInvoice-header">
                                                <address style="font-size: 18px;" class="text-right">
                                                    Balance due £<?php echo $total_clientPayment; ?>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                            <div class="invoice-details">
                                                <address style="font-size: 18px;">
                                                    <?php echo $varClientName; ?><br>
                                                    Invoice
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                            <div class="invoice-details">
                                                <div class="invoice-num">
                                                    <div style="font-size: 16px;">Invoice - #<?php echo $varInvoiceId; ?></div>
                                                    <div style="font-size: 16px;"><?php echo $varStartDate . ' &rarr; ' . $varEndDate; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                </div>
                                <div class="invoice-body">
                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Care recipient</th>
                                                            <th>Duration</th>
                                                            <th>Rate</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $result_invoice = mysqli_query($conn, "SELECT * FROM tbl_invoices 
                                                        WHERE (col_invoice_start_date = '$txtStartDateY' AND col_invoice_end_date = '$txtEndDateX' AND col_client_Id = '$txtClientId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "')");
                                                        while ($row_invoice = mysqli_fetch_array($result_invoice)) {
                                                            echo "
                                                                <tr>
                                                                    <td style='font-size: 16px;'>
                                                                        " . $row_invoice['col_invoice_start_date'] . "
                                                                        <p class='m-0 text-muted'>
                                                                        </p>
                                                                    </td>
                                                                    <td style='font-size: 16px;'>" . $row_invoice['col_care_recipient'] . "</td>
                                                                    <td style='font-size: 16px;'>" . $row_invoice['col_worked_time'] . "</td>
                                                                    <td style='font-size: 16px;'>" . $row_invoice['col_payer_rate'] . "</td>
                                                                    <td style='font-size: 16px;'>--</td>
                                                                </tr>
                                                                ";
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                </div>
                                <div class="invoice-footer">
                                    Thank you.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function PrintElem(elem) {
        Popup($(elem).html());
    }

    function Popup(data) {
        var mywindow = window.open('', 'new div', 'height=700,width=1200');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="print" />');
        mywindow.document.write('<link rel="stylesheet" media="print" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" media="print" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/css" />');
        mywindow.document.write('</head><body>');
        mywindow.document.write('<br><br><br> <h3>Invoice</h3><br><br>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
<?php include('footer-contents.php'); ?>