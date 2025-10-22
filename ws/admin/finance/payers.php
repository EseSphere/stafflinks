<?php include('header-contents.php'); ?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Payers</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <a href="./new-payer" style="text-decoration: none;">
                    <button class="btn btn-outline-secondary">New payers</button>
                </a>
                <a href="./contract" style="text-decoration: none;">
                    <button class="btn btn-outline-info">Contracts</button>
                </a>
                <br><br>
                <!--First table contents-->
                <div class="card table-card tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-1">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Payer details</h5>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <form action="">
                                    <div class="form-group">
                                        <input type="search" class="form-control" name="search_text" id="search_text" placeholder="Search here..." />
                                    </div>
                                </form>
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
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>
<script type="text/javascript">
    /**/
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch-payers.php",
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