<?php

include('client-header-contents.php');
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
}
$select_client_carecalls = mysqli_query($conn, "SELECT * FROM tbl_clienttime_calls 
WHERE uryyToeSS4='" . $uryyToeSS4 . "' AND col_company_Id='" . $_SESSION['usr_compId'] . "'");

$careCallMap = [
    'EM morning call' => ['name' => 'txtEM', 'label' => 'EM'],
    'EL lunch call'   => ['name' => 'txtEL', 'label' => 'EL'],
    'ET tea call'     => ['name' => 'txtET', 'label' => 'ET'],
    'EB bed call'     => ['name' => 'txtEB', 'label' => 'EB'],
];
$sql = "SELECT * FROM tbl_clients_task_records WHERE id = '$taskId' 
AND col_company_Id = '" . $_SESSION['usr_compId'] . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $uryyToeSS4 = $row['uryyToeSS4'];
        $client_taskName = $row['client_taskName'];
        $client_task_details = $row['client_task_details'];
        $care_call1 = $row['care_call1'];
        $care_call2 = $row['care_call2'];
        $care_call3 = $row['care_call3'];
        $care_call4 = $row['care_call4'];
        $extra_call1 = $row['extra_call1'];
        $extra_call2 = $row['extra_call2'];
        $extra_call3 = $row['extra_call3'];
        $extra_call4 = $row['extra_call4'];
        $monday = $row['monday'];
        $tuesday = $row['tuesday'];
        $wednesday = $row['wednesday'];
        $thursday = $row['thursday'];
        $friday = $row['friday'];
        $saturday = $row['saturday'];
        $sunday = $row['sunday'];
        $task_startDate = $row['task_startDate'];
        $task_endDate = $row['task_endDate'];
    }
}
