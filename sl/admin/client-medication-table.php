<div style="overflow-x:auto;">
    <a style="text-decoration: none;" target="_blank" href="https://www.nhsbsa.nhs.uk/pharmacies-gp-practices-and-appliance-contractors/dictionary-medicines-and-devices-dmd" type="button" class="btn btn-info">
        <i class="feather mr-2 icon-help-circle"></i> NHS
    </a>
    <a style="text-decoration: none;" href="./marchart?<?php echo "uryyToeSS4=" . $uryyToeSS4; ?>" type="button" class="btn btn-primary">
        <i class="feather mr-2 icon-eye"></i> MarChart
    </a>
    <a style="text-decoration: none;" href="./medication-overview.php?<?php echo "uryyToeSS4=" . $uryyToeSS4; ?>" type="button" class="btn btn-success">
        <i class="feather mr-2 icon-activity"></i> Overview
    </a>
</div>


<div class="card table-card mt-2" style="background-color:rgba(236, 240, 241,1.0);">
    <div class="card-header">
        <h5>Medication Records</h5>
        <div class="card-header-right">
            <button id="btnEnlarge" class="btn btn-success text-center btn-sm"><i
                    class="feather mr-2 icon-eye"></i></button>
        </div>
    </div>
    <div class="card-body p-0" style="height: 100vh; overflow-y: auto;">
        <div class="table-responsive" id="draggable-table">
            <table class="table table-striped table-hover mb-0 text-left">
                <thead>
                    <tr>
                        <th>Medicine</th>
                        <th>When</th>
                        <th>Frequency</th>
                        <th>Package</th>
                        <th>Case</th>
                        <th class="text-right">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT 
            med_name, med_dosage, med_type, id, col_period_two, col_period_one, col_extra_visit, 
            client_startMed, client_endMed, med_package, 
            LEFT(monday, 1) AS MDay, LEFT(tuesday, 1) AS TDay, LEFT(wednesday, 1) AS WDay, 
            LEFT(thursday, 1) AS THDay, LEFT(friday, 1) AS FDay, LEFT(saturday, 1) AS SDay, 
            LEFT(sunday, 1) AS SATDay, LEFT(care_call1, 1) AS BCall, LEFT(care_call2, 1) AS LCall, 
            LEFT(care_call3, 1) AS TCall, LEFT(care_call4, 1) AS BdCall, 
            LEFT(extra_call1, 2) AS EBCall, LEFT(extra_call2, 2) AS ELCall, 
            LEFT(extra_call3, 2) AS ETCall, LEFT(extra_call4, 2) AS EBdCall 
          FROM tbl_clients_medication_records 
          WHERE uryyToeSS4 = ? 
            AND col_company_Id = ?
            AND (
                 client_endMed IS NULL 
                 OR client_endMed = '' 
                 OR client_endMed >= CURDATE()
            )
            AND col_occurence <> 'Stop'";

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $days = ['MDay', 'TDay', 'WDay', 'THDay', 'FDay', 'SDay', 'SATDay'];
                        $careCalls = ['BCall', 'EBCall', 'LCall', 'ELCall', 'TCall', 'ETCall', 'BdCall', 'EBdCall'];
                        echo "<tr>
                            <td style='width:300px; text-align:left; font-weight:600; font-size:14px; white-space:normal; overflow-wrap:break-word;'>
                                <div style='width:300px; text-align:left; font-weight:600; font-size:14px; white-space:normal; overflow-wrap:break-word;'>
                                    <div style='width:300px; text-align:left; font-weight:600; font-size:14px; white-space:normal; overflow-wrap:break-word;'>
                                        {$row['med_name']} {$row['med_dosage']} {$row['med_type']}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <ul class='pagination justify-content-center pagination-sm'>";
                        foreach ($days as $day) {
                            echo "<li style='padding:2px; margin-right:3px; border-radius:3px; font-weight:600; width:23px; text-align:center; background-color:rgba(46,204,113,1.0); color:white; font-size:12px;'>{$row[$day]}</li>";
                        }

                        echo "  </ul>
                            </td>
                            <td>
                                <ul class='pagination justify-content-center pagination-sm'>";
                        foreach ($careCalls as $call) {
                            echo "<li style='padding:2px; margin-right:3px; border-radius:3px; font-weight:600; width:23px; text-align:center; background-color:#192a56; color:white; font-size:12px;'>{$row[$call]}</li>";
                        }

                        echo "  </ul>
                                <ul class='justify-content-center'>
                                    <li style='padding:2px; margin-right:3px; border-radius:3px; font-weight:600; width:23px; text-align:center; background-color:inherit; color:#000; font-size:12px;'>{$row['col_extra_visit']}</li>
                                </ul>
                            </td>
                            <td>
                                <span style='height:20px; width:20px; border-radius:50px; padding:3px; font-size:14px; font-weight:600;'>{$row['med_package']}</span>
                            </td>
                            <td>
                                <span style='height:20px; width:20px; border-radius:50px; padding:3px; font-size:14px; font-weight:600;'>{$row['col_period_one']}</span>
                                <span style='height:20px; width:20px; padding:3px; font-size:14px; font-weight:600;'>{$row['col_period_two']}</span>
                            </td>
                            <td class='text-right'>
                                <a style='text-decoration:none;' href='./edit-client-medication?id={$row['id']}&uryyToeSS4={$uryyToeSS4}' title='Edit client medicine' type='button' class='btn btn-primary btn-sm'><i class='feather icon-edit'></i></a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>