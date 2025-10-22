<?php
include('header-contents.php');
if (isset($_GET['run_ids'])) {
    $run_ids = $_GET['run_ids'];
}
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- Page Header -->
        <div class="mb-4">
            <h4 class="fw-bold">Delete Run</h4>
            <p class="text-muted fs-6">
                You are about to permanently delete a run from the system. Please read all instructions carefully before proceeding.
            </p>
            <hr>
        </div>

        <div class="row">
            <!-- Delete Confirmation Card -->
            <div class="col-md-5 col-xl-5 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body" style="font-size: 16px;">
                        <h5 class="card-title text-danger">Delete Notice</h5>
                        <p class="fs-6">
                            Deleting this run is <strong>permanent</strong> and cannot be undone. Before proceeding, review the following:
                        </p>

                        <ul>
                            <li>All visits associated with this run from <strong>today onward</strong> will be <strong>deleted</strong> from the system.</li>
                            <li>All visits starting from today and onward will be deleted.</li>
                            <li>Ensure you have selected the correct run; double-check the run ID: <strong><?php echo htmlspecialchars($run_ids); ?></strong>.</li>
                            <li>Consider exporting or reviewing any important data before deletion.</li>
                        </ul>

                        <hr>
                        <p class="fw-bold fs-6">Confirm Deletion:</p>

                        <!-- Delete Form -->
                        <form action="./processing-run-delete-system" method="POST" enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <input type="hidden" name="RunSpecialId" value="<?php echo htmlspecialchars($run_ids); ?>" />
                            <div class="d-flex gap-2">
                                <button class="btn btn-danger" name="btnDeleteRun" type="submit">
                                    Yes, Delete This Run
                                </button>
                                <a href="./administrator-list" class="btn btn-secondary">
                                    Cancel & Return
                                </a>
                            </div>
                        </form>

                        <div class="mt-3">
                            <small class="text-muted">
                                Note: This action will remove future visits associated with this run and cannot be reversed.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info / Warning Section -->
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="card shadow-sm border-warning">
                    <div class="card-body" style="font-size: 15px;">
                        <h5 class="card-title text-warning">Important Information</h5>
                        <p class="fs-6">
                            Deleting a run will have the following consequences:
                        </p>
                        <ul>
                            <li>All future visits linked to this run will be permanently deleted.</li>
                            <li>All visits starting from today and onward will be deleted.</li>
                            <li>This action is irreversible. Once confirmed, the run and its future visits are permanently removed from the system.</li>
                        </ul>
                        <p class="text-danger fw-bold fs-6">
                            ⚠️ Make sure this run and its future visits are no longer needed before deletion.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-body" style="font-size: 14px;">
                        <h6 class="card-title">Tips Before Deleting</h6>
                        <ul>
                            <li>Verify the run ID matches the one intended for deletion.</li>
                            <li>Inform any team members who may be affected by this deletion.</li>
                            <li>Review upcoming visits to prevent accidental data loss.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('footer-contents.php'); ?>