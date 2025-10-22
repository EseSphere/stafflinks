

<?php
require 'dbconnections.php';
$team_name = $_POST['team_name'];
$team_name2 = $_POST['team_name2'];
$event_start_date = date("y-m-d", strtotime($_POST['event_start_date']));
$event_end_date = date("y-m-d", strtotime($_POST['event_end_date']));
$AreaGroup = mysqli_real_escape_string($conn, $_POST['AreaGroupn']);

// In here i update the general table with first carer, second carer, first carer id, second carer id, call start date and call end date
// The monment she click broadcast all the data will be copied to another table for record keeping.

$insert_query = mysqli_query($conn, "UPDATE `tbl_general_client_form` SET `team_name` = '$team_name', `team_name2` = '$team_name2', `event_start_date` = '$event_start_date', `event_end_date` = '$event_end_date' WHERE groupLocation = '$AreaGroup' ");
if ($insert_query) {
    $data = array(
        'status' => true,
        'msg' => 'Event added successfully!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Sorry, Event not added.'
    );
}
echo json_encode($data);
