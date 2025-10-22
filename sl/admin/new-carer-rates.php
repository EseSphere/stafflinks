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
                <h5>Rate
                    <br>
                    <small>Add new carer rate.</small>
                </h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Rate already exist
                        </div>

                        <?php
                        if (isset($_GET['uryyTteamoeSS4'])) {
                            $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                            $result = mysqli_query($conn, "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4='$uryyTteamoeSS4' ");
                            while ($row = mysqli_fetch_array($result)) { ?>

                                <form action="./processing-carer-pay-rate" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">

                                    <input type="hidden" value="<?php echo "" . $row['uryyTteamoeSS4'] . " "; ?>" name="txtCarerId" />
                            <?php
                            }
                        }
                            ?>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Pay rate">Pay rates</label>
                                        <select style="height: 50px; font-size:19px;" type="text" placeholder="Certificate name" required name="txtPayRate" class="form-control">
                                            <option value="Null">--Select pay rate--</option>

                                            <?php
                                            include('dbconnections.php');
                                            //change this line in your query as well
                                            $result = mysqli_query($conn, "SELECT * FROM tbl_pay_rate WHERE col_company_Id ='" . $_SESSION['usr_compId'] . "' ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "
                                                    <option value='" . $row['col_rates'] . "'>" . $row['col_name'] . "</option>
                                                ";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Add new run">Travel type</label>
                                        <select style="height: 50px; font-size:19px;" type="text" placeholder="Certificate name" required name="txtAddTravelRate" class="form-control">
                                            <option value="Null">--Select travel rate--</option>
                                            <option value="N/A">N/A</option>
                                            <option value="Mileage">Mileage</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary" name="btnAddNewPay" type="submit">Update pay rate</button>
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