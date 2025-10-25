<?php
include('header-contents.php');
if (isset($_GET['city'], $_GET['specId'], $_GET['u7ye'])) {
    $runCity = trim($_GET['city']);
    $runSpecialId = trim($_GET['specId']);
    $crackEncryptedbinary = trim($_GET['u7ye']);
    $usr_compId = $_SESSION['usr_compId'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM tbl_client_runs WHERE col_run_city = ? 
    AND run_ids = ? AND col_company_Id = ? ORDER BY id DESC");
    if ($stmt) {
        $stmt->bind_param("sis", $runCity, $runSpecialId, $usr_compId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $_SESSION['run_town'] = $row['run_town'];
            $_SESSION['run_name'] = $row['run_name'];
            $_SESSION['run_Id']   = $row['run_ids'];
            $_SESSION['run_city'] = $row['col_run_city'];
        }
        $stmt->close();
    } else {
        error_log("Failed to prepare statement: " . $conn->error);
    }
} else {
    $runCity = '';
    $runSpecialId = '';
    $crackEncryptedbinary = '';
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Attach clients</h4>
                            <p style="margin-top: -10px; font-size:16px;">Attach clients to <?= $_SESSION['run_name']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-8">
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
                        <div style="width: 400px; height:auto; padding:12px; margin-top:12px;">
                            <input type="search" class="form-control" name="search_text" id="search_text" placeholder="Search client here..." />
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                        </div>
                        <div class="table-responsive">
                            <div id="result"></div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <?php require_once('attach-client-left-panel.php'); ?>
            </div>
            <?php include('bottom-panel-block.php'); ?>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    /**/
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch-attach-client-list.php",
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