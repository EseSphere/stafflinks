<?php
include('team-header-contents.php');
$stmt = $conn->prepare("SELECT team_first_name, team_last_name FROM tbl_general_team_form 
WHERE uryyTteamoeSS4 = ? AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyTteamoeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$varCarerNames = $row['team_first_name'] . " " . $row['team_last_name'];
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-5">
                <h5>Carer Availability<br> <small>Below are the list of <?php print $varCarerNames; ?>'s availability.</small></h5>
            </div>
            <div class="col-md-8 col-xl-7">
                <div class="text-end">
                    <a href="./availability?uryyTteamoeSS4=<?php echo $uryyTteamoeSS4; ?>" class="btn btn-info">
                        Absence
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                $result = mysqli_query($conn, "SELECT * FROM tbl_team_status WHERE uryyTteamoeSS4='$uryyTteamoeSS4' 
                AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY userId DESC ");
                while ($row = mysqli_fetch_array($result)) {
                    $varStartDate = date('d M, Y', strtotime("" . $row['col_startDate'] . ""));
                    $varEndDate = date('d M, Y', strtotime("" . $row['col_endDate'] . ""));
                    $varDateSubmitted = date('d M, Y', strtotime("" . $row['dateTime'] . ""));
                    echo "
                        <div class='col-md-4 col-xl-4'>
                        <a href='./approve-availability?userId=" . $row['userId'] . "&logs=$uryyTteamoeSS4' style='text-decoration: none; color:#000;'>
                            <div style='box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;'>
                                <div style='height:200px;' class='card-body'>
                                    <h5 class='card-title'>" . $row['col_team_condition'] . "</h5>
                                    <hr style='background-color:rgba(189, 195, 199,.6);' />
                                    <p style='font-size:18px;' class='card-text'>
                                    " . $row['col_note'] . "
                                    </p>
                                    <p style='font-size:14px;' class='card-text'>
                                    " . $varStartDate . " &rarr; " . $varEndDate . "
                                    </p>
                                </div>
                                <div class='card-footer' style='background-color:" . $row['col_color_code'] . ";'>
                                    <small style='font-weight:600; color:#000;'>" . $varDateSubmitted . " | " . $row['col_approval'] . "</small>
                                </div>
                            </div>
                        </a>
                        </div>
                    ";
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 col-xl-3"></div>
    </div>
</div>


<?php include('footer-contents.php'); ?>