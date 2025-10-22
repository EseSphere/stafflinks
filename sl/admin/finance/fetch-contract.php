<?php
include('dbconnections.php');
$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM tbl_contract WHERE (col_name LIKE '%" . $search . "%' ) ";
} else {
    $query = "SELECT * FROM tbl_contract WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY col_name ASC ";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
					<table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Payer</th>
                            <th>Service type</th>
                            <th>Invoice format</th>
                        </tr>
                    </thead>';
    while ($trans = mysqli_fetch_array($result)) {
        // $clientDOB = date('d M, Y', strtotime("" . $trans['client_date_of_birth'] . ""));
        $output .= '
			<tr>
            
                                                    <td>
                                                        <div class="d-inline-block align-middle">
                                                            <img src="assets/images/profile/profile-icon.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6> ' . $trans["col_name"] . '</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>' . $trans["col_payer"] . '</td>
                                                    <td>' . $trans["col_service_type"] . '</td>
                                                    <td>' . $trans["col_invoice_format"] . '</td>
                                                </tr>
		';
    }
    echo $output;
} else {
    echo '&nbsp; Data Not Found';
}
