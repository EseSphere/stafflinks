<?php include('team-header-contents.php'); ?>

<style>
    #fileBtn {
        background-color: indigo;
        color: white;
        padding: 0.5rem;
        font-family: sans-serif;
        border-radius: 0.3rem;
        cursor: pointer;
        margin-top: 1rem;
    }
</style>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-1"></div>
            <div class="col-md-4 col-xl-8">
                <h5>Add certificate</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Certificate already exist
                        </div>

                        <?php
                        if (isset($_GET['uryyTteamoeSS4'])) {
                            $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                            $result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ");
                            while ($row = mysqli_fetch_array($result)) { ?>

                                <form action="./add-carer-certificates<?php echo "?uryyTteamoeSS4=" . $row['uryyTteamoeSS4'] . " "; ?>" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                                    <input type="hidden" value="<?php echo "" . $row['uryyTteamoeSS4'] . " "; ?>" name="txtCarerId" />
                            <?php
                            }
                        }
                            ?>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Certificate name">Cert name</label>
                                        <select style="height: 50px; font-size:19px;" type="text" placeholder="Certificate name" required name="txtAddNewCertName" class="form-control">
                                            <option value="Null">--Select certificate--</option>
                                            <option value="First Aid">First Aid</option>
                                            <option value="The-Care-Certificate-Template-PDF">The-Care-Certificate-Template-PDF</option>
                                            <option value="Moving and Handling">Moving and Handling</option>
                                            <option value="Hoisting">Hoisting</option>
                                            <option value="Health and safety">Health and safety</option>
                                            <option value="Bed bathing">Bed bathing</option>
                                            <option value="Emptying, changing of catheter and stomach bag">Emptying, changing of catheter and stomach bag</option>
                                            <option value="Changing of pads">Changing of pads</option>
                                            <option value="Clinical waste">Clinical waste</option>
                                            <option value="Infection control">Infection control</option>
                                            <option value="Communication">Communication</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Add new run">Date expire</label>
                                        <input type="date" id="start" min="2022-01-01" required name="txtDateExpire" class="form-control" />
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $currentDate; ?>" name="txtDateUploaded" />
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input name="file" class="form-control" type="file" id="actual-btn" hidden />
                                        <!--our custom file upload button-->
                                        <label id="fileBtn" for="actual-btn">Choose File</label>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary" name="btnAddCerts" type="submit">Add Certs</button>
                            <a href="./carer-skills-certs" style="text-decoration: none;" class="btn btn-danger">Cancel</a>


                                </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>