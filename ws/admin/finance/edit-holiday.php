<?php
include('header-contents.php');
if (isset($_GET['col_special_Id'])) {
    $varHolidayId = $_GET['col_special_Id'];
}
$sql_holiday_rate = mysqli_query($conn, "SELECT * FROM `tbl_holiday` WHERE (col_special_Id = '$varHolidayId' AND `col_company_Id` = '" . $_SESSION['usr_compId'] . "') ");
$row_holiday_rate = mysqli_fetch_array($sql_holiday_rate, MYSQLI_ASSOC);
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
                            <h4 class="m-b-10">
                                Holiday<br>
                                <small>Edit holiday rate</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <hr>
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-xl-1 col-md-1"></div>
            <div class="col-xl-4 col-md-4">
                <div class="form-cover" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding:25px 15px 25px 15px; border-radius:12px;">
                    <form action="./edit-holiday" method="post" enctype="multipart/form-data" autocomplete="off" name="formData">
                        <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                            Holiday already exist!!!
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description<span style="color: red;">*</span></label>
                                    <input type="text" name="txtone" value="<?php echo "" . $row_holiday_rate['col_description'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date<span style="color: red;">*</span></label>
                                    <input type="text" name="txttwo" value="<?php echo "" . $row_holiday_rate['col_holiday_date'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputPassword1">Holiday rate<span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                    </div>
                                    <input type="text" name="txtthree" value="<?php echo "" . $row_holiday_rate['col_pay_multiplier'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <label for="exampleInputPassword1">Charge multiplier<span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">£</div>
                                    </div>
                                    <input type="text" name="txtfour" value="<?php echo "" . $row_holiday_rate['col_charge_multiplier'] . ""; ?>" required class="form-control" id="exampleInputPassword1" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <input type="hidden" value="<?php echo "" . $_SESSION['usr_compId'] . "" ?>" name="myCompanyId" />
                            <input type="hidden" value="<?php echo $varHolidayId; ?>" name="txtHolidayId" />
                            <div class="form-group">
                                <input type="submit" name="btnUpdateHolidayRate" class="btn btn-small btn-info" value="Update data" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 col-md-3"></div>
            <div class="col-xl-4 col-md-4"></div>
        </div>



        <div style="margin-top: 200px;"></div>


    </div>
</div>

<?php include('footer-contents.php'); ?>