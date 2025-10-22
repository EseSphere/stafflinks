<div class="col-md-12 col-xl-4">
    <div class="card flat-card widget-primary-card">
        <a href="./client-list" class="text-decoration-none w-100 h100 text-white">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="feather icon-list"></i>
                </div>
                <div class="col-sm-9">
                    <h4>
                        <?php
                        $varCookieCity = $_COOKIE['companyCity'] ?? null;
                        if ($varCookieCity == 'Select all') {
                            $sql_overall_client = "SELECT * FROM tbl_general_client_form 
                            WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            if ($result = mysqli_query($conn, $sql_overall_client)) {
                                $rowcount = mysqli_num_rows($result);
                                printf($rowcount);
                                mysqli_free_result($result);
                            }
                        } else {
                            $sql_overall_client = "SELECT * FROM tbl_general_client_form 
                            WHERE col_Office_Incharge = '$varCookieCity' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            if ($result = mysqli_query($conn, $sql_overall_client)) {
                                $rowcount = mysqli_num_rows($result);
                                printf($rowcount);
                                mysqli_free_result($result);
                            }
                        }
                        ?>
                    </h4>
                    <h6>Clients</h6>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-md-12 col-xl-4">
    <div class="card flat-card widget-purple-card">
        <a href="./active-clients" class="text-decoration-none w-100 h100 text-white">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="feather icon-activity"></i>
                </div>
                <div class="col-sm-9">
                    <h4>
                        <?php
                        $varCookieCity = $_COOKIE['companyCity'] ?? null;
                        if ($varCookieCity == 'Select all') {
                            $query = "
                        SELECT t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, 
                               t1.client_poster_code, t1.client_sexuality, t1.client_preferred_name, 
                               t1.client_date_of_birth, t1.client_area, t1.uryyToeSS4, t1.col_company_Id, 
                               t2.col_reason, t2.col_status_color, t2.col_end_date 
                        FROM tbl_general_client_form t1
                        LEFT JOIN tbl_client_status_records t2 
                        ON t1.uryyToeSS4 = t2.col_client_Id AND ((CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) OR (t2.col_start_date <= '$today' 
                                AND t2.col_end_date = 'TFN')) WHERE t1.col_company_Id = '" . $_SESSION['usr_compId'] . "'
                        AND ((t2.col_reason NOT IN ('Deceased', 'Left Service', 'Hospitalized', 'Inactive', 'Holiday', 'With family', 'Permanent', 'Other') OR t2.col_reason IS NULL)
                        )
                        GROUP BY t1.uryyToeSS4;
                        ";
                            $sql_count_active = mysqli_query($conn, $query);
                            $sql_count_result1 = mysqli_num_rows($sql_count_active);
                            printf($sql_count_result1);
                        } else {
                            $query = "
                        SELECT t1.userId, t1.client_first_name, t1.client_last_name, t1.client_primary_phone, 
                               t1.client_poster_code, t1.client_sexuality, t1.client_preferred_name, 
                               t1.client_date_of_birth, t1.client_area, t1.uryyToeSS4, t1.col_company_Id, 
                               t2.col_reason, t2.col_status_color, t2.col_end_date 
                        FROM tbl_general_client_form t1
                        LEFT JOIN tbl_client_status_records t2 
                        ON t1.uryyToeSS4 = t2.col_client_Id AND ((CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) OR (t2.col_start_date <= '$today' 
                                AND t2.col_end_date = 'TFN')) WHERE t1.col_Office_Incharge = '$varCookieCity' AND t1.col_company_Id = '" . $_SESSION['usr_compId'] . "'
                        AND ((t2.col_reason NOT IN ('Deceased', 'Left Service', 'Hospitalized', 'Inactive', 'Holiday', 'With family', 'Permanent', 'Other') OR t2.col_reason IS NULL)
                        )
                        GROUP BY t1.uryyToeSS4;
                        ";
                            $sql_count_active = mysqli_query($conn, $query);
                            $sql_count_result2 = mysqli_num_rows($sql_count_active);
                            printf($sql_count_result2);
                        }
                        ?>
                    </h4>
                    <h6>Active</h6>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-md-12 col-xl-4">
    <div class="card flat-card widget-info-card" style="background-color: rgba(231, 76, 60,1.0); color:white;">
        <a href="./inactive-clients" class="text-decoration-none w-100 h100 text-white">
            <div class="row-table">
                <div class="col-sm-3 card-body" style="background-color: rgba(192, 57, 43,1.0); color:white;">
                    <i class="feather icon-alert-triangle"></i>
                </div>
                <div class="col-sm-9" style="color: white;">
                    <h4 style="color: white;">
                        <?php
                        $varCookieCity = $_COOKIE['companyCity'] ?? null;
                        if ($varCookieCity == 'Select all') {
                            $sql_query = "SELECT * FROM tbl_client_status_records WHERE (col_end_date > '$today' 
                            OR col_end_date = 'TFN') AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            if ($result2 = mysqli_query($conn, $sql_query)) {
                                $rowcount2 = mysqli_num_rows($result2);
                                $inactResult = $rowcount2 - $sql_count_result1;
                                echo $inactResult;
                                mysqli_free_result($result2);
                            }
                        } else {
                            $sql_query = "SELECT * FROM tbl_client_status_records WHERE (col_end_date > '$today' 
                            OR col_end_date = 'TFN') AND client_city = '$varCookieCity' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                            if ($result2 = mysqli_query($conn, $sql_query)) {
                                $rowcount2 = mysqli_num_rows($result2);
                                $inactResult = $rowcount2 - $sql_count_result2;
                                echo $inactResult;
                                mysqli_free_result($result2);
                            }
                        }
                        ?>
                    </h4>
                    <h6 style="color: white;">Inactive</h6>
                </div>
            </div>
        </a>
    </div>
</div>