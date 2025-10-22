<?php
include('dbconnections.php');
$output = '';

if (!isset($_SESSION['run_town'], $_SESSION['usr_compId'])) {
    exit;
}

$run_city = $_SESSION['run_city'];
$runCompId = $_SESSION['usr_compId'];

if (isset($_POST["query"])) {
    $search = '%' . $_POST["query"] . '%';
    $sql = "
    SELECT c.*
    FROM tbl_clienttime_calls c
    WHERE c.dateTime_in != '' 
      AND c.dateTime_in IS NOT NULL 
      AND c.dateTime_out != '' 
      AND c.client_city = ? 
      AND (c.client_name LIKE ? OR c.client_area LIKE ?)
      AND NOT EXISTS (
          SELECT 1 
          FROM tbl_client_status_records s
          WHERE s.col_client_Id = c.uryyToeSS4
            AND s.col_end_date = 'TFN'
            AND s.col_company_Id = c.col_company_Id
      )
";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $run_city, $search, $search);
} else {
    $sql = "
    SELECT c.*
    FROM tbl_clienttime_calls c
    WHERE c.dateTime_in != '' 
      AND c.dateTime_in IS NOT NULL 
      AND c.dateTime_out != '' 
      AND c.client_city = ? 
      AND c.col_company_Id = ?
      AND NOT EXISTS (
          SELECT 1
          FROM tbl_client_status_records s
          WHERE s.col_client_Id = c.uryyToeSS4
            AND s.col_end_date = 'TFN'
            AND s.col_company_Id = c.col_company_Id
      )
    ORDER BY c.userId ASC
";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $run_city, $runCompId);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $output .= '<div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Town located</th>
                                <th>Care calls</th>
                                <th>Call time in</th>
                                <th>Call time out</th>
                                <th>Add run</th>
                            </tr>
                        </thead>';

    while ($trans = $result->fetch_assoc()) {
        $output .= '<tr>
                        <td>
                            <div class="d-inline-block align-middle">
                                <div class="d-inline-block">
                                    <h6>' . htmlspecialchars($trans["client_name"]) . '</h6>
                                </div>
                            </div>
                        </td>
                        <td>' . htmlspecialchars($trans["client_area"]) . '</td>
                        <td>' . htmlspecialchars($trans["care_calls"]) . '</td>
                        <td>' . htmlspecialchars($trans["dateTime_in"]) . '</td>
                        <td>' . htmlspecialchars($trans["dateTime_out"]) . '</td>
                        <td>
                            <form method="post" action="./processing-attach-client-run" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="txtReturnDefault" value="' . htmlspecialchars($trans["userId"]) . '" />
                                <input type="hidden" name="txtrunName" value="' . htmlspecialchars($_SESSION['run_name']) . '" />
                                <input type="hidden" name="txtAllClientIds" value="' . htmlspecialchars($trans["uryyToeSS4"]) . '" />
                                <input type="hidden" name="txtAllClientCalls" value="' . htmlspecialchars($trans["care_calls"]) . '" />
                                <input type="hidden" name="txtAllRunsId" value="' . htmlspecialchars($_SESSION['run_Id']) . '" />
                                <input type="hidden" name="txtAllRunCity" value="' . htmlspecialchars($_SESSION['run_city']) . '" />
                                <input type="hidden" name="txtextRequiredCarers" value="' . htmlspecialchars($trans["col_required_carers"]) . '" />
                                <input type="hidden" name="txtStartDate" value="' . htmlspecialchars($trans["col_startDate"]) . '" />
                                <input type="hidden" name="txtendDate" value="' . htmlspecialchars($trans["col_endDate"]) . '" />
                                <input type="hidden" name="txtOccurence" value="' . htmlspecialchars($trans["col_occurence"]) . '" />
                                <input type="hidden" name="txtPeriodOne" value="' . htmlspecialchars($trans["col_period_one"]) . '" />
                                <input type="hidden" name="txtPeriodTwo" value="' . htmlspecialchars($trans["col_period_two"]) . '" />
                                <input type="hidden" name="txtRightToDisplay" value="' . htmlspecialchars($trans["col_right_to_display"]) . '" />
                                <input type="hidden" name="txtRunCompanyId" value="' . htmlspecialchars($_SESSION["usr_compId"]) . '" />
                                <button style="height:40px;" title="Add care call" name="btnAddToGroup" type="submit" class="btn btn-info btn-sm">
                                    <i class="feather mr-2 icon-briefcase"></i> Add +
                                </button>
                            </form>
                        </td>
                    </tr>';
    }

    $output .= '</table></div>';
    echo $output;
} else {
    echo 'Data Not Found';
}
