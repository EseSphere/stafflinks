<?php
$stmt = $conn->prepare("SELECT * FROM tbl_clients_task_records 
        WHERE uryyToeSS4 = ? AND col_company_Id = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("si", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "
                    <a href='./client-medication?uryyToeSS4=" . htmlspecialchars($row['uryyToeSS4']) . "'>
                        <button type='button' class='btn btn-outline-info'><i class='feather mr-2 icon-eye'></i>View meds</button>
                    </a>
                ";
}
$stmt->close();
?>

<div class="card table-card" style="background-color:rgba(236, 240, 241,1.0);">
    <div class="card-header">
        <h5>Task Record</h5>
        <div class="card-header-right">
            <button id="btnEnlarge" class="btn btn-success text-center btn-sm"><i class="feather mr-2 icon-eye"></i></button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive" id="draggable-table">
            <table class="table table-striped table-hover mb-0 text-left">
                <thead>
                    <tr>
                        <th>Tasks</th>
                        <th>When</th>
                        <th>Frequency</th>
                        <th>Occurrence</th>
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->prepare("
                           SELECT 
    client_taskName, id, col_period_two, col_period_one, col_extra_visit, 
    task_startDate, task_endDate, col_occurence,
    SUBSTRING(monday,1,1) AS MDay, SUBSTRING(tuesday,1,1) AS TDay,
    SUBSTRING(wednesday,1,1) AS WDay, SUBSTRING(thursday,1,1) AS THDay,
    SUBSTRING(friday,1,1) AS FDay, SUBSTRING(saturday,1,1) AS SDay,
    SUBSTRING(sunday,1,1) AS SATDay,
    SUBSTRING(care_call1,1,1) AS BCall, SUBSTRING(care_call2,1,1) AS LCall,
    SUBSTRING(care_call3,1,1) AS TCall, SUBSTRING(care_call4,1,2) AS BdCall,
    SUBSTRING(extra_call1,1,2) AS EBCall, SUBSTRING(extra_call2,1,2) AS ELCall,
    SUBSTRING(extra_call3,1,2) AS ETCall, SUBSTRING(extra_call4,1,2) AS EBdCall
FROM tbl_clients_task_records
WHERE uryyToeSS4 = ? 
  AND col_company_Id = ?
  AND (col_occurence <> 'Stop')
  AND (
        task_endDate IS NULL 
        OR task_endDate = '' 
        OR task_endDate >= CURDATE()
      )
ORDER BY id ASC;
                        ");
                    $stmt->bind_param("si", $uryyToeSS4, $_SESSION['usr_compId']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $taskName = htmlspecialchars($row['client_taskName']);
                        $clientId = (int)$row['id'];
                        $periodOne = htmlspecialchars($row['col_period_one']);
                        $periodTwo = htmlspecialchars($row['col_period_two']);
                        $extraVisit = htmlspecialchars($row['col_extra_visit']);
                        $days = ['MDay', 'TDay', 'WDay', 'THDay', 'FDay', 'SDay', 'SATDay'];
                        $calls = ['BCall', 'EBCall', 'LCall', 'ELCall', 'TCall', 'ETCall', 'BdCall', 'EBdCall'];

                        echo "<tr>";
                        echo "<td style='width:300px; text-align:left; font-weight:600; font-size:14px; white-space:normal; overflow-wrap:break-word;'>
                                <div style='width:300px; text-align:left; font-weight:600; font-size:14px; white-space:normal; overflow-wrap:break-word;'>
                                    <div style='width:300px; text-align:left; font-weight:600; font-size:14px; white-space:normal; overflow-wrap:break-word;'>
                                        <h6>$taskName</h6>
                                    </div>
                                </div>
                            </td>";
                        echo "<td><ul class='pagination justify-content-center pagination-sm'>";
                        foreach ($days as $day) {
                            echo "<li style='padding:2px; margin-right:3px; border-radius:3px; font-weight:600; width:23px; text-align:center; background-color:rgba(46, 204, 113,1.0); color:white; font-size:12px;'>{$row[$day]}</li>";
                        }
                        echo "</ul></td>";
                        echo "<td><ul class='pagination justify-content-center pagination-sm'>";
                        foreach ($calls as $call) {
                            echo "<li style='padding:2px; margin-right:3px; border-radius:3px; font-weight:600; width:23px; text-align:center; background-color:#192a56; color:white; font-size:12px;'>{$row[$call]}</li>";
                        }
                        echo "</ul>";
                        echo "<ul class='justify-content-center'>";
                        echo "<li style='padding:2px; margin-right:3px; border-radius:3px; font-weight:600; width:23px; text-align:center; background-color:inherit; color:#000; font-size:12px;'>$extraVisit</li>";
                        echo "</ul></td>";
                        echo "<td><span style='height:20px; width:20px; border-radius:50px; padding:3px; font-size:14px; font-weight:600;'>$periodOne</span>
                                  <span style='height:20px; width:20px; padding:3px;font-size:14px; font-weight:600;'>$periodTwo</span></td>";
                        echo "<td class='text-right'><div class='d-inline-block align-middle'>
                                  <a style='text-decoration:none;' href='./edit-client-task?id=$clientId&uryyToeSS4={$uryyToeSS4}' title='Edit client task' type='button' class='btn btn-primary btn-sm'><i class='feather icon-edit'></i></a>
                                  </div></td>";
                        echo "</tr>";
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>