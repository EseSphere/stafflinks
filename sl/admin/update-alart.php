<?php
include('dbconnections.php');
$sql_sel_report = "SELECT * FROM tbl_raise_concern WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "')";
$result = $conn->query($sql_sel_report);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    }
} else {
    echo "0 results";
}
?>
<div class="alert alert-primary alert-dismissible fade show fixed-top rounded-0" role="alert" id="dailyAlert">
    <strong>Important Update:</strong> We are pleased to inform you of recent updates aimed at enhancing your overall experience. Please explore the upgraded interface, new functionalities, and improved navigation.
    <br>
    Key Enhancements: Including the Client Module, Team Module, and eMarCharts. We highly value your feedback and encourage you to share your thoughts with us!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()"></button>
</div>