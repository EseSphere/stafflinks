<div class="col-md-12 col-xl-4">
    <a href="./team-list" class="text-decoration-none mt-0 p-0">
        <div class="card flat-card widget-primary-card">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="feather icon-list"></i>
                </div>
                <div class="col-sm-9">
                    <h4>
                        <?php
                        $sql_count_totalTeam = mysqli_query($conn, "SELECT * FROM tbl_general_team_form 
                                WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                        $sql_count_result = mysqli_num_rows($sql_count_totalTeam);
                        printf($sql_count_result);
                        ?>
                    </h4>
                    <h6>Team</h6>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-md-12 col-xl-4">
    <a href="./active-team" class="text-decoration-none mt-0 p-0">
        <div class="card flat-card widget-purple-card">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="feather icon-activity"></i>
                </div>
                <div class="col-sm-9">
                    <h4>
                        <?php
                        $query = "
                                SELECT t1.userId, t1.uryyTteamoeSS4, t1.col_company_Id FROM tbl_general_team_form t1
                                        LEFT JOIN tbl_team_status t2 
                                        ON 
                                        t1.uryyTteamoeSS4 = t2.uryyTteamoeSS4 AND ((CURDATE() BETWEEN t2.col_startDate AND t2.col_endDate) 
                                        OR (t2.col_startDate = '$today' AND t2.col_endDate = 'TFN')) WHERE t2.uryyTteamoeSS4 IS NULL ;
                                ";
                        $sql_count_active = mysqli_query($conn, $query);
                        $sql_count_result = mysqli_num_rows($sql_count_active);
                        printf($sql_count_result);
                        ?>
                    </h4>
                    <h6>Active</h6>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-md-12 col-xl-4">
    <a href="./in-active-team" class="text-decoration-none mt-0 p-0">
        <div class="card flat-card widget-info-card" style="background-color: rgba(231, 76, 60,1.0); color:white;">
            <div class="row-table">
                <div class="col-sm-3 card-body" style="background-color: rgba(192, 57, 43,1.0); color:white;">
                    <i class="feather icon-alert-triangle"></i>
                </div>
                <div class="col-sm-9" style="color: white;;">
                    <h4 style="color: white;;">
                        <?php
                        $query = "
                                SELECT t1.userId, t1.uryyTteamoeSS4, t1.col_company_Id FROM tbl_general_team_form t1
                                        LEFT JOIN tbl_team_status t2 
                                        ON 
                                        t1.uryyTteamoeSS4 = t2.uryyTteamoeSS4 WHERE (t2.col_startDate <= '$today' AND t2.col_endDate >= '$today') 
                                        OR (t2.col_startDate = '$today' AND t2.col_endDate = 'TFN');
                                ";
                        $sql_count_active = mysqli_query($conn, $query);
                        $sql_count_result = mysqli_num_rows($sql_count_active);
                        printf($sql_count_result);
                        ?>
                    </h4>
                    <h6 style="color: white;;">In-active</h6>
                </div>
            </div>
        </div>
    </a>
</div>