<?php include_once("header.php"); ?>

<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <h4 class="p-4 mt-3"><strong>Scheduled Visit</strong></h4>
                <p style="font-size: 16px; margin-top:-25px; font-weight:600; padding:2px 0px 0px 22px;">
                    Generate Analytics <br>
                    Kindly complete the form below to generate comprehensive analytics based on your input. Your information enables
                    us to deliver accurate and insightful reports tailored to your specific requirements.
                </p>
                <hr>
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">

                            <form id="trendForm">
                                <div class="container mt-1">
                                    <div class="row g-3">
                                        <p style="font-size: 16px; margin-top:-25px; font-weight:600; padding:2px 0px 0px 22px;"><i class="fa fa-list"></i> &nbsp; Complete the form</p>
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label fw-semibold">Start Date</label>
                                            <input type="date" value="<?php echo date('Y-m-d', strtotime('today')); ?>" class="form-control" id="start_date" name="start_date" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label fw-semibold">End Date</label>
                                            <input type="date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" class="form-control" id="end_date" name="end_date" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="trend" class="form-label fw-semibold">Trend</label>
                                            <select class="form-select" id="trend" name="trend">
                                                <option value="days">Days</option>
                                                <option value="weeks">Weeks</option>
                                                <option value="months">Months</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="period" class="form-label fw-semibold">Period</label>
                                            <select class="form-select" id="period" name="period">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-9 fw-semibold">Analytics</h5>
                            <p style="font-size: 16px; margin-top:-25px; font-weight:600; padding:12px 0px 0px 0px;">
                                The section below presents a graphical representation of the generated report. It offers a clear visual summary to support data interpretation and analysis.
                            </p>
                            <div class="text-end mt-3">
                                <button id="downloadChart" class="btn btn-sm btn-outline-secondary" title="Download Chart">
                                    <i class="fa fa-download"></i>
                                </button>
                            </div>
                            <div class="row align-items-center">
                                <canvas id="barChartSchVisit" width="800" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid my-2 bg-light p-3">
        <h4 class="card-title fw-semibold"><strong>Break Down</strong></h4>
        <div class="row text-decoration-none" id="breakdownContainer">
            <!-- Dynamically filled via JS -->
        </div>
    </div>
</div>

<script type="text/javascript" src="./scheduled-visit.js"></script>

<?php include_once("footer.php"); ?>