<?php
include('header-contents.php');
include('processing-add-client-form.php');
?>
<style>
    #exampleInputPassword1 {
        height: 50px;
    }
</style>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add New Client</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="./add-new-client" enctype="multipart/form-data" name="addClient-form" autocomplete="off">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Client Form - Kindly fill in the form correctly.</h5>
                        </div>
                        <div class="card-body p-0">
                            <div id="popupAlert" style="width: 100%; height:auto; margin-bottom:5px; padding:22px; background-color:rgba(192, 57, 43,1.0); color:white;">
                                Client details already exist!!!
                            </div>
                            <div class="table-responsive">
                                <div class="client-form-body" style="width:100%; height:auto; padding:22px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Title<sup style="color: red;">*</sup></label>
                                                <select name="txtTitle" required class="form-control" id="exampleInputPassword1">
                                                    <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Master.">Master.</option>
                                                    <option value="Miss.">Miss.</option>
                                                    <option value="Ms.">Ms.</option>
                                                    <option value="Sir.">Sir.</option>
                                                    <option value="Lady.">Lady.</option>
                                                    <option value="Lord.">Lord.</option>
                                                    <option value="Dame.">Dame.</option>
                                                    <option value="Doctor.">Doctor.</option>
                                                    <option value="Prof.">Prof.</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputPassword1">First name<sup style="color: red;">*</sup></label>
                                                        <input name="txtFirstName" required type="text" class="form-control" id="exampleInputPassword1" placeholder="First name">
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputPassword1">Last name<sup style="color: red;">*</sup></label>
                                                        <input name="txtLastName" required type="text" class="form-control" id="exampleInputPassword1" placeholder="Last name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-8 col-6">
                                                        <label for="exampleInputPassword1">Middle name</label>
                                                        <input name="txtMiddleName" type="text" class="form-control" id="exampleInputPassword1" placeholder="Middle name">
                                                    </div>
                                                    <div class="col-md-4 col-6">
                                                        <label for="exampleInputPassword1">Preferred name</label>
                                                        <input name="txtPreferredName" type="text" required class="form-control" id="exampleInputPassword1" placeholder="Preferred name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Email Address<span style="color: red;"></span></label>
                                                <input name="txtEmailAddress" type="email" class="form-control" id="exampleInputPassword1" placeholder="Email address">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5 col-6">
                                                        <label for="exampleFormControlSelect1">Prefers to be referred to as<sup style="color: red;">*</sup></label>
                                                        <select name="txtGenderBased" required class="form-control" id="exampleInputPassword1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="He/Him">He/Him</option>
                                                            <option value="She/Her">She/Her</option>
                                                            <option value="They/Them">They/Them</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-7 col-6">
                                                        <label for="exampleInputPassword1">Date of birth<sup style="color: red;">*</sup></label>
                                                        <input name="txtDateofBirth" min="1925-01-01" max="2002-12-31" required type="date" class="form-control" id="exampleInputPassword1" placeholder="Date of birth">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlClientailment">Medical condition!<sup style="color: red;">*</sup></label>
                                                <input name="txtClientailment" required type="text" class="form-control" id="exampleInputPassword1" placeholder="Describe client condition!">
                                            </div>
                                            <hr>
                                            <br>
                                            <h4>Contact details</h4>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Phone number<sup style="color: red;">*</sup></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                            <img src="assets/images/icons/united-kingdom-flag-png-xl.png" style="width: 20px; height:20px;" alt="">
                                                        </span>
                                                    </div>
                                                    <input type="tel" class="form-control" name="txtPrimaryPhoneNumber" placeholder="+44 (109) ***-****" maxlength="20" minlength="19" title="11 digits code" required />
                                                    <div class="invalid-tooltip"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputPassword1">Culture and Religion<sup style="color: red;">*</sup></label>
                                                        <select name="txtCultureReligion" required class="form-control" id="exampleInputPassword1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="African Traditional &amp; Diasporic">African Traditional &amp; Diasporic</option>
                                                            <option value="Agnostic">Agnostic</option>
                                                            <option value="Atheist">Atheist</option>
                                                            <option value="Baha'i">Baha'i</option>
                                                            <option value="Buddhism">Buddhism</option>
                                                            <option value="Cao Dai">Cao Dai</option>
                                                            <option value="Chinese traditional religion">Chinese traditional religion</option>
                                                            <option value="Christianity">Christianity</option>
                                                            <option value="Hinduism">Hinduism</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Jainism">Jainism</option>
                                                            <option value="Juche">Juche</option>
                                                            <option value="Judaism">Judaism</option>
                                                            <option value="Neo-Paganism">Neo-Paganism</option>
                                                            <option value="Nonreligious">Nonreligious</option>
                                                            <option value="Rastafarianism">Rastafarianism</option>
                                                            <option value="Secular">Secular</option>
                                                            <option value="Shinto">Shinto</option>
                                                            <option value="Sikhism">Sikhism</option>
                                                            <option value="Spiritism">Spiritism</option>
                                                            <option value="Tenrikyo">Tenrikyo</option>
                                                            <option value="Unitarian-Universalism">Unitarian-Universalism</option>
                                                            <option value="Zoroastrianism">Zoroastrianism</option>
                                                            <option value="primal-indigenous">primal-indigenous</option>
                                                            <option value="None">None</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputPassword1">Gender<sup style="color: red;">*</sup></label>
                                                        <select name="txtSexuality" required class="form-control" id="exampleInputPassword1">
                                                            <option value="" selected="selected" disabled="disabled">--Select Option--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Area<sup style="color: red;">*</sup></label>
                                                <select name="txtclientArea" required class="form-control" id="exampleInputPassword1">
                                                    <option value='Kidderminster' selected='selected'>Kidderminster</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Services<sup style="color: red;">*</sup></label>
                                                        <select name="txtCareServices" required class="form-control" id="exampleInputPassword1">
                                                            <option value="Domiciliary care" selected>Domiciliary care</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Address line 1(House no)<sup style="color: red;">*</sup></label>
                                                <input name="txtAddressLine1" readonly required type="text" class="form-control" id="exampleInputAddressLine1" value="111">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Address line 2(Street name)<sup style="color: red;">*</sup></label>
                                                <input name="txtAddressLine2" readonly required type="text" class="form-control" id="exampleInputAddressLine2" value="Sutton Rd">
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5 col-6">
                                                        <label for="exampleInputCity">City<sup style="color: red;">*</sup></label>
                                                        <select name="txtCity" required type="text" class="form-control" id="exampleInputPassword1" placeholder="City">
                                                            <optgroup label="England">England
                                                                <option value="Wolverhampton">Wolverhampton</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-7 col-6">
                                                        <label for="exampleInputCoounty1">County<sup style="color: red;">*</sup></label>
                                                        <select name="txtCounty" required type="text" class="form-control" id="exampleInputPassword1" placeholder="County">
                                                            <optgroup label="England">
                                                                <option value="West Midlands">West Midlands</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4 col-6">
                                                        <label for="exampleInputCity">Postal Code<sup style="color: red;">*</sup></label>
                                                        <input name="txtPostalCode" readonly required type="text" class="form-control" id="exampleInputPassword1" value="DY11 7BB">
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        <label for="exampleInputCoounty1">Country<sup style="color: red;">*</sup></label>
                                                        <select name="txtCountry" required id="exampleInputPassword1" class="form-control">
                                                            <option style="background: rgba(52, 152, 219,1.0); color:white;" value="United Kingdom">United Kingdom</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Access details<span style="color: red;"></span></label>
                                                <textarea name="txtAccessDetails" class="form-control" placeholder="Access details" id="exampleFormControlAccessdetails" rows="5">None</textarea>
                                            </div>
                                            <br>
                                            <hr>
                                            <h4>Highlights</h4>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Who am I?<sup style="color: red;">*</sup></label>
                                                <textarea name="txtHighlights" minlength="200" class="form-control" placeholder="Who am I?" required id="exampleFormControlHighlights" rows="5"></textarea>
                                            </div>

                                            <div style="border-left: 5px solid rgba(192, 57, 43,1.0); background-color:rgba(189, 195, 199,.2); width:100%; height:auto; padding:22px;">
                                                <h5><strong>Office incharge</strong></h5>
                                                <hr>
                                                <div style="width: 100%; height:auto; font-size: 14px; font-weight: 600; color: #34495e;">
                                                    E.g if your company have more than one office in different cities, kindly choose the city in which the office that will be responsible for this client is located.
                                                </div>
                                                <select name="txtOfficeIncharge" required type="text" class="form-control" id="exampleInputPassword1" placeholder="City">
                                                    <optgroup label="England">England
                                                        <option value="Wolverhampton">Wolverhampton</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputPassword1">Start Date<sup style="color: red;">*</sup></label>
                                                        <input name="txtStartDate" required type="datetime-local" class="form-control" id="exampleInputPassword1" placeholder="Start Date">
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputPassword1">End Date<span style="color: red;"></span></label>
                                                        <input name="txtEndDate" type="datetime-local" class="form-control" id="exampleInputPassword1" placeholder="End Date">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="txtCompanyId" value="<?php echo "" . $_SESSION['usr_compId'] . ""; ?>">
                                            <div class="form-group">
                                                <button type="submit" name="btnSubmitClient" class="btn  btn-primary">Add new client</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('footer-contents.php'); ?>