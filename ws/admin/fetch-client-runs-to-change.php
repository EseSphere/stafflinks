<?php
include('dbconnections.php');

$myUserId = $_GET['userId'] ?? null;
$output   = '';

if (!isset($_SESSION['usr_compId'])) {
    die("Company ID not set in session.");
}

if (!empty($_POST['query'])) {
    // Search query
    $search = "%" . trim($_POST['query']) . "%";
    $sql = "
        SELECT * 
        FROM tbl_manage_runs 
        WHERE (col_run_name LIKE ? OR client_area LIKE ?)
        GROUP BY col_run_name 
        ORDER BY userId ASC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $search, $search);
} else {
    // Default query
    $sql = "
        SELECT * 
        FROM tbl_manage_runs 
        WHERE col_company_Id = ?
        GROUP BY col_run_name 
        ORDER BY userId ASC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['usr_compId']);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $output .= '<div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>Run name</th>
                    <th>Town located</th>
                    <th>Decision</th>
                </tr>
            </thead>
            <tbody>';

    while ($trans = $result->fetch_assoc()) {
        $runDateCreated = date('Y-m-d', strtotime($trans['dateTime']));
        $runTimeCreated = date('H:i', strtotime($trans['dateTime']));

        $output .= '<tr>
            <td>
                <div class="d-inline-block align-middle">
                    <div class="d-inline-block">
                        <h6>' . htmlspecialchars($trans["col_run_name"]) . '</h6>
                        <p class="m-b-0" style="padding:3px 0 3px 10px; border-radius:50px;">
                            <strong>' . htmlspecialchars($trans["dateTime"]) . '</strong>
                        </p>
                    </div>
                </div>
            </td>
            <td>' . htmlspecialchars($trans["client_area"]) . '</td>
            <td>
                <form method="post" action="./processing-change-client-run" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="txtRunAreaId" value="' . htmlspecialchars($trans["run_area_nameId"]) . '" />
                    <input type="hidden" name="txtClientId" value="' . htmlspecialchars($_SESSION['myUsersId']) . '" />
                    <input type="hidden" name="txtDateChange" value="' . htmlspecialchars($_SESSION['currentDateRota']) . '" />
                    <input type="hidden" name="txtClientRunName" value="' . htmlspecialchars($trans["col_run_name"]) . '" />
                    <button style="height:40px;" title="Move client care to this run" 
                            name="btnChangeClientRun" 
                            type="submit" 
                            class="btn btn-info btn-sm">
                        <i class="feather mr-2 icon-user"></i> Attach to this run
                    </button>
                </form>
            </td>
        </tr>';
    }

    $output .= '</tbody></table></div>';
    echo $output;
} else {
    echo 'Data Not Found';
}

$stmt->close();
$conn->close();
