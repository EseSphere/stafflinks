<div mbsc-page class="demo-work-order-scheduling">
    <div style="height:100%">
        <div style="height: 100vh;" id="demo-work-order-scheduling" class="md-work-order-scheduling"></div>

        <div style="display:none;">
            <div id="demo-work-order-popup">
                <div class="mbsc-form-group">
                    <label>
                        Client name
                        <input mbsc-input id="work-order-title" />
                    </label>
                    <label>
                        Location
                        <input mbsc-input id="work-order-location" />
                    </label>
                    <label>
                        Status
                        <button mbsc-textarea id="work-order-status"></button>
                    </label>
                    <label>
                        Planned time in
                        <input mbsc-input id="work-order-start" />
                    </label>
                    <label>
                        Planned time out
                        <input mbsc-input id="work-order-end" />
                    </label>
                </div>
                <div class="mbsc-form-group">
                    <label>
                        Team member
                        <input mbsc-input id="work-order-firstCarer" />
                    </label>
                    <div id="work-order-date"></div>
                </div>
                <div class="mbsc-button-group">
                    <button class="mbsc-button-block" style="width: 150px;" id="work-order-decision" mbsc-button data-color="info">Modify</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div style="position:absolute; top:2px; width:78%; font-size:18px; left:200px; z-index:1000;">
    <div class="row">
        <div class="col-md-2 col-2">
            <div style="width:100%; height:auto; padding:3px; text-align:center;">
                <form style="margin-top: -25px;" action="./carer-view" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div style="width:100px;">
                        <?php $varViewCurrentDate = $_SESSION['currentDate'] = date('Y-m-d'); ?>
                        <br>
                        <select onchange="this.form.submit()" name="txtCarerView" id="select_page" style="width:200px; height:32px; font-size:16px; font-weight:600; border:1px solid #fff;" class="form-control">
                            <option selected value="Null">Search carers</option>
                            <?php
                            $sql_get_carers = "SELECT * FROM tbl_goesoft_carers_account 
                            WHERE (col_company_Id = '" . $_SESSION['usr_compId'] . "') 
                            GROUP BY user_special_Id ORDER BY user_fullname ";
                            $result_carers = $myConnection->query($sql_get_carers);
                            while ($row_carers = $result_carers->fetch_assoc()) {
                                echo "
                                <option value='" . $row_carers["user_special_Id"] . "'>" . $row_carers["user_fullname"] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2 col-2">
            <div style="width:100%; height:auto; padding:3px; text-align:center;">
                <form style="margin-top: 5px;" action="./cookie-cities" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="txtCurrentDate" value="<?php echo $_SESSION['currentDateRota']; ?>">
                    <div style="padding: 0px 0px 20px 5px; width:100%;">
                        <select onchange="this.form.submit()" name="fname" id="select_page" style="width:200px; height:40px;" class="form-control">
                            <option value=""><?php echo $_COOKIE["companyCity"]; ?></option>
                            <option value="Wolverhampton">Wolverhampton</option>
                            <option value="Supported live in">Supported live in</option>
                            <option value="Stoke on Trent">Stoke on trent</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div style="text-align:right;" class="col-md-1">
            <h5 style="margin-top: 10px; font-weight:600;">Rota</h5>
        </div>
        <div style="text-align:right;" class="col-md-3">
            <form style="margin-top: 5px;" action="./carer-view" method="GET" enctype="multipart/form-data" autocomplete="off">
                <button style="font-size: 22px; cursor: pointer; background-color:inherit; border:none;" id="decrement">&larr;</button>
                <input name='txtDate' onchange='this.form.submit()' style="background-color: inherit; border:none;" type="date" id="dateInput" value="<?php echo $varViewCurrentDate; ?>">
                <button style="font-size: 22px; cursor: pointer; background-color:inherit; border:none;" id="increment">&rarr;</button>
            </form>
        </div>
        <div style="text-align:right;" class="col-md-4">
            <a href="../dashboard" style="text-decoration: none;">
                <button class="btn btn-md btn-success">Dashboard</button>
            </a>
            <a href="./schedule-run-756473-00499-99553-85006?txtDate=<?php echo date('Y-m-d'); ?>" target="_blank" style="text-decoration: none;">
                <button class="btn btn-md btn-primary">Plan roster</button>
            </a>
            <a href="../manage-runs" style="text-decoration: none;">
                <button style="color: white;" class="btn btn-md btn-info">Manage runs</button>
            </a>
        </div>
    </div>
</div>


<!--<div id="popaction" style="position:absolute; top:0px; left:0; right:0; bottom:0; width:100%; font-size:18px; z-index:1000; background-color:rgba(44, 62, 80,.1); height:100%;">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4"></div>
        <div class="col-md-5">
            <div style="width: 100%; height:100%; background-color:white;border-left: 3px solid rgba(44, 62, 80,1.0);">
                <div style="padding:22px; width:100%; height:auto; background-color:rgba(44, 62, 80,1.0);">
                    <button class="btn btn-sm btn-danger" id="popupClose" style="float: right; cursor:pointer;">Close</button>
                    <h5><strong style="color: white;">Edit care call</strong></h5>
                    <div style="width: 100%; height:auto; margin-top:18px;">
                        <form action="">
                            <div class="form-group">
                                <div class="row">
                                    <div style="padding: 0px;" class="col-md-8">
                                        <input style="height: 50px; font-size:20px;" type="search" name="txtSearchClient" class="form-control" required placeholder="Enter client name">
                                    </div>
                                    <div style="padding: 0px;" class="col-md-4">
                                        <input style="height: 50px; font-size:16px;" type="submit" value="Fetch" name="btnSearchClient" class="btn btn-success btn-large" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>-->