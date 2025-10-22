<?php include('header-contents.php'); ?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ delete box ] start -->
        <div class="row">
            <div class="col-md-4 col-xl-1"></div>
            <div class="col-md-4 col-xl-8">
                <h5>Edit run</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Run name already exist!!!
                        </div>
                        <form action="./processing-update-new-run" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Add new run">New run name</label>
                                        <input style="height: 50px; font-size:19px;" type="text" placeholder="Enter new run name" required name="txtAddNewRun" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Add new run">Select run town</label>
                                        <select name="txtrunTown" required class="form-control" id="exampleFormControlSelect1">
                                            <option value="---" selected="selected" disabled="disabled">--Select Option--</option>
                                            <?php
                                            include('dbconnect.php');
                                            //change this line in your query as well
                                            $result = mysqli_query($myConnection, "SELECT * FROM tbl_group_list ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "
                                                    <option value='" . $row['group_area'] . "'>" . $row['group_area'] . "</option>
                                                ";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php
                                for ($a = 1; $a <= 50; $a++) {
                                    $usdd = "NR";
                                    $rand = rand(0000, 9999);
                                    $ud = "45";
                                    $id = "$usdd$rand$ud";
                                }

                                ?> <input type="hidden" value="<?php echo $id; ?>" name="NewRunId" />
                                <?php
                                if (isset($_GET['run_ids'])) {
                                    $run_ids = $_GET['run_ids'];
                                ?>
                                    <input type="hidden" value="<?php echo $run_ids;
                                                            } ?>" name="txtCompId">
                            </div>

                            <button class="btn btn-primary" name="btnAddNewRun" type="submit">Change Run</button>
                            <a href="./manage-runs" style="text-decoration: none;" class="btn btn-danger">Cancel</a>
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