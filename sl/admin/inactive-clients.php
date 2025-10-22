<?php include('header-contents.php'); ?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><strong>Inactive clients</strong></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Clients board</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php require_once('client-sub-header.php'); ?>
            <!-- Inactive Clients Table -->
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="feather icon-alert-triangle text-danger mr-2"></i> Inactive Clients</h5>
                        <div class="filter-buttons">
                            <a href="./inactive-clients?type=temporary" class="btn btn-sm btn-outline-danger">
                                Temporary
                            </a>

                            <a href="./inactive-clients?type=permanent" class="btn btn-sm btn-outline-dark">
                                Permanent
                            </a>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 col-4">
                                <input type="search" class="form-control" name="search_text" id="search_text"
                                    placeholder="Search client here..." />
                            </div>
                            <div class="col-sm-2 col-4">
                                <form action="./cookie-cities" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">
                                    <select onchange="this.form.submit()" name="clientView" id="select_page"
                                        style="width:200px; height:50px;" class="form-control">
                                        <option
                                            style="height:40px; padding:12px; background-color:rgba(39,174,96,1.0); color:white;"
                                            value="">
                                            <?php
                                            if (isset($_COOKIE['companyCity'])) {
                                                echo $_COOKIE["companyCity"];
                                            } else {
                                                echo "Select city...";
                                            } ?>
                                        </option>
                                        <option value="Select all">Select all</option>
                                        <?php
                                        $sql_get_client_cities = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') GROUP BY col_Office_Incharge");
                                        while ($row_get_client_cities = mysqli_fetch_array($sql_get_client_cities)) {
                                            echo "<option value='" . $row_get_client_cities['col_Office_Incharge'] . "'>" . $row_get_client_cities['col_Office_Incharge'] . "</option>";
                                        } ?>
                                    </select>
                                </form>
                            </div>
                            <div class="col-sm-5 col-4 text-right">
                                <a href="./add-new-client" style="text-decoration:none;">
                                    <button style="height: 48px;" type="button" class="btn btn-outline-info">
                                        <i class="feather mr-2 icon-plus"></i>Add client
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-y:scroll;" class="card-body p-0">
                        <div class="table-responsive">
                            <div id="result"></div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Get type from query string (temporary or permanent)
        const urlParams = new URLSearchParams(window.location.search);
        const clientType = urlParams.get('type') || ''; // default: show all if not set
        load_data('', clientType);
        refreshInactiveCounts();

        function load_data(query = '', type = '') {
            $.ajax({
                url: "fetch-inactive-clients.php",
                method: "post",
                data: {
                    qury: query,
                    type: type
                    // 🔹 Pass type to backend
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search, clientType);
            } else {
                load_data('', clientType);
            }
        });
    });
</script>
<?php include('footer-contents.php'); ?>