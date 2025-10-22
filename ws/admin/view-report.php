<?php
include('client-header-contents.php');
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $sql_sel_report = "SELECT * FROM tbl_raise_concern WHERE (userId = '$userId' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "')";
    $result = $conn->query($sql_sel_report);
    $row = $result->fetch_assoc();
    $varClientName = $row['col_client_name'];
    $varTeamName = $row['col_team_name'];
    $varTitle = $row['col_title'];
    $varNote = $row['col_note'];
    $varImage = $row['col_image'];
    $varDateSubmited = date('d M, Y', strtotime("" . $row['dateTime'] . ""));
}
?>


<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-2"></div>
            <div class="col-md-4 col-xl-6">
                <h5><strong>View <?php print $varClientName; ?> report</strong></h5>
                <hr>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-body" style="font-size: 16px;background-color: rgba(189, 195, 199,.2);">
                                <p class="card-text" style="font-size: 16px;">
                                    <span onclick="history.back();" style="font-size:25px; background-color:rgba(189, 195, 199,.1); cursor:pointer; padding:2px 8px 2px 8px;">&larr; </span> &nbsp;
                                    <span style="font-size:19px;">Full details</span>
                                </p>
                                <div class="alert" role="alert">
                                    <h5 class="alert-heading"><?php print $varTitle; ?></h5>
                                    <p style="font-size:16px;"><?php print $varNote; ?></p>
                                    <hr>
                                    <p class="mb-0"><img src="../../../uploads/<?php print $varImage; ?>" style="width:100%; height:400px;" alt="Report Image"></p>
                                    <p class="m-2" style="font-size:16px;"><span><i class="fa fa-user"></i> <?php print $varTeamName; ?></span> <span style="float: right;"><i class="fa fa-calendar"></i> <?php print $varDateSubmited; ?></span></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>

    </div>
</div>

<?php include('footer-contents.php'); ?>