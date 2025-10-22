<?php include('client-header-contents.php'); ?>



<?php
include('dbconnect.php');

if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
    //change this line in your query as well
    $result = mysqli_query($myConnection, "SELECT * FROM tbl_general_client_form WHERE uryyToeSS4='$uryyToeSS4'");
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
                                    <h5 class="m-b-10">Add medication(s)</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!"><?php echo "" . $row['client_first_name'] . " " . $row['client_last_name'] . "" ?></a></li>
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
                                <h5>Create a schedule to match Annie's prescription.</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                        <div class="row">
                                            <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                                Client medicine already exist!!!
                                            </div>
                                            <div class="col-md-5">


                                                <form method="POST" action="./client-medication?uryyToeSS4=<?php echo "" . $row['uryyToeSS4'] . ""; ?>" enctype="multipart/form-data" name="addClient-form" autocomplete="off">

                                                    <div class="form-group">

                                                        <input type="hidden" name="txtClientSocialId" value="<?php echo "" . $row['uryyToeSS4'] . "";
                                                                                                            }
                                                                                                        } ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Select Medicine<span style="color: red;">*</span></label>
                                                        <select name="txtMedName" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <?php
                                                            include('dbconnect.php');

                                                            //change this line in your query as well
                                                            $result = mysqli_query($myConnection, "SELECT * FROM tbl_medication_list ");
                                                            while ($trans = mysqli_fetch_array($result)) {
                                                                echo "
                                                    <option value='" . $trans['med_name'] . "'>" . $trans['med_name'] . "</option>
                                                    ";
                                                            } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-7 col-7">
                                                                <label for="exampleInputPassword1">Select dosage<span style="color: red;">*</span></label>
                                                                <select name="txtMedDosage" required class="form-control" id="exampleFormControlSelect1">
                                                                    <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                                    <?php
                                                                    include('dbconnect.php');

                                                                    //change this line in your query as well
                                                                    $result = mysqli_query($myConnection, "SELECT * FROM tbl_medication_list ");
                                                                    while ($trans = mysqli_fetch_array($result)) {
                                                                        echo "
                                                                <option value='" . $trans['med_dosage'] . "'>" . $trans['med_dosage'] . "</option>
                                                    ";
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-5 col-5">
                                                                <label for="exampleInputPassword1">Select type<span style="color: red;">*</span></label>
                                                                <select name="txtMedType" required class="form-control" id="exampleFormControlSelect1">
                                                                    <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                                    <?php
                                                                    include('dbconnect.php');

                                                                    //change this line in your query as well
                                                                    $result = mysqli_query($myConnection, "SELECT * FROM tbl_medication_list ");
                                                                    while ($trans = mysqli_fetch_array($result)) {
                                                                        echo "
                                                                <option value='" . $trans['med_type'] . "'>" . $trans['med_type'] . "</option>
                                                    ";
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Frequency<span style="color: red;">*</span></label>
                                                        <select name="txtMedFrequency" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value='1'>1</option>
                                                            <option value='2X'>2X</option>
                                                            <option value='3X'>3X</option>
                                                            <option value='4X'>4X</option>
                                                            <option value='5X'>5X</option>
                                                            <option value='6X'>6X</option>
                                                            <option value='1 Daily'>1 Daily</option>
                                                            <option value='2X Daily'>2X Daily</option>
                                                            <option value='3X Daily'>3X Daily</option>
                                                            <option value='4X Daily'>4X Daily</option>
                                                            <option value='5X Daily'>5X Daily</option>
                                                            <option value='6X Daily'>6X Daily</option>
                                                            <option value='1 Tablet Daily'>1 Tablet Daily</option>
                                                            <option value='2 Tablets Daily'>2 Tablets Daily</option>
                                                            <option value='3 Tablets Daily'>3 Tablets Daily</option>
                                                            <option value='4 Tablets Daily'>4 Tablets Daily</option>
                                                            <option value='5 Tablets Daily'>5 Tablets Daily</option>
                                                            <option value='6 Tablets Daily'>6 Tablets Daily</option>

                                                        </select>
                                                    </div>



                                                    <hr>


                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Additional information</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#" role="tab" aria-controls="home" aria-selected="true">Closed</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Open</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                        <p class="mb-0">
                                                                            Click on open to view additional info
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                                    <div class="daysAlignment" style="width: 100%; height:auto; padding:12px 0px 0px 20px;">
                                                                        <p class="mb-0">
                                                                            Dose form
                                                                            <br>
                                                                            medicine
                                                                            <br>
                                                                            Manufacturer
                                                                            <br>
                                                                            —
                                                                            <br>
                                                                            Intended routes of administration
                                                                            <br>
                                                                            Oral
                                                                            <br>
                                                                            Regulatory
                                                                            <br>
                                                                            <a href="https://www.gov.uk/government/publications/controlled-drugs-list--2" target="_blank">
                                                                                HM Government — No Controlled Drug Status
                                                                            </a>
                                                                            <br>
                                                                            This information is taken from dm+d and should be cross-referenced with other sources.
                                                                        </p>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">What support is required with this medicine?<span style="color: red;">*</span></label>
                                                        <select name="txtMedicineSupport" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="Administer">Administer</option>
                                                            <option value="Assist">Assist</option>
                                                            <option value="Prompt">Prompt</option>
                                                        </select>
                                                        <br>
                                                        <span>If you're unsure, we recommend reading the <a href="https://www.cqc.org.uk/guidance-providers/adult-social-care/administering-medicines-home-care-agencies" target="_blank">CQC's guidance </a>on medicines support.
                                                        </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">What type of medicine?<span style="color: red;">*</span></label>
                                                        <select name="txtMedPackage" required class="form-control" id="exampleFormControlSelect1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="Scheduled">Scheduled</option>
                                                            <option value="PRN">PRN</option>

                                                        </select>



                                                    </div>



                                                    <div class="form-group">
                                                        <h5>Add details(optional)</h5>
                                                        <label for="exampleFormControlTextarea1">The carer will see this note in the app each time they complete this task.</label>
                                                        <textarea name="txtMedkDetails" class="form-control" placeholder="Highlights" required id="exampleFormControlHighlights" rows="5"></textarea>
                                                    </div>



                                                    <div class="form-grou">
                                                        <input type="hidden" value="<?php
                                                                                    $currentDate = date('F j, Y');
                                                                                    echo $currentDate; ?>" name="current_Date">

                                                        <input type="hidden" value="<?php echo date("h:i a"); ?>" name="current_Time">
                                                    </div>



                                                    <button type="submit" name="btnSubmitClientMedicine" class="btn  btn-primary">Upload medicine</button>




                                                </form>
                                            </div>

                                            <div class="col-md-7">



                                                <h4>Medicine</h4>
                                                <a style="text-decoration: none;" href="./help-and-support">
                                                    <button type="button" class="btn btn-outline-info"><i class="feather mr-2 icon-help-circle"></i>Help and support</button>
                                                </a>
                                                <a style="text-decoration: none;" href="./view-marchart">
                                                    <button type="button" class="btn btn-outline-primary"><i class="feather mr-2 icon-eye"></i>View MAR chart</button>
                                                </a>
                                                <br> <br>


                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>My medicine record</h5>
                                                        <div class="card-header-right">
                                                            <div class="btn-group card-option">
                                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="feather icon-more-horizontal"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Medicine</th>
                                                                        <th>Support</th>
                                                                        <th>Package</th>
                                                                        <th>Frequency</th>
                                                                        <th class="text-right">Option</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    include('dbconnect.php');

                                                                    if (isset($_GET['uryyToeSS4'])) {
                                                                        $uryyToeSS4 = $_GET['uryyToeSS4'];
                                                                        //change this line in your query as well
                                                                        $result = mysqli_query($myConnection, "SELECT * FROM tbl_clients_medication_records WHERE uryyToeSS4='$uryyToeSS4' ");
                                                                        while ($row = mysqli_fetch_array($result)) {
                                                                            echo "
                                                                    <tr>
                                                                        <td>
                                                                            <div class='d-inline-block align-middle'>
                                                                                <div class='d-inline-block'>
                                                                                    <h6>" . $row['med_name'] . " " . $row['med_dosage'] . " " . $row['med_type'] . " </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            " . $row['med_support_required'] . "
                                                                        </td>
                                                                        <td>" . $row['med_package'] . "</td>
                                                                        <td>" . $row['med_frequency'] . "</td>
                                                                        <td class='text-right'>
                                                                            <a style='text-decoration:none;' href='./edit-client-medication?med_Id=" . $row['med_Id'] . "'> <button title='Edit client medicine' type='button' class='btn btn-primary btn-sm'>Edit</button> </a>
                                                                            <a style='text-decoration:none;' href='./delete-client-medication?med_Id=" . $row['med_Id'] . "'> <button title='Delete client medicine' type='button' class='btn btn-danger btn-sm'>Delete</button> </a>
                                                                        </td>
                                                                    </tr>
                                                                    ";
                                                                        }
                                                                    } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
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