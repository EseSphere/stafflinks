<!-- prject ,team member start -->
<!-- seo start -->

<div class="col-xl-4 col-md-12">
    <br><br><br>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6">
                    <h3>
                        <?php
                        $sql_total_client = "SELECT * FROM tbl_general_client_form WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                        $result_total_client = mysqli_query($conn, $sql_total_client);
                        $rowcount = mysqli_num_rows($result_total_client);
                        printf($rowcount);
                        ?>
                    </h3>
                    <h6 class="text-muted m-b-0">clients<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                </div>
                <div class="col-6">
                    <div id="seo-chart1" class="d-flex align-items-end"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-6">
    <br><br><br>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6">
                    <h3>
                        <?php
                        $sql_total_team = "SELECT * FROM tbl_general_team_form WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                        $result_total_team = mysqli_query($conn, $sql_total_team);
                        $rowcount = mysqli_num_rows($result_total_team);
                        printf($rowcount);
                        ?>
                    </h3>
                    <h6 class="text-muted m-b-0">Team<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                </div>
                <div class="col-6">
                    <div id="seo-chart2" class="d-flex align-items-end"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-6">
    <br><br><br>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6">
                    <h3>
                        <?php
                        $sql_total_areas = "SELECT client_area FROM tbl_general_client_form WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') GROUP BY client_area";
                        if ($result_total_areas = mysqli_query($conn, $sql_total_areas)) {
                            $rowcount = mysqli_num_rows($result_total_areas);
                            printf($rowcount);
                            mysqli_free_result($result_total_areas);
                        }
                        ?>
                    </h3>
                    <h6 class="text-muted m-b-0">Area<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                </div>
                <div class="col-6">
                    <div id="seo-chart3" class="d-flex align-items-end"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- seo end -->