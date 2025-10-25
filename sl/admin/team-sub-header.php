<!-- team-sub-header.php -->
<div class="btn-group w-100 d-flex flex-wrap" role="group" aria-label="Team Stats">

    <!-- Total Team Button -->
    <a href="./team-list" class="flex-fill text-decoration-none">
        <button style="height: 50px;" type="button" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-start p-2">
            <i class="feather icon-list fs-5 me-2"></i>
            <div class="text-start">
                <h6 class="mb-0 text-white fw-bold">
                    <?php
                    $sql_count_totalTeam = mysqli_query($conn, "SELECT * FROM tbl_general_team_form 
                    WHERE col_company_Id = '" . $_SESSION['usr_compId'] . "'");
                    $sql_count_result = mysqli_num_rows($sql_count_totalTeam);
                    printf($sql_count_result);
                    ?>
                </h6>
                <small class="text-white-50">Team</small>
            </div>
        </button>
    </a>

    <!-- Active Team Button -->
    <a href="./active-team" class="flex-fill text-decoration-none">
        <button style="height: 50px;" type="button" class="btn btn-success btn-sm w-100 d-flex align-items-center justify-content-start p-2">
            <i class="feather icon-activity fs-5 me-2"></i>
            <div class="text-start">
                <h6 class="mb-0 text-white fw-bold">
                    <?php
                    $query = "
                    SELECT t1.id, t1.uryyTteamoeSS4, t1.col_company_Id 
                    FROM tbl_general_team_form t1
                    LEFT JOIN tbl_team_status t2 
                    ON t1.uryyTteamoeSS4 = t2.uryyTteamoeSS4 
                    AND ((CURDATE() BETWEEN t2.col_startDate AND t2.col_endDate) 
                    OR (t2.col_startDate = '$today' AND t2.col_endDate = 'TFN')) 
                    WHERE t2.uryyTteamoeSS4 IS NULL;";
                    $sql_count_active = mysqli_query($conn, $query);
                    $sql_count_result = mysqli_num_rows($sql_count_active);
                    printf($sql_count_result);
                    ?>
                </h6>
                <small class="text-white-50">Active</small>
            </div>
        </button>
    </a>

    <!-- Inactive Team Button -->
    <a href="./in-active-team" class="flex-fill text-decoration-none">
        <button style="height: 50px;" type="button" class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-start p-2">
            <i class="feather icon-alert-triangle fs-5 me-2"></i>
            <div class="text-start">
                <h6 class="mb-0 text-white fw-bold">
                    <?php
                    $query = "
                    SELECT t1.id, t1.uryyTteamoeSS4, t1.col_company_Id 
                    FROM tbl_general_team_form t1
                    LEFT JOIN tbl_team_status t2 
                    ON t1.uryyTteamoeSS4 = t2.uryyTteamoeSS4 
                    WHERE (t2.col_startDate <= '$today' AND t2.col_endDate >= '$today') 
                    OR (t2.col_startDate = '$today' AND t2.col_endDate = 'TFN');";
                    $sql_count_active = mysqli_query($conn, $query);
                    $sql_count_result = mysqli_num_rows($sql_count_active);
                    printf($sql_count_result);
                    ?>
                </h6>
                <small class="text-white-50">Inactive</small>
            </div>
        </button>
    </a>

</div>