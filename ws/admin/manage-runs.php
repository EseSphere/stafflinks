<?php include('header-contents.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Manage Run</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li style="font-size:16px;" class="breadcrumb-item">
                                Use runs to group visits together and optimise your rota
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <a href="./add-new-run" type="button" class="btn btn-info"><i class="feather mr-2 icon-plus"></i>Add new run</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i>remove</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-4">
                                <div>
                                    <input type="search" class="form-control" name="search_text" id="search_text" placeholder="Search run here..." />
                                </div>
                                <ul class="list"></ul>
                            </div>
                            <div class="col-sm-2">
                                <form action="./cookie-cities" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <select onchange="this.form.submit()" name="manageRun" id="select_page" style="width:200px; height:50px;" class="form-control">
                                        <option style="height: 40px; padding:12px; background-color:rgba(39, 174, 96,1.0); color:white;" value="">
                                            <?php
                                            if (isset($_COOKIE['companyCity'])) {
                                                echo $_COOKIE["companyCity"];
                                            } else {
                                                echo "Select city...";
                                            } ?>
                                        </option>
                                        <option value="Select all">Select all</option>
                                        <?php
                                        $companyId = $_SESSION['usr_compId'];
                                        $query = "SELECT col_client_city FROM tbl_manage_runs 
                                        WHERE col_company_Id = ? GROUP BY col_client_city";
                                        $stmt = $conn->prepare($query);
                                        if ($stmt) {
                                            $stmt->bind_param("s", $companyId);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                $city = htmlspecialchars($row['col_client_city'], ENT_QUOTES, 'UTF-8');
                                                echo "<option value='{$city}'>{$city}</option>";
                                            }
                                            $stmt->close();
                                        } else {
                                            echo "<option value=''>Error fetching cities</option>";
                                        }
                                        ?>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
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
</div>
<script type="text/javascript">
    $(document).ready(function() {
        function load_data(page = 1, query = '') {
            $.ajax({
                url: "fetch-client-runs.php",
                method: "POST",
                data: {
                    page: page,
                    query: query
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        load_data(); // Load first page initially

        $('#search_text').on('keyup', function() {
            const query = $(this).val();
            load_data(1, query); // Always reset to page 1 on new search
        });

        $(document).on('click', '.pagination .page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            const query = $('#search_text').val();
            if (page !== undefined) {
                load_data(page, query);
            }
        });
    });
</script>



<?php include('footer-contents.php'); ?>