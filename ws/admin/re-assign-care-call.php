<?php include('header-contents.php'); ?>

<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }

    .multipleSelection {
        width: 200px;
        background-color: rgba(189, 195, 199, 1.0);
        font-size: 16px;
        position: absolute;
        z-index: 1000;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        padding: 5px;
        font-weight: bold;
        font-size: 16px;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkBoxes {
        display: none;
        border: 1px #8DF5E4 solid;
        height: auto;
        padding: 8px;
    }

    #checkBoxes label {
        display: block;
        padding: 5px;
    }

    #checkBoxes label:hover {
        background-color: #4F615E;
        color: white;

        /* Added text color for better visibility */
    }
</style>

<?php
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'] ?? '';
    $_SESSION['userId'] = $userId ?? '';
}

if (isset($_GET['userId'], $_GET['location'], $_GET['date']) && $_GET['location'] === 'scheduleRota') {
    $sql = "SELECT * FROM tbl_schedule_calls WHERE (userId = '$userId' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY userId DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['currentDateRota'] = $_GET['date'] ?? '';
    $_SESSION['carerUniqueId'] = $row["first_carer_Id"] ?? '';
    $_SESSION['clientName'] = $row["client_name"] ?? '';
    $_SESSION['get_care_calls'] = $row["care_calls"] ?? '';
    $_SESSION['get_run_name'] = $row["col_run_name"] ?? '';
    $_SESSION['get_client_Spec_Id'] = $row["uryyToeSS4"] ?? '';
} else {
    $row_sel_result = mysqli_query($conn, "SELECT * FROM tbl_manage_runs WHERE userId='$userId' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "' ");
    $display_row_result = mysqli_fetch_array($row_sel_result, MYSQLI_ASSOC);
    $_SESSION['currentDateRota'];
    $get_run_name = $display_row_result['col_run_name'] ?? '';
    $get_run_nameid = $display_row_result['run_area_nameId'] ?? '';
    $get_client_Spec_Id = $display_row_result['uryyToeSS4'] ?? '';
    $_SESSION['get_care_calls'] = $display_row_result['care_calls'] ?? '';
    $_SESSION['get_run_name'] = $display_row_result['col_run_name'] ?? '';
    $_SESSION['get_client_Spec_Id'] = $get_client_Spec_Id ?? '';

    $sql = "SELECT * FROM tbl_schedule_calls WHERE (uryyToeSS4 = '$get_client_Spec_Id' 
    AND care_calls = '" . $_SESSION['get_care_calls'] . "' AND col_run_name = '$get_run_name' 
    AND Clientshift_Date = '" . $_SESSION['currentDateRota'] . "'
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY userId DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['carerUniqueId'] = $row["first_carer_Id"] ?? '';
    $_SESSION['clientName'] = $row["client_name"] ?? '';
}
?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Re-assign Visit<br><small>Re-assign visit to another carer for the selected date.</small></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
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

                        <div style="margin-top: 60px;" class="row">
                            <br>
                            <div class="col-sm-3">
                                <div>
                                    <input type="search" class="form-control" name="search_text" id="search_text" placeholder="Search team here..." />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <form action="./cookie-cities" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <select onchange="this.form.submit()" name="clientView" id="select_page" style="width:200px; height:50px;" class="form-control">
                                        <option style="height: 40px; padding:12px; background-color:rgba(39, 174, 96,1.0); color:white;" value="">
                                            <?php
                                            if (isset($_COOKIE['companyCity'])) {
                                                echo $_COOKIE["companyCity"];
                                            } else {
                                                echo "Select city...";
                                            } ?>
                                        </option>
                                        <option value="Select all">Select all</option>
                                        <?php
                                        $stmt = $conn->prepare("SELECT col_Office_Incharge FROM tbl_general_client_form 
                                        WHERE col_company_Id = ? GROUP BY col_Office_Incharge");
                                        $stmt->bind_param("s", $_SESSION['usr_compId']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            $officeIncharge = htmlspecialchars($row['col_Office_Incharge'], ENT_QUOTES, 'UTF-8');
                                            echo "<option value='{$officeIncharge}'>{$officeIncharge}</option>";
                                        }
                                        ?>
                                    </select>
                                </form>
                            </div>
                            <div class="col-sm-2">
                            </div>
                            <div style="text-align: right;" class="col-sm-3">
                                <a href="./add-new-team" style="text-decoration:none;" style="height: 48px;" type="button" class="btn btn-outline-info"><i class="feather mr-2 icon-plus"></i>Add team</a>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-y:scroll;" class="card-body p-0">
                        <div class="table-responsive">
                            <div id="result"></div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch-re-assign-call.php",
                method: "post",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
</script>

<?php include('footer-contents.php'); ?>