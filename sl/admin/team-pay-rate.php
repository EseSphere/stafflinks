<?php
include('client-header-contents.php');
if (isset($_GET['uryyTteamoeSS4'])) {
    $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-7">
                <h5>Pay Rate</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <p class="card-text" style="font-size: 16px;">
                            <span><strong onclick="history.back();" style="padding: 5px; cursor:pointer; font-size:25px; background-color:rgba(189, 195, 199,.3);">&larr; </strong></span>
                            &nbsp; Select rate
                        </p>

                        <form action="./processing-team-pay-rate" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="clientSpecialId" value="<?php echo "" . $uryyTteamoeSS4 . ""; ?>" />
                                <select style="height: 50px;" name="txtTeamFunding" class="form-control" required id="">
                                    <option value="--Select options--">--Select options--</option>
                                    <?php
                                    $stmt = $conn->prepare("SELECT col_special_Id, col_name FROM tbl_pay_rate WHERE col_company_Id = ?");
                                    $stmt->bind_param("i", $_SESSION['usr_compId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . htmlspecialchars($row['col_special_Id']) . "'>" . htmlspecialchars($row['col_name']) . "</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <p class="card-text" style="font-size: 16px;">Mileage</p>
                                <input type="text" name="txtTeamMileage" class="form-control" required value="0.25" id="">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" name="btnTeamPayRate" type="submit">Save rate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>