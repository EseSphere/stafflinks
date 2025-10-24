<?php
include('dbconnections.php');
$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM tbl_holiday WHERE (col_description LIKE '%" . $search . "%' ) ";
} else {
    $query = "SELECT * FROM tbl_holiday WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY col_description ASC ";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
					<table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Pay multiplier</th>
                            <th>Charge multiplier</th>
                            <th>Edit</th>
                        </tr>
                    </thead>';
    while ($trans = mysqli_fetch_array($result)) {
        $varHolidayDate = date('d M, Y', strtotime("" . $trans['col_holiday_date'] . ""));
        $output .= '
			<tr>
            
                                                    <td>
                                                        <div class="d-inline-block align-middle">
                                                            <img src="assets/images/profile/profile-icon.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6> ' . $trans["col_description"] . '</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>' . $varHolidayDate . '</td>
                                                    <td>£' . $trans["col_pay_multiplier"] . '</td>
                                                    <td>£' . $trans["col_charge_multiplier"] . '</td>
                                                    <td>
                                                    <a style="text-decoration:none;" href="./edit-holiday?col_special_Id=' . $trans["col_special_Id"] . '"> 
                                                        <button title="Edit holiday rate" type="button" class="btn btn-primary btn-sm"><i class="feather mr-2 icon-edit"></i></button>
                                                    </a>
                                                    </td>

                                                </tr>
		';
    }
    echo $output;
} else {
    echo 'Data Not Found';
}
