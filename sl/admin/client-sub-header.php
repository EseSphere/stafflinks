<!--client-sub-header.php-->
<div class="btn-group w-100 d-flex flex-wrap" role="group" aria-label="Client Stats">
    <!-- Clients Button -->
    <a href="./client-list" class="flex-fill text-decoration-none">
        <button style="height: 50px;" type="button" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-start p-2">
            <i class="feather icon-list fs-5 me-2"></i>
            <div class="text-start">
                <h6 class="mb-0 text-white fw-bold">
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
                        WHERE col_Office_Incharge = '$varCookieCity' 
                        AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                        if ($result = mysqli_query($conn, $sql_overall_client)) {
                            $rowcount = mysqli_num_rows($result);
                            printf($rowcount);
                            mysqli_free_result($result);
                        }
                    }
                    ?>
                </h6>
                <small class="text-white-50">Clients</small>
            </div>
        </button>
    </a>

    <!-- Active Clients Button -->
    <a href="./active-clients" class="flex-fill text-decoration-none">
        <button style="height: 50px;" type="button" class="btn btn-success btn-sm w-100 d-flex align-items-center justify-content-start p-2">
            <i class="feather icon-activity fs-5 me-2"></i>
            <div class="text-start">
                <h6 class="mb-0 text-white fw-bold">
                    <?php
                    $varCookieCity = $_COOKIE['companyCity'] ?? null;
                    if ($varCookieCity == 'Select all') {
                        $query = "
                        SELECT t1.userId
                        FROM tbl_general_client_form t1
                        LEFT JOIN tbl_client_status_records t2 
                        ON t1.uryyToeSS4 = t2.col_client_Id 
                        AND ((CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) 
                        OR (t2.col_start_date <= '$today' AND t2.col_end_date = 'TFN'))
                        WHERE t1.col_company_Id = '" . $_SESSION['usr_compId'] . "'
                        AND ((t2.col_reason NOT IN ('Deceased', 'Left Service', 'Hospitalized', 
                        'Inactive', 'Holiday', 'With family', 'Permanent', 'Other') 
                        OR t2.col_reason IS NULL))
                        GROUP BY t1.uryyToeSS4;
                        ";
                        $sql_count_active = mysqli_query($conn, $query);
                        $sql_count_result1 = mysqli_num_rows($sql_count_active);
                        printf($sql_count_result1);
                    } else {
                        $query = "
                        SELECT t1.userId
                        FROM tbl_general_client_form t1
                        LEFT JOIN tbl_client_status_records t2 
                        ON t1.uryyToeSS4 = t2.col_client_Id 
                        AND ((CURDATE() BETWEEN t2.col_start_date AND t2.col_end_date) 
                        OR (t2.col_start_date <= '$today' AND t2.col_end_date = 'TFN'))
                        WHERE t1.col_Office_Incharge = '$varCookieCity' 
                        AND t1.col_company_Id = '" . $_SESSION['usr_compId'] . "'
                        AND ((t2.col_reason NOT IN ('Deceased', 'Left Service', 'Hospitalized', 
                        'Inactive', 'Holiday', 'With family', 'Permanent', 'Other') 
                        OR t2.col_reason IS NULL))
                        GROUP BY t1.uryyToeSS4;
                        ";
                        $sql_count_active = mysqli_query($conn, $query);
                        $sql_count_result2 = mysqli_num_rows($sql_count_active);
                        printf($sql_count_result2);
                    }
                    ?>
                </h6>
                <small class="text-white-50">Active</small>
            </div>
        </button>
    </a>

    <!-- Inactive Clients Button -->
    <a href="./inactive-clients" class="flex-fill text-decoration-none">
        <button style="height: 50px;" type="button" class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-start p-2">
            <i class="feather icon-alert-triangle fs-5 me-2"></i>
            <div class="text-start">
                <h6 class="mb-0 text-white fw-bold">
                    <?php
                    $varCookieCity = $_COOKIE['companyCity'] ?? null;
                    if ($varCookieCity == 'Select all') {
                        $sql_query = "SELECT * FROM tbl_client_status_records 
                        WHERE (col_end_date > '$today' OR col_end_date = 'TFN') 
                        AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                        if ($result2 = mysqli_query($conn, $sql_query)) {
                            $rowcount2 = mysqli_num_rows($result2);
                            $inactResult = $rowcount2 - $sql_count_result1;
                            echo $inactResult;
                            mysqli_free_result($result2);
                        }
                    } else {
                        $sql_query = "SELECT * FROM tbl_client_status_records 
                        WHERE (col_end_date > '$today' OR col_end_date = 'TFN') 
                        AND client_city = '$varCookieCity' 
                        AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
                        if ($result2 = mysqli_query($conn, $sql_query)) {
                            $rowcount2 = mysqli_num_rows($result2);
                            $inactResult = $rowcount2 - $sql_count_result2;
                            echo $inactResult;
                            mysqli_free_result($result2);
                        }
                    }
                    ?>
                </h6>
                <small class="text-white-50">Inactive</small>
            </div>
        </button>
    </a>
</div>