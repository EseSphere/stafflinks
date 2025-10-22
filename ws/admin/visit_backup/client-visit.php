<?php
include('client-header-contents.php');
if (isset($_POST['txtDate'])) {
    $txtDate = mysqli_real_escape_string($conn, $_REQUEST['txtDate']);
    $txtClientId = mysqli_real_escape_string($conn, $_REQUEST['txtClientId']);
    $cookie_txtDate = '' . $txtDate;
    $cookie_name = "VisitDate";
    $cookie_value = "" . $cookie_txtDate;
    setcookie($cookie_name, $cookie_value, strtotime('today 23:59'), "/"); // 86400 = 1 day
    header("Location: ./client-visit?uryyToeSS4=$txtClientId");
}
$stmt = $conn->prepare("SELECT * FROM tbl_schedule_calls WHERE uryyToeSS4 = ? 
AND call_status = 'Scheduled' AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = $row['client_name'] ?? null;
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_schedule_calls WHERE uryyToeSS4 = ? 
                AND col_company_Id = ?");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$stmt->bind_result($rowcount);
$stmt->fetch();
$stmt->close();
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-5 col-xl-5 col-sm-5">
                <h4>Visits <small style="font-weight: 600;"><?php echo "(" . $rowcount . ")"; ?> </small></h4>
                <p class="fs-6">Supporting wellbeing through compassionate care visits.</p>
            </div>
            <div class="col-md-3 col-xl-3 col-sm-3">
                <form style="margin-top: 0px;" action="./client-visit" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div style="padding: 0px 0px 20px 5px; width:100%;">
                        <input type="hidden" value="<?php print $uryyToeSS4; ?>" name="txtClientId">
                        <input type="date" name='txtDate' onchange='this.form.submit()' value="<?php echo $visitCookieDate; ?>" style="width: 150px; height:45px; background-color:inherit; border:none; font-size:18px; font-weight:600;" />
                    </div>
                </form>
            </div>
            <div class="col-md-3 col-xl-3 col-sm-3">
                <div style="width: 100%; height:auto; padding:5px; margin-bottom:30px;">
                    <a href="./extra-care-call?uryyToeSS4=<?php echo $uryyToeSS4; ?>" class="btn btn-small btn-info">Add visit</a>
                    <input class="btn btn-secondary" type="button" value="Download file" onclick="printDiv('yourdiv')" />
                </div>
            </div>
        </div>

        <hr style="background-color:rgba(189, 195, 199,1.0);">

        <div class="row">
            <div class="col-md-12">
                <div id="yourdiv">
                    <h5 class="mb-5 mt-3"><strong><?php echo $clientName; ?></strong></h5>
                    <div class="row">
                        <?php
                        $compId = $_SESSION['usr_compId'] ?? '';
                        if (!$compId || !$uryyToeSS4 || !$visitCookieDate) {
                            exit;
                        }
                        $stmt = $conn->prepare(
                            "SELECT first_carer_Id, Clientshift_Date FROM tbl_schedule_calls 
                            WHERE Clientshift_Date = ? AND call_status = 'Scheduled' AND uryyToeSS4 = ? 
                            AND col_company_Id = ? ORDER BY userId ASC LIMIT 1"
                        );
                        $stmt->bind_param("sss", $visitCookieDate, $uryyToeSS4, $compId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if (!$row) {
                            exit;
                        }
                        $varRecentCarer = $row['first_carer_Id'];
                        $varCareCallDate = $row['Clientshift_Date'];
                        echo "<h5><strong><i class='feather mr-2 icon-calendar'></i> " . date('l', strtotime($visitCookieDate)) . "</strong></h5>";
                        $query = "
                        SELECT c.userId, c.dateTime_in, c.dateTime_out, c.first_carer, c.first_carer_Id, c.bgChange, c.call_status, 
                        c.Clientshift_Date FROM tbl_schedule_calls c LEFT JOIN tbl_cancelled_call a ON c.uryyToeSS4 = a.col_client_Id 
                        AND c.care_calls = a.col_care_call AND CURDATE() = a.col_date WHERE c.first_carer_Id = ? 
                        AND c.Clientshift_Date = ? AND a.col_client_Id IS NULL AND c.uryyToeSS4 = ? AND c.col_company_Id = ? 
                        ORDER BY c.dateTime_in ASC";
                        $stmt2 = $conn->prepare($query);
                        $stmt2->bind_param("isss", $varRecentCarer, $visitCookieDate, $uryyToeSS4, $compId);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        $currentTime = date('H:i');
                        while ($row_visit = $result2->fetch_assoc()) {
                            $clientVisitDate = date('d M, Y', strtotime($row_visit['Clientshift_Date']));
                            echo "<div class='col-xl-3'>
                                    <a href='./view-alerts-feed?userId=" . htmlspecialchars($row_visit['userId'], ENT_QUOTES) . "' style='text-decoration:none; color:#000;'>
                                        <div class='card table-card'>
                                            <div class='card-header'>
                                                <h5><i class='feather mr-2 icon-briefcase'></i> &nbsp; Visit</h5>
                                                <span style='position:absolute; right:20px; font-weight:16px;'>
                                                    <i class='feather mr-2 icon-clock'></i> {$currentTime}
                                                </span>
                                            </div>
                                            <div class='card-body p-0'>
                                                <div style='width:100%; height:auto; padding:8px 0 8px 22px; font-weight:600; font-size:16px;'>
                                                    <h6 style='font-weight:600;'>Planned time</h6>
                                                    <table style='border:none;'>
                                                        <tr>
                                                            <td style='font-weight:600;'><h6>Time in</h6></td>
                                                            <td style='font-weight:600; padding: 0 0 0 35px;'><h6>Time out</h6></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span style='font-weight:600;'><i class='feather mr-2 icon-clock'></i> " . htmlspecialchars($row_visit['dateTime_in'], ENT_QUOTES) . " </span></td>
                                                            <td style='padding: 0 0 0 35px;'><span style='font-weight:600;'><i class='feather mr-2 icon-clock'></i> " . htmlspecialchars($row_visit['dateTime_out'], ENT_QUOTES) . " </span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div style='width:100%; height:auto; padding:8px 0 8px 22px; font-weight:600; font-size:16px;'>
                                                    <span style='font-weight:22px;'><i class='feather mr-2 icon-users'></i> " . htmlspecialchars($row_visit['first_carer'], ENT_QUOTES) . " </span>
                                                </div>
                                                <div style='width: 100%; font-weight:600; height:auto; padding:8px; background-color:" . htmlspecialchars($row_visit['bgChange'], ENT_QUOTES) . "; color:#fff;'>
                                                    <span style='font-weight:600;'><i class='feather mr-2 icon-check-square'></i> " . htmlspecialchars($row_visit['call_status'], ENT_QUOTES) . " </span> 
                                                    <span style='font-weight:22px; position:absolute; right:10px;'><i class='feather mr-2 icon-calendar'></i>{$clientVisitDate}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            ";
                        }
                        $stmt->close();
                        $stmt2->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>


<script>
    function printDiv(divId) {
        const content = document.getElementById(divId).innerHTML;
        const originalTitle = document.title;
        const wrapper = document.createElement('div');
        wrapper.innerHTML = content;
        const cards = wrapper.querySelectorAll('.col-xl-3, .col-xl-4, .col-md-6');
        const rowWrapper = document.createElement('div');
        rowWrapper.className = 'row';
        cards.forEach(card => {
            card.classList.remove('col-xl-3', 'col-xl-4', 'col-md-6');
            card.classList.add('col-6');
            rowWrapper.appendChild(card);
        });

        const printWindow = window.open('', '', 'width=1000,height=700');
        printWindow.document.write(`
        <html>
            <head>
                <title>${originalTitle}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://unpkg.com/feather-icons/dist/feather.css" rel="stylesheet">
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    .table-card { box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15); border-radius: 0.5rem; margin-bottom: 20px; }
                    .card-header { background: #f8f9fa; padding: 10px 20px; border-bottom: 1px solid #dee2e6; }
                    .card-body { padding: 20px; }
                </style>
            </head>
            <body onload="window.print(); window.close();">
                <h5 class="mb-3"><strong><?php echo $clientName; ?></strong></h5>
                <div class="container-fluid">
                    ${rowWrapper.outerHTML}
                </div>
            </body>
        </html>
    `);
        printWindow.document.close();
    }
</script>


<?php include('footer-contents.php'); ?>