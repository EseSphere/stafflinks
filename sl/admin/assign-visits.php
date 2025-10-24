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
    }
</style>

<?php
if (isset($_GET['run_area_nameId'])) {
    $run_area_nameId = $_GET['run_area_nameId'];
    $_SESSION['uryyToeSS4'] = $run_area_nameId;
} else {
    die("Error: run_area_nameId parameter is missing.");
}
$row_sel_result = mysqli_query($conn, "SELECT * FROM tbl_manage_runs 
WHERE run_area_nameId='$run_area_nameId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
if (!$row_sel_result) {
    die("Database query failed: " . mysqli_error($conn));
}
$display_row_result = mysqli_fetch_array($row_sel_result, MYSQLI_ASSOC);
if ($display_row_result) {
    $get_run_name = $display_row_result['col_run_name'];
    $get_run_nameid = $display_row_result['run_area_nameId'];
    $get_run_area = $display_row_result['client_area'];
    $get_run_city = $display_row_result['col_client_city'];

    $_SESSION['runName'] = $get_run_name;
    $_SESSION['runNameId'] = $get_run_nameid;
    $_SESSION['runNameArea'] = $get_run_area;
    $_SESSION['runNameCity'] = $get_run_city;
} else {
    die("No run data found for run_area_nameId: $run_area_nameId");
}
$row_sel_result_calls = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls 
WHERE col_area_Id='$run_area_nameId' AND col_company_Id = '" . $_SESSION['usr_compId'] . "'");
if (!$row_sel_result_calls) {
    die("Database query failed: " . mysqli_error($conn));
}
$display_row_result_calls = mysqli_fetch_array($row_sel_result_calls, MYSQLI_ASSOC);
if ($display_row_result_calls) {
    $get_curCarer_Id = $display_row_result_calls['first_carer_Id'];
    $uryyToeSS4 = $display_row_result_calls['uryyToeSS4'];
    $Clientshift_Date = $display_row_result_calls['Clientshift_Date'];
    $_SESSION["get_curCarer_Id"] = $get_curCarer_Id;
} else {
    $_SESSION["get_curCarer_Id"] = null;
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Assign run</h5>
                            <p style="margin-top:-12px; font-size:16px;">
                                You can easily assign the <?= $get_run_name ?> run to carers, or unassign it when required
                            </p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex justify-content-end">
                            <a href="./unallocate-run?uryyToeSS4=<?= $uryyToeSS4 ?>&run=<?= $get_run_nameid ?>&date=<?= $_SESSION['currentDateRota'] ?>&carer=<?= $get_curCarer_Id ?>"
                                class="btn btn-info text-white text-decoration-none">
                                Unallocate
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
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
                            <div class="col-sm-3 col-4">
                                <div><input type="search" class="form-control" name="search_text" id="search_text" placeholder="Search team here..." /></div>
                            </div>
                            <div class="col-sm-3 col-4">
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
                                        $stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
                                        WHERE col_company_Id = ? GROUP BY col_Office_Incharge");
                                        $stmt->bind_param("s", $_SESSION['usr_compId']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row_get_client_cities = $result->fetch_array()) {
                                            echo "
                                            <option value='" . $row_get_client_cities['col_Office_Incharge'] . "'>" . $row_get_client_cities['col_Office_Incharge'] . "</option>
                                            ";
                                        } ?>
                                        ?>
                                    </select>
                                </form>
                            </div>
                            <div style="text-align: right;" class="col-sm-5 col-4">
                                <a href="./add-new-team" style="text-decoration:none;">
                                    <button style="height: 48px;" type="button" class="btn btn-outline-info"><i class="feather mr-2 icon-plus"></i>Add team</button>
                                </a>
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
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch-carer-for-run.php",
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
    //Check box code begins from here
    let show = true;
</script>

<?php include('footer-contents.php'); ?>