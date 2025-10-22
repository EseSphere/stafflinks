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
                            <h4 class="m-b-10">Subscriptions</h4>
                            <span>Use this section to create and edit subscriptions, and assign them to clients. To invoice payers for a subscription, please ensure that you add the subscription to the relevant rate card</span>
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
                <button class="btn btn-outline-secondary">New subscription</button>
                <br><br>
                <!--First table contents-->
                <div class="card table-card tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-1">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-3">
                                <h5></h5>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <form action="">
                                    <div class="form-group">
                                        <input type="search" class="form-control" required placeholder="Search" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Subscription rate</th>
                                        <th>Frequency</th>
                                        <th>Assigned to</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>--</td>
                                        <td>No subscription created</td>
                                        <td>--</td>
                                        <td><a href=''> <button title='View client task' type='button' class='btn  btn-primary btn-sm'><i class='feather mr-2 icon-list'></i></button></a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Subscription rate</th>
                                        <th>Frequency</th>
                                        <th>Assigned to</th>
                                        <th>Decision</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>

<?php include('footer-contents.php'); ?>