<?php require_once 'header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-content text-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" name="signupForm" autocomplete="off">
            <div class="card borderless">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h4 class="f-w-400">Post Updates</h4>
                            <hr>
                            <div class="form-group mb-3 text-left">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Write something..." required></textarea>
                            </div>
                            <div class="form-group mb-3 text-left">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" value="<?php print date('Y-m-d'); ?>" name="start_date" id="start_date" required>
                            </div>
                            <div class="form-group mb-3 text-left">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" readonly>
                            </div>
                            <button type="submit" id="save-btn" name="btnBroadcast" class="btn btn-primary btn-block mb-4">Broadcast</button>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>