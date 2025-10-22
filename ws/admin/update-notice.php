<?php
$today = date('Y-m-d');
$sql = "SELECT * FROM tbl_post_updates WHERE start_date <= '$today' 
AND end_date >= '$today' ORDER BY created_at DESC";
$result = $conn->query($sql);
$notices = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notices[] = $row;
    }
}
?>
<style>
    #noticeAlertContainer {
        border-radius: 0;
    }

    #noticeAlertContainer .carousel-item {
        text-align: center;
    }

    #noticeAlertContainer .carousel-item p {
        margin: 0;
    }
</style>

<?php if (!empty($notices)): ?>
    <div id="noticeAlertContainer" class="container-fluid p-0">
        <div class="alert alert-success mb-0 d-flex p-1 justify-content-between align-items-center" role="alert">
            <div id="noticeCarousel" class="carousel slide flex-grow-1 w-75" data-bs-ride="carousel" data-bs-interval="4000">
                <div style="margin: 0 auto; width:900px; text-align:left;" class="carousel-inner">
                    <?php foreach ($notices as $index => $notice): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <p class="fw-semibold"><?php echo htmlspecialchars($notice['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="button" class="btn-close ms-3" aria-label="Close" id="closeNoticeBtn"></button>
        </div>
    </div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const noticeAlert = document.getElementById('noticeAlertContainer');
        const closeBtn = document.getElementById('closeNoticeBtn');

        // Hide if already closed in this session
        if (sessionStorage.getItem('noticeClosed') === 'true') {
            if (noticeAlert) noticeAlert.style.display = 'none';
        }

        // Close button
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                if (noticeAlert) noticeAlert.style.display = 'none';
                sessionStorage.setItem('noticeClosed', 'true');
            });
        }
    });
</script>