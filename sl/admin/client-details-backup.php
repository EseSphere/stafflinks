<?php include('client-header-contents.php'); ?>


<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->

        <?php
        if (isset($_GET['uryyToeSS4'])) {
            $uryyToeSS4 = $_GET['uryyToeSS4'];
            $result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
            while ($row = mysqli_fetch_array($result)) { ?>


                <div class="row">
                    <!-- table card-1 start -->
                    <section style="background-color: #eee; margin-bottom:50px;">
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-6 mb-4">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">User</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                        </ol>

                                        <div style="width: 100%; height:auto; padding:7px; text-align:right; background-color:none;">
                                            <a href="./care-plan/client-next-of-kin?<?php echo "uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; color:#000;">
                                                <button class="btn btn-primary btn-sm">Next of kin</button>
                                            </a>
                                            <a href="./care-plan/unique-identifier-5665470-488857-49857i859o-884747?<?php echo "uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; color:#000;">
                                                <button class="btn btn-info btn-sm">Unique identifier</button>
                                            </a>
                                            <a href="./care-plan/client-medical-form?<?php echo "uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; color:#000;">
                                                <button class="btn btn-danger btn-sm">Medical Details</button>
                                            </a>
                                        </div>
                                    </nav>
                                </div>
                            </div>

                            <div class="row" style="font-size: 18px;">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <!--<a href="./profile-setup<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none;">
                                            <button class="btn btn-xs btn-info">Edit</button>
                                        </a>-->
                                        <div class="card-body text-center">

                                            <img src="assets/images/user/profile-icon.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 120px;">
                                            <h5 class="my-3"><?php echo "" . $row['client_first_name'] . "&nbsp;" . $row['client_last_name'] . "" ?></h5>
                                            <p style="font-size: 16px;" class="text-muted mb-1"><?php echo "" . $row['client_sexuality'] . " | " . $row['client_area'] . "," ?></p>
                                            <p style="font-size: 16px;" class="text-muted mb-4"><?php echo "" . $row['client_city'] . ", " . $row['client_county'] . "" ?></p>
                                            <div class="d-flex justify-content-center mb-2">
                                                <a href="./client-status<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style=" text-decoration: none;">
                                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Client status</button>
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="./delete-client-details<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "";
                                                                            }
                                                                        } ?>" style=" text-decoration: none;">

                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card mb-4 mb-lg-0">
                                        <div class="card-body p-0" style="font-size: 18px;">
                                            <h5 style="padding: 22px;">Care calls</h5>
                                            <?php
                                            if (isset($_GET['uryyToeSS4'])) {
                                                $uryyToeSS4 = $_GET['uryyToeSS4'];
                                            }
                                            ?>
                                            <a href="./setup-visits<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none;">
                                                <button class="btn btn-xs btn-info">Plan visits</button>
                                            </a>

                                            <div style="width: 100%; height:auto; margin-top:12px; padding:12px; border-top:2px solid rgba(39, 174, 96,1.0); ">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td style="font-size:15px; font-weight:600;">Care call</td>
                                                        <td style="font-size:15px; font-weight:600;">Time</td>
                                                        <td style="font-size:15px; font-weight:600;"><i class="feather icon-edit"></i> Extra call</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bath fa-lg text-warning" aria-hidden='true'></i>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $result = mysqli_query($conn, "SELECT * FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Morning' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                                <a href="./morning-care-calls<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style=" text-decoration: none; color:#000;">
                                                                    <p style="font-size: 16px;" class="mb-0"><?php echo "" . $row['dateTime_in'] . " - " . $row['dateTime_out'] . "";
                                                                                                            } ?>
                                                                    </p>
                                                                </a>
                                                        </td>
                                                        <td style="font-size:16px; font-weight:600;">
                                                            <?php
                                                            $select_extmorning = mysqli_query($conn, "SELECT dateTime_in, dateTime_out FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Extra morning call' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY userId DESC LIMIT 1");
                                                            $row_extmorning = mysqli_fetch_array($select_extmorning);
                                                            $countRes = mysqli_num_rows($select_extmorning);
                                                            $dateTimein = $row_extmorning['dateTime_in'];
                                                            $dateTimeOut = $row_extmorning['dateTime_out'];

                                                            if ($countRes != 0) {
                                                                echo "
                                                                <a href='./extra-care-call1-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>" .
                                                                    $dateTimein . ' - ' . $dateTimeOut . "
                                                                </a>
                                                                ";
                                                            } else {
                                                                echo "
                                                                    <a href='./extra-care-call1-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>
                                                                        <i class='feather icon-plus'></i> Add
                                                                    </a>
                                                                ";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-medkit fa-lg" style="color: #333333;"></i>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $result = mysqli_query($conn,  "SELECT * FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Lunch' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                                <a href="./lunch-care-calls<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style=" text-decoration: none; color:#000;">
                                                                    <p style="font-size: 16px;" class="mb-0"><?php echo "" . $row['dateTime_in'] . " - " . $row['dateTime_out'] . "";
                                                                                                            } ?>
                                                                    </p>
                                                                </a>

                                                        </td>
                                                        <td style="font-size:16px; font-weight:600;">
                                                            <?php
                                                            $select_extLunch = mysqli_query($conn, "SELECT dateTime_in, dateTime_out FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Extra lunch call' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY userId DESC LIMIT 1");
                                                            $row_extlunch = mysqli_fetch_array($select_extLunch);
                                                            $countRes = mysqli_num_rows($select_extLunch);
                                                            $dateTimein = $row_extlunch['dateTime_in'];
                                                            $dateTimeOut = $row_extlunch['dateTime_out'];

                                                            if ($countRes != 0) {
                                                                echo "
                                                                <a href='./extra-care-call2-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>" .
                                                                    $dateTimein . ' - ' . $dateTimeOut . "
                                                                </a>
                                                                ";
                                                            } else {
                                                                echo "
                                                                    <a href='./extra-care-call2-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>
                                                                        <i class='feather icon-plus'></i> Add
                                                                    </a>
                                                                ";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-coffee fa-lg" style="color: #55acee;"></i>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $result = mysqli_query($conn, "SELECT * FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Tea' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                                <a href="./tea-care-calls<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style=" text-decoration: none; color:#000;">
                                                                    <p style="font-size: 16px;" class="mb-0"><?php echo "" . $row['dateTime_in'] . " - " . $row['dateTime_out'] . "";
                                                                                                            } ?></p>
                                                                </a>
                                                        </td>
                                                        <td style="font-size:16px; font-weight:600;">
                                                            <?php
                                                            $select_extTea = mysqli_query($conn, "SELECT dateTime_in, dateTime_out FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Extra tea call' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY userId DESC LIMIT 1");
                                                            $row_exttea = mysqli_fetch_array($select_extTea);
                                                            $countRes = mysqli_num_rows($select_extTea);
                                                            $dateTimein = $row_exttea['dateTime_in'];
                                                            $dateTimeOut = $row_exttea['dateTime_out'];

                                                            if ($countRes != 0) {
                                                                echo "
                                                                <a href='./extra-care-call3-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>" .
                                                                    $dateTimein . ' - ' . $dateTimeOut . "
                                                                </a>
                                                                ";
                                                            } else {
                                                                echo "
                                                                    <a href='./extra-care-call3-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>
                                                                        <i class='feather icon-plus'></i> Add
                                                                    </a>
                                                                ";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bed fa-lg" style="color: #ac2bac;"></i>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $result = mysqli_query($conn, "SELECT * FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Bed' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                                <a href="./bed-care-calls<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style=" text-decoration: none; color:#000;">
                                                                    <p style="font-size: 16px;" class="mb-0"><?php echo "" . $row['dateTime_in'] . " - " . $row['dateTime_out'] . "";
                                                                                                            } ?></p>
                                                                </a>
                                                        </td>
                                                        <td style="font-size:16px; font-weight:600;">
                                                            <?php
                                                            $select_extBed = mysqli_query($conn, "SELECT dateTime_in, dateTime_out FROM tbl_clienttime_calls WHERE uryyToeSS4='$uryyToeSS4' AND care_calls = 'Extra bed call' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ORDER BY userId DESC LIMIT 1");
                                                            $row_extbed = mysqli_fetch_array($select_extBed);
                                                            $countRes = mysqli_num_rows($select_extBed);
                                                            $dateTimein = $row_extbed['dateTime_in'];
                                                            $dateTimeOut = $row_extbed['dateTime_out'];

                                                            if ($countRes != 0) {
                                                                echo "
                                                                <a href='./extra-care-call4-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>" .
                                                                    $dateTimein . ' - ' . $dateTimeOut . "
                                                                </a>
                                                                ";
                                                            } else {
                                                                echo "
                                                                    <a href='./extra-care-call4-46657-587768-0059876?uryyToeSS4=$uryyToeSS4' style='text-decoration: none; color:rgba(44, 62, 80,.4);'>
                                                                        <i class='feather icon-plus'></i> Add
                                                                    </a>
                                                                ";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                    while ($row = mysqli_fetch_array($result)) {
                                        $clientDOB = date('d M, Y', strtotime("" . $row['client_date_of_birth'] . ""));
                                        $clientStartDate = date('d M, Y', strtotime("" . $row['clientStart_date'] . ""));
                                    ?>

                                </div>
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div style="width: 100%; height:auto; text-align:right;">
                                            <a href="./edit-client-details-220059-958847-488950<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none;">
                                                <button class="btn btn-xs btn-info">Edit</button>
                                            </a>
                                        </div>
                                        <div class="card-body" style="font-size: 16px;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0">Full Name</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_title'] . " " . $row['client_middle_name'] . " | <span>Prefered name: </span> " . $row['client_preferred_name'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0">Email</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_email_address'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0">Phone</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "+44 " . $row['client_primary_phone'] . " &nbsp; | &nbsp; +44 " . $row['col_second_phone'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0">Date of birth</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo $clientDOB ?> &nbsp; | &nbsp; <span style="">UI Number <strong><?php echo "" . $row['col_swn_number'] . "" ?></strong></span></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p style="font-size: 16px;" class="mb-0">Address</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <a href="https://www.google.fr/maps/place/<?php echo " " . $row['client_poster_code'] . ""; ?>">
                                                        <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_address_line_1'] . " " . $row['client_address_line_2'] . ", " . $row['client_city'] . ", " . $row['client_county'] . ", " . $row['client_poster_code'] . "" ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-4">
                                                <div style="width: 100%; height:auto; text-align:right;">
                                                    <a href="./edit-client-details-220059-958847-4854550<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none;">
                                                        <button class="btn btn-xs btn-info">Edit</button>
                                                    </a>
                                                </div>
                                                <div class="card-body" style="font-size: 16px;">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p style="font-size: 16px;" class="mb-0">Referred to</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_referred_to'] . "" ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p style="font-size: 16px;" class="mb-0">Ailment</p>
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_ailment'] . "" ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p style="font-size: 16px;" class="mb-0">Religion</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_culture_religion'] . "" ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p style="font-size: 16px;" class="mb-0">Gender</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_sexuality'] . "" ?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card mb-4">
                                                <div style="width: 100%; height:auto; text-align:right;">
                                                    <a href="./edit-client-details-220059-958847-4854550<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none;">
                                                        <button class="btn btn-xs btn-info">Edit</button>
                                                    </a>
                                                </div>
                                                <div class="card-body" style="font-size: 16px;">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p style="font-size: 16px;" class="mb-0">Access Key</p>
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_access_details'] . "" ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p style="font-size: 16px;" class="mb-0">Status</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class=" mb-0" style='font-size:15px; color:white; padding:3px 0px 3px 10px; border-radius:50px; background-color:<?php echo "" . $row['ClientStatuscolors'] . "" ?>;'><?php echo "" . $row['client_status'] . "" ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class=" row">
                                                        <div class="col-sm-5">
                                                            <p style="font-size: 16px;" class="mb-0">Start date</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo $clientStartDate; ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p style="font-size: 16px;" class="mb-0">End date</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['clientEnd_date'] . "" ?></p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p style="font-size: 16px;" class="mb-0">Group</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_area'] . "";
                                                                                                            } ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-4">
                                <div class="card-body" style="font-size: 16px;">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div style="width: 100%; height:auto; padding:22px; text-align:center;">
                                                <h3>About Me</h3>
                                            </div>
                                            <?php
                                            if (isset($_GET['uryyToeSS4'])) {
                                                $uryyToeSS4 = $_GET['uryyToeSS4'];
                                                $result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4' AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
                                                while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                    <div class="card mb-4">
                                                        <div class="card-body" style="font-size: 16px;">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>Highlights</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['client_highlights'] . "" ?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>What is important to me</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/what-is-important-to-me<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['what_is_important_to_me'] . "" ?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>My likes and dislikes</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/my-likes-and-dislikes<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['my_likes_and_dislikes'] . "" ?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>My current condition</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/my-current-condition<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['my_current_condition'] . "" ?></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>My medical history</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/my-medical-history<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['my_medical_history'] . "" ?></p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>My physical health</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/my-physical-health<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['my_physical_health'] . "" ?></p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>My mental health</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/my-mental-health<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['my_mental_health'] . "" ?></p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>How i communicate</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/how-i-communicate<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['how_i_communicate'] . "" ?></p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p style="font-size: 16px;" class="mb-0"><strong>Assistive equipment is use.</strong></p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <a href="./care-plan/assistive-equipment-is-use<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>" style="text-decoration: none; position:absolute; right:50px;">
                                                                        <button class="btn btn-sm btn-info">Add note</button>
                                                                    </a>
                                                                    <br>
                                                                    <hr style="background-color: rgba(189, 195, 199,.6);">
                                                                    <p style="font-size: 16px;" class="text-muted mb-0"><?php echo "" . $row['assistive_equipment_i_use'] . "";
                                                                                                                    }
                                                                                                                } ?></p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br><br>
                    </section>


                    <?php include('bottom-panel-block.php'); ?>


                </div>
                <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>