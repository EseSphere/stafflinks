<?php
include('header-contents.php');


if (!isset($_GET['userId'])) {
    echo "<div class='alert alert-warning'>No care call selected.</div>";
    include('footer-contents.php');
    exit;
}

$userId = mysqli_real_escape_string($conn, $_GET['userId']);
$companyId = $_SESSION['usr_compId'];

// Retrieve note details
$query = "
    SELECT * FROM tbl_daily_shift_records
    WHERE userId = '$userId'
    AND col_company_Id = '$companyId'
    LIMIT 1
";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Note not found for the selected care call.</div>";
    include('footer-contents.php');
    exit;
}

$row = mysqli_fetch_assoc($result);
$existingNote = $row['task_note'];
$carerId = $row['first_carer_Id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedNote = mysqli_real_escape_string($conn, $_POST['updated_note']);
    $carerId = mysqli_real_escape_string($conn, $_POST['carer_Id']);

    $updateQuery = "
        UPDATE tbl_daily_shift_records
        SET task_note = '$updatedNote'
        WHERE userId = '$userId' AND first_carer_Id = '$carerId' AND col_company_Id = '$companyId'
    ";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<div class='alert alert-success font-weight-bold'>Note updated successfully ✅</div>";
        $existingNote = $updatedNote;
    } else {
        echo "<div class='alert alert-danger font-weight-bold'>Error updating note ❌</div>";
    }
}
?>

<style>
    .form-control {
        font-size: 1.15rem;
    }

    label {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .btn-lg {
        font-size: 1.1rem;
        padding: 10px 25px;
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📝 Edit General Note</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="updated_note">Note Content</label>
                        <textarea id="updated_note" name="updated_note" class="form-control" rows="6"
                            required><?= htmlspecialchars($existingNote) ?></textarea>
                    </div>
                    <input type="hidden" name="carer_Id" value="<?= $carerId ?>">
                    <button type="submit" class="btn btn-success btn-lg">Update Note</button>
                    <a href="./view-care-call?userId=<?= $userId ?>" class="btn btn-secondary btn-lg ml-2">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5"><?php include('bottom-panel-block.php'); ?></div>
<?php include('footer-contents.php'); ?>