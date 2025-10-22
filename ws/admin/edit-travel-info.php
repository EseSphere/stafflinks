<?php

include('team-header-contents.php');

if (isset($_POST['btnUpdateTravelInfo'])) {

    $txtTeamId = mysqli_real_escape_string($conn, $_REQUEST['txtTeamId']);
    $txtFirstName = mysqli_real_escape_string($conn, $_REQUEST['txtFirstName']);
    $txtlastName = mysqli_real_escape_string($conn, $_REQUEST['txtlastName']);
    $txtHouseNo = mysqli_real_escape_string($conn, $_REQUEST['txtHouseNo']);
    $txtStreetName = mysqli_real_escape_string($conn, $_REQUEST['txtStreetName']);
    $txtCity = mysqli_real_escape_string($conn, $_REQUEST['txtCity']);
    $txtCounty = mysqli_real_escape_string($conn, $_REQUEST['txtCounty']);
    $txtPostalCode = mysqli_real_escape_string($conn, $_REQUEST['txtPostalCode']);
    $txtCountry = mysqli_real_escape_string($conn, $_REQUEST['txtCountry']);
    $txtTransportation = mysqli_real_escape_string($conn, $_REQUEST['txtTransportation']);

    $insert_queryIns = mysqli_query($conn, "UPDATE tbl_general_team_form SET `team_first_name` = '$txtFirstName', `team_last_name` = '$txtlastName', 
    `team_address_line_1` = '$txtHouseNo', `team_address_line_2` = '$txtStreetName', `team_city` = '$txtCity', 
    `team_county` = '$txtCounty', `team_poster_code` = '$txtPostalCode', `team_country` = '$txtCountry', `transportation` = '$txtTransportation' WHERE uryyTteamoeSS4 = '$txtTeamId'");
    if ($insert_queryIns) {
        if ($lpa_file) {

            if ($insert_queryIns) {
                header("Location: ./carer-operations?uryyTteamoeSS4=$txtTeamId");

                unset($txtTeamId);
                unset($txtFirstName);
                unset($txtLastName);
                unset($txtHouseNo);
                unset($txtStreetName);
                unset($txtCity);
                unset($txtCounty);
                unset($txtPostalCode);
                unset($txtCountry);
                unset($txtTransportation);
            }
        } else {
            header("Location: ./carer-operations?uryyTteamoeSS4=$txtTeamId");
        }
    }
}
?>


<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }
</style>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Travel information</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="container">

            <div class="row">
                <div class="col-md-8">

                    <?php
                    //change this line in your query as well
                    if (isset($_GET['uryyTteamoeSS4'])) {
                        $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4']; ?>

                        <div style="width: 100%; height:auto; text-align:right;">
                            <a href="./carer-operations?<?php echo "uryyTteamoeSS4=$uryyTteamoeSS4"; ?>" style="text-decoration: none; color:#000;">
                                <button class="btn btn-info">View details</button>
                            </a>
                        </div>

                        <form action="./edit-travel-info?uryyTteamoeSS4=<?php echo $uryyTteamoeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                            <input type="hidden" value="<?php echo $uryyTteamoeSS4;
                                                    } ?>" name="txtTeamId" />

                            <?php
                            $sel_team_data_result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ");
                            while ($get_team_row = mysqli_fetch_array($sel_team_data_result)) {
                            ?>

                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="First name">First name</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_first_name'] . "" ?>" class="form-control" placeholder="First name" required name="txtFirstName" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="Last name">Last name</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_last_name'] . "" ?>" class="form-control" placeholder="Last name" required name="txtlastName" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="House number">House no</label>
                                            <input type="number" value="<?php echo "" . $get_team_row['team_address_line_1'] . "" ?>" class="form-control" placeholder="House no" required name="txtHouseNo" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Street name">Street name</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_address_line_2'] . "" ?>" class="form-control" placeholder="Street name" required name="txtStreetName" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputCity">City<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="<?php echo "" . $get_team_row['team_city'] . "" ?>" placeholder="City" required name="txtCity" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="County">County</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_county'] . "" ?>" class="form-control" placeholder="County" required name="txtCounty" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Postal code">Postal Code</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['team_poster_code'] . "" ?>" class="form-control" placeholder="Postal code" required name="txtPostalCode" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-6">
                                        <label for="exampleInputCountry">Country<span style="color: red;"></span></label>
                                        <input type="text" value="<?php echo "" . $get_team_row['team_country'] . "" ?>" class="form-control" value="" placeholder="City" required name="txtCountry" />
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="Transportation method">Transportation method</label>
                                            <input type="text" value="<?php echo "" . $get_team_row['transportation'] . "";
                                                                    } ?>" class="form-control" placeholder="Transportation method" required name="txtTransportation" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input style="height: 45px;" type="submit" value="Update details" class="btn btn-primary" name="btnUpdateTravelInfo" />
                                    </div>
                        </form>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <br>
        </div>
    </div>





</div>
<!-- Latest Customers end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>