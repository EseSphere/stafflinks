<div class="col-md-12 col-xl-6">
    <div class="card flat-card">
        <div class="row-table">
            <div class="col-sm-6 card-body br">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-home text-c-green mb-1 d-block"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>View</h5>
                        <span style="font-size:11px;">Dashboard</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-user text-c-red mb-1 d-block"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>
                            <?php
                            $sql_total_team = "SELECT * FROM tbl_general_team_form 
                            WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            if ($result_total_team = mysqli_query($conn, $sql_total_team)) {
                                $rowcount = mysqli_num_rows($result_total_team);
                                printf($rowcount);
                                mysqli_free_result($result_total_team);
                            }
                            ?>
                        </h5>
                        <span style="font-size:11px;">Team</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-table">
            <div class="col-sm-6 card-body br">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-user-plus text-c-blue mb-1 d-block"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>
                            <?php
                            $sql_total_client = "SELECT * FROM tbl_general_client_form 
                                        WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            if ($result_total_client = mysqli_query($conn, $sql_total_client)) {
                                $rowcount = mysqli_num_rows($result_total_client);
                                printf($rowcount);
                                mysqli_free_result($result_total_client);
                            }
                            ?>
                        </h5>
                        <span style="font-size:11px;">Clients</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-briefcase text-c-yellow mb-1 d-block"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>
                            <?php
                            $sql_position = "SELECT * FROM tbl_position 
                            WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "')";
                            if ($result_position = mysqli_query($conn, $sql_position)) {
                                $rowcount = mysqli_num_rows($result_position);
                                printf($rowcount);
                            }
                            ?>
                        </h5>
                        <span style="font-size:11px;">Position</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- widget primary card start -->
    <div class="card flat-card widget-primary-card">
        <div class="row-table">
            <div class="col-sm-3 card-body">
                <i class="feather icon-map-pin text-c-cream mb-1 d-block"></i>
            </div>
            <div class="col-sm-9">
                <h4>
                    <?php
                    $sql_total_area = "SELECT client_area FROM tbl_general_client_form 
                    WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') GROUP BY client_area";
                    if ($result_total_area = mysqli_query($conn, $sql_total_area)) {
                        $rowcount = mysqli_num_rows($result_total_area);
                        printf($rowcount);
                        mysqli_free_result($result_total_area);
                    }
                    ?>
                </h4>
                <h6>Location</h6>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-6">
    <div class="card flat-card">
        <div class="row-table">
            <div class="col-sm-6 card-body br">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-tag text-c-green mb-1 d-block"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>
                            <?php
                            $sql_total_task = "SELECT * FROM tbl_clients_task_records 
                            WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            if ($result_total_task = mysqli_query($conn, $sql_total_task)) {
                                $rowcount = mysqli_num_rows($result_total_task);
                                printf($rowcount);
                                mysqli_free_result($result_total_task);
                            }
                            ?>
                        </h5>
                        <span style="font-size:11px;">Task</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-heart text-c-blue mb-1 d-block"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>
                            <?php
                            $sql_total_meds = "SELECT * FROM tbl_clients_medication_records 
                            WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "')";
                            if ($result_total_meds = mysqli_query($conn, $sql_total_meds)) {
                                $rowcount = mysqli_num_rows($result_total_meds);
                                printf($rowcount);
                                mysqli_free_result($result_total_meds);
                            }
                            ?>
                        </h5>
                        <span style="font-size:11px;">Medication</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-table">
            <div class="col-sm-6 card-body br">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-map-pin text-c-blue mb-1 d-block"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>
                            <?php
                            $sql_total_areas = "SELECT client_area FROM tbl_general_client_form 
                            WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') GROUP BY client_area";
                            if ($result_total_areas = mysqli_query($conn, $sql_total_areas)) {
                                $rowcount = mysqli_num_rows($result_total_areas);
                                printf($rowcount);
                                mysqli_free_result($result_total_areas);
                            }
                            ?>
                        </h5>
                        <span style="font-size:11px;">Area</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="icon feather icon-book text-c-blue mb-1 d-blockz"></i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5><?php
                            $sql_total_report = "SELECT COUNT(*) AS total_rows FROM tbl_raise_concern 
                            WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            $result = $conn->query($sql_total_report);
                            if ($result) {
                                $row = $result->fetch_assoc();
                                echo $row['total_rows'];
                            } else {
                                echo "Error: " . $conn->error;
                            }
                            ?></h5>
                        <span style="font-size:11px;">Report</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- widget-success-card start -->
    <div class="card flat-card widget-purple-card">
        <div class="row-table">
            <div class="col-sm-3 card-body">
                <i class="fas fa-trophy"></i>
            </div>
            <div class="col-sm-9">
                <h4>
                    <?php
                    $sql_total_team = "SELECT * FROM tbl_ratings 
                    WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "' GROUP BY uryyToeSS4";
                    if ($result_total_team = mysqli_query($conn, $sql_total_team)) {
                        $rowcount = mysqli_num_rows($result_total_team);
                        printf($rowcount);
                        mysqli_free_result($result_total_team);
                    }
                    ?>
                </h4>
                <h6>Feedback</h6>
            </div>
        </div>
    </div>
</div>
<!-- Widget primary-success card end -->