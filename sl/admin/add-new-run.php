<?php include('header-contents.php');
include('processing-add-new-run.php'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-5 col-xl-5">
                <h5>Create new run</h5>
                <p style="font-size: 16px;">Add new run for allocation.</p>
                <hr>
                <div class="card" style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
                    <div class="card-body" style="font-size: 16px;">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Run name already exist!!!
                        </div>
                        <form action="./add-new-run" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <div class="form-group">
                                <label for="Add new run">Run name</label>
                                <textarea rows="4" style="resize: none;" type="text" placeholder="Enter run name" required name="txtAddNewRun" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Add new run">Office In-charge</label>
                                <select name="txtCityInCharge" required class="form-control" id="exampleFormControlSelect1">
                                    <option value="---" selected="selected" disabled="disabled">--Select Option--</option>
                                    <?php
                                    $compId = mysqli_real_escape_string($conn, $_SESSION['usr_compId']);
                                    $query = "SELECT * FROM tbl_general_client_form WHERE col_company_Id = '$compId' GROUP BY col_Office_Incharge";
                                    $result = mysqli_query($conn, $query);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . htmlspecialchars($row['col_Office_Incharge']) . "'>"
                                                . htmlspecialchars($row['col_Office_Incharge']) . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No data found</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type=" button" onclick="history.back();" class="btn btn-danger">Go back</button>
                                <button class="btn btn-primary" name="btnAddNewRun" type="submit">Add Run</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-xl-5 mt-5">
                <h4 class="mt-5"><strong>Add New Run</strong></h4>
                This page allows you to create a new run for your clients quickly and efficiently. Each run represents a set of visits that need to be scheduled for service users.
                <br><br>
                Once a run is created, you can add service user visits to it. Make sure to include all the required visits so that the run is complete and ready for allocation.
                <br><br>
                After all visits are added, the run will be fully prepared for scheduling and assignment. This ensures smooth operations and accurate allocation for your team.
            </div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>