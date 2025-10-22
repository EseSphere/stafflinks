<?php include('header-contents.php'); ?>
<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }

    .multipleSelection {
        width: 200px;
        background-color: rgba(189, 195, 199, 1.0);
        font-size: 16px;
        position: absolute;
        z-index: 1000;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        padding: 5px;
        font-weight: bold;
        font-size: 16px;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkBoxes {
        display: none;
        border: 1px #8DF5E4 solid;
        height: auto;
        padding: 8px;
    }

    #checkBoxes label {
        display: block;
        padding: 5px;
    }

    #checkBoxes label:hover {
        background-color: #4F615E;
        color: white;

        /* Added text color for better visibility */
    }
</style>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">CHC CH</h4>
                            <span>Contracts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div>
                            <button class="btn btn-outline-secondary">Cancel contract</button>
                            <button class="btn btn-outline-secondary">Edit</button>
                        </div>
                        <br>
                        <div style="width: 100%; padding:19px; height:auto; border:1px solid rgba(189, 195, 199,1.0); font-size:18px;">
                            <div class="row">
                                <div class="col-md-4 col-4">Payer</div>
                                <div class="col-md-8 col-8">N/A</div>
                            </div>
                        </div>
                        <div style="width: 100%; padding:19px; height:auto; border:1px solid rgba(189, 195, 199,1.0); font-size:18px;">
                            <div class="row">
                                <div class="col-md-4 col-4">Service types</div>
                                <div class="col-md-8 col-8">N/A</div>
                            </div>
                        </div>
                        <div style="width: 100%; padding:19px; height:auto; border:1px solid rgba(189, 195, 199,1.0); font-size:18px;">
                            <div class="row">
                                <div class="col-md-4 col-4">Invoicing rate</div>
                                <div class="col-md-8 col-8">Hidden</div>
                            </div>
                        </div>
                        <div style="width: 100%; padding:19px; height:auto; border:1px solid rgba(189, 195, 199,1.0); font-size:18px;">
                            <div class="row">
                                <div class="col-md-4 col-4">Invoice format</div>
                                <div class="col-md-8 col-8">Hidden</div>
                            </div>
                        </div>
                        <div style="width: 100%; padding:19px; height:auto; border:1px solid rgba(189, 195, 199,1.0); font-size:18px;">
                            <div class="row">
                                <div class="col-md-4 col-4">Invoice group</div>
                                <div class="col-md-8 col-8">N/A</div>
                            </div>
                        </div>
                        <div style="width: 100%; padding:19px; height:auto; border:1px solid rgba(189, 195, 199,1.0); font-size:18px;">
                            <div class="row">
                                <div class="col-md-4 col-4">Status</div>
                                <div class="col-md-8 col-8">N/A</div>
                            </div>
                        </div>
                        <div style="width: 100%; padding:19px; height:auto; border:1px solid rgba(189, 195, 199,1.0); font-size:18px;">
                            <div class="row">
                                <div class="col-md-4 col-4">Purchase orders</div>
                                <div class="col-md-8 col-8">N/A</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>

<?php include('footer-contents.php'); ?>