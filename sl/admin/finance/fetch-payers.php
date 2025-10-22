<?php
include('dbconnections.php');
$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM tbl_payer WHERE (col_name LIKE '%" . $search . "%' OR col_email LIKE '%" . $search . "%' OR col_phone_number LIKE '%" . $search . "%') ";
} else {
    $query = "SELECT * FROM tbl_payer WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY col_name ASC ";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
					<table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Invoice preference</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Contract</th>
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
                                                    <td>' . $trans["col_email"] . '</td>
                                                    <td>' . $trans["col_phone_number"] . '</td>
                                                    <td>' . $trans["col_invoice_pref"] . '</td> 
                                                    <td>' . $trans["col_address"] . '</td>
                                                    <td>' . $trans["col_status"] . '</td>
                                                    <td>
                                                        <a style="text-decoration:none;" href="./view-contract?col_special_Id=' . $trans["col_special_Id"] . '"> <button title="View travel rate details" type="button" class="btn btn-primary btn-sm"><i class="feather mr-2 icon-list"></i></button></a>
                                                    </td>
                                                </tr>
		';
    }
    echo $output;
} else {
    echo '&nbsp; Data Not Found';
}
