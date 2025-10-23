<?php
include('client-header-contents.php');
$clientId = $_GET['uryyToeSS4'] ?? '';
$companyId = $_SESSION['usr_compId'];

// Fetch client info
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
    WHERE uryyToeSS4 = ? AND col_company_Id = ? 
    ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $clientId, $companyId);
$stmt->execute();
$result = $stmt->get_result();
$clientRow = $result->fetch_assoc();
$clientName = trim(($clientRow['client_first_name'] ?? '') . ' ' . ($clientRow['client_last_name'] ?? ''));
$stmt->close();
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <h4>Note</h4>
        <p class="fs-6">View all <?= $clientName ?>'s notes and modify.</p>
        <hr>
        <div class="row">
            <div style="position: sticky; top: 20px; background-color: #eee; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px; height:300px;" class="col-md-5 sticky-filter">
                <h5 class="mt-3">Write new note</h5>
                <form action="./processing-client-note" method="post" enctype="multipart/form-data" autocomplete="off">
                    <?php
                    $stmt = $conn->prepare("SELECT uryyToeSS4, col_company_Id FROM tbl_general_client_form 
                        WHERE uryyToeSS4 = ? AND col_company_Id = ? ORDER BY userId DESC");
                    $stmt->bind_param("ss", $clientId, $companyId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($row = $result->fetch_assoc()):
                    ?>
                        <input type="hidden" name="textTeamName" value="<?= htmlspecialchars($_SESSION['usr_userName']); ?>" />
                        <input type="hidden" name="txtClientSpecialId" value="<?= htmlspecialchars($row['uryyToeSS4']); ?>" />
                        <input type="hidden" name="txtDateOfNote" value="<?= date("Y-m-d"); ?>" />
                        <input type="hidden" name="txtTimeOfNote" value="<?= date("h:ia"); ?>" />
                        <input type="hidden" name="txtCompanyId" value="<?= htmlspecialchars($row['col_company_Id']); ?>" />

                        <div class="form-group">
                            <textarea name="txtClientNote" required style="resize: none;" class="form-control" placeholder="Notes" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button onclick="location.reload();" type="button" class="btn btn-small btn-danger">Reset form</button>
                            <input type="submit" name="btnSubmitClientNote" class="btn btn-small btn-primary" value="Save note" />
                        </div>
                    <?php endif;
                    $stmt->close(); ?>
                </form>
            </div>

            <!-- Notes list -->
            <div class="col-md-7">
                <div class="row">
                    <h5><strong>Notes</strong></h5>
                    <div class="mb-3 w-25">
                        <div style="margin-left: 18px;" class="input-group">
                            <input type="hidden" id="clientId" value="<?= htmlspecialchars($clientId) ?>">
                            <input type="text" style="width: 300px !important; height:30px;" id="searchNotes" class="form-control" placeholder="Search notes...">
                        </div>
                    </div>
                    <div id="notesContainer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer-contents.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        function loadNotes(search = '', page = 1) {
            const clientId = $('#clientId').val();
            $.ajax({
                url: 'fetch_client_notes.php',
                type: 'GET',
                data: {
                    clientId: clientId,
                    search: search,
                    page: page
                },
                success: function(data) {
                    $('#notesContainer').html(data);
                }
            });
        }

        // Initial load
        loadNotes();

        // Live search
        $('#searchNotes').on('input', function() {
            const search = $(this).val();
            loadNotes(search);
        });

        // Handle pagination clicks inside notes container
        $(document).on('click', '#notesContainer .pagination a', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            const urlParams = new URLSearchParams(href.split('?')[1]);
            const page = urlParams.get('page') || 1;
            const search = $('#searchNotes').val();
            loadNotes(search, page);
        });

    });
</script>