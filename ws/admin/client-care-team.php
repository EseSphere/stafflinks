<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
    $result = mysqli_query($conn, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4'");
    while ($row = mysqli_fetch_array($result)) {
?>

        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Care team</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!"><?php echo "" . $row['client_first_name'] . " " . $row['client_last_name'] . "";
                                                                            }
                                                                        } ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">





                    <!-- prject ,team member start -->
                    <div class="col-xl-12 col-md-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Team</h5>
                                <div class="card-header-right">

                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date of birth</th>
                                                <th>Nationality</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th class="text-left">Current city</th>
                                                <th>Decision </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form ORDER BY userId DESC ");
                                            while ($trans = mysqli_fetch_array($result)) {
                                                echo "

                                    <tr>
                                        <td>
                                           
                                            <div class='d-inline-block align-middle'>
                                                <img src='assets/images/profile/profile-icon.jpg' alt='user image' class='img-radius wid-40 align-top m-r-15'>
                                                <div class='d-inline-block'>
                                                    <h6> " . $trans['team_first_name'] . "  " . $trans['team_last_name'] . "</h6>
                                                    <p class='m-b-0' style='color:white; padding:3px 10px 3px 10px; border-radius:50px; background-color:" . $trans['team_status'] . "</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>" . $trans['team_date_of_birth'] . "</td>
                                        <td>" . $trans['team_nationality'] . "</td>
                                        <td>" . $trans['team_primary_phone'] . "</td>
                                        <td>" . $trans['team_sexuality'] . " </td>
                                        <td>" . $trans['team_city'] . "</td>
                                        <td>
                                        <a target='_blank' href='./team-details?uryyTteamoeSS4=" . $trans['uryyTteamoeSS4'] . "'><button type='button' class='btn btn-info btn-sm'><i class='feather mr-2 icon-eye'></i> View</button></a>
                                        </td>

                                    </tr>
                                    ";
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php include('bottom-panel-block.php'); ?>


                </div>
                <!-- Latest Customers end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
        </div>


        <?php include('footer-contents.php'); ?>