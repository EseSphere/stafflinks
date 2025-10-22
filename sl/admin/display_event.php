<?php
require 'dbconnections.php';
$display_query = "select event_id,team_name,team_name2,event_start_date,event_end_date from tbl_schedule_call";
$results = mysqli_query($conn, $display_query);
$count = mysqli_num_rows($results);
if ($count > 0) {
	$data_arr = array();
	$i = 1;
	while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
		$data_arr[$i]['event_id'] = $data_row['event_id'];
		$data_arr[$i]['title'] = $data_row['team_name'];
		$data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['event_start_date']));
		$data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['event_end_date']));
		$data_arr[$i]['color'] = '#' . substr(uniqid(), -6); // 'green'; pass colour name
		$data_arr[$i]['url'] = 'https://geocareservices.co.uk';
		$i++;
	}

	$data = array(
		'status' => true,
		'msg' => 'successfully!',
		'data' => $data_arr
	);
} else {
	$data = array(
		'status' => false,
		'msg' => 'Error!'
	);
}
echo json_encode($data);
