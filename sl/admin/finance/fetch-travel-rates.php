<?php
include('dbconnections.php');
$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM tbl_travel_rate WHERE (col_name LIKE '%" . $search . "%' OR col_service_type LIKE '%" . $search . "%') ";
} else {
    $query = "SELECT * FROM tbl_travel_rate WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY col_name ASC ";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
					<table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Hourly rate</th>
                            <th>Mileage rate</th>
                            <th>Break</th>
                            <th>Pay waiting time</th>
                            <th>Last Updated</th>
                            <th>Decision</th>
                        </tr>
                    </thead>';
    while ($trans = mysqli_fetch_array($result)) {
        // $clientDOB = date('d M, Y', strtotime("" . $trans['client_date_of_birth'] . ""));
        $output .= '
			<tr>
            
                                                    <td>
                                                        <div class="d-inline-block align-middle">
                                                            <div class="d-inline-block">
                                                                <h6> ' . $trans["col_name"] . '</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>' . $trans["col_hourly_rate"] . '</td>
                                                    <td>' . $trans["col_mileage_rate"] . '</td>
                                                    <td>' . $trans["col_break"] . '</td>
                                                    <td>' . $trans["col_pay_waiting_time"] . '</td>
                                                    <td>' . $trans["col_date"] . '</td>
                                                    <td>
                                                    <a style="text-decoration:none;" href="./edit-travel-rate?col_special_Id=' . $trans["col_special_Id"] . '"> <button title="View travel rate details" type="button" class="btn btn-primary btn-sm"><i class="feather mr-2 icon-list"></i></button></a>
                                                    </td>

                                                </tr>
		';
    }
    echo $output;
} else {
    echo 'Data Not Found';
}
