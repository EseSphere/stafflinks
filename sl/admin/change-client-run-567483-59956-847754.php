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
</style>

<?php
if (isset($_GET['userId'], $_GET['spec'], $_GET['name'], $_GET['date'], $_GET['visit'])) {
    $myUserId = $_GET['userId'];
    $myuryyToeSS4 = $_GET['spec'];
    $clientFullName    = $_GET['name'];
    $shiftDate    = $_GET['date'];
    $mycare_calls         = $_GET['visit'];
    $query = mysqli_query($conn, "SELECT * FROM tbl_manage_runs WHERE (userId = '$myUserId' 
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ");
    $row_get_data = mysqli_fetch_assoc($query);
    $client_name = $row_get_data['client_name'];
    $client_specId = $row_get_data['uryyToeSS4'];
    $client_care_call = $row_get_data['care_calls'];
    $client_col_run_name = $row_get_data['col_run_name'];
    $_SESSION['col_run_name'] = $client_col_run_name;
    $_SESSION['client_name'] = $client_name;
    $_SESSION['client_care_call'] = $client_care_call;
    $_SESSION['myUsersId'] = $myUserId;
    $_SESSION['clientSpecialId'] = $client_specId;
    $usuryIYTj = hash('SHA256', $myUserId);

    $sql = "SELECT * FROM tbl_schedule_calls WHERE (uryyToeSS4 = '$client_specId' 
    AND care_calls = '$client_care_call' AND col_run_name = '$client_col_run_name' 
    AND Clientshift_Date = '" . $_SESSION['currentDateRota'] . "'
    AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ORDER BY userId DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["userId"];
        $clientFullName = $row["client_name"];
        $myuryyToeSS4 = $row["uryyToeSS4"];
        $mycare_calls = $row["care_calls"];
    }
}
?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Run
                            </h5>
                        </div>
                        <ul class="breadcrumb">
                            <li style="font-size:16px;" class="breadcrumb-item">
                                Move <?php echo $_SESSION['client_name']; ?>, <?php echo $_SESSION['client_care_call']; ?>
                                call to another run.
                            </li>
                        </ul>
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

                        <div style="margin-top: 15px;" class="row">
                            <br>
                            <div style="padding: 0;" class="col-sm-3 col-3">
                                <div>
                                    <input type="search" class="form-control" name="search_text" id="search_text" placeholder="Search run here..." />
                                </div>
                                <ul class="list"></ul>
                            </div>
                            <div style="padding: 0;" class="col-sm-3 col-5"></div>
                            <div style="padding: 0;" class="col-sm-5">
                                <div style="width: 100%; height:auto; padding:12px; text-align:right;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a type="button" href="./re-assign-care-call?userId=<?php echo $myUserId ?>&u7ye=<?= $crackEncryptedbinary ?>" style="text-decoration: none;" class="btn btn-success">Re-assign visit</a>
                                        <a type="button" href="./cancel-client-care-call?userId=<?= $myUserId ?>&spec=<?= $myuryyToeSS4 ?>&name=<?= $clientFullName ?>&visit=<?= $mycare_calls ?>&date=<?= $shiftDate ?>&u7ye=<?= $crackEncryptedbinary ?>" class="btn btn-primary">Cancel visit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
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
                url: "fetch-client-runs-to-change.php",
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