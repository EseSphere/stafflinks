<?php
include('client-header-contents.php');
if (isset($_GET['uryyToeSS4'])) {
    $uryyToeSS4 = $_GET['uryyToeSS4'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ?");
    $stmt->bind_param("s", $uryyToeSS4);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAddNotes'])) {
    $txtClientId = $_POST['txtClientId'];
    $txtMyNote = $_POST['txtMyNote'];
    $stmt = $conn->prepare("UPDATE tbl_general_client_form SET my_likes_and_dislikes = ? WHERE uryyToeSS4 = ?");
    $stmt->bind_param("ss", $txtMyNote, $txtClientId);
    if ($stmt->execute()) {
        header("Location: ./about-me?uryyToeSS4=" . urlencode($txtClientId));
        exit;
    }
    $stmt->close();
}
?>

<style>
    #fileBtn {
        background-color: indigo;
        color: white;
        padding: 0.5rem;
        font-family: sans-serif;
        border-radius: 0.3rem;
        cursor: pointer;
        margin-top: 1rem;
    }
</style>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-4 col-xl-1"></div>
            <div class="col-md-4 col-xl-8">
                <h5>Add Note</h5>
                <hr>
                <div class="card">
                    <div class="card-body" style="font-size: 16px;">
                        <form action="./my-likes-and-dislikes<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . " "; ?>" method="POST"
                            enctype="multipart/form-data" name="deactivate-admin" autocomplete="off">
                            <input type="hidden" value="<?php echo "" . $row['uryyToeSS4'] . " "; ?>" name="txtClientId" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Certificate name">My likes and dislikes</label>
                                        <textarea name="txtMyNote" id="" rows="7" class="form-control" required placeholder="Enter Note"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" name="btnAddNotes" type="submit">Add note</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3"></div>
        </div>
        <!-- [ delete box ] end -->
    </div>
</div>


<?php include('footer-contents.php'); ?>