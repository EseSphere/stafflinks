<?php
//Broadcast_update.php
require_once './dbconnections.php'; // Adjust the path as necessary

// Fetch all emails from the database
$emailsArray = [];
$sql = "SELECT user_email_address FROM tbl_goesoft_users 
WHERE admin_access = 'Granted'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emailsArray[] = $row['user_email_address'];
    }
}

$emailsString = implode(", ", $emailsArray); // Convert array to comma-separated string
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Emails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Send Message to Multiple Emails</h2>
        <form id="emailForm">
            <div class="mb-3">
                <label for="emails" class="form-label">Emails (editable, database emails are preloaded)</label>
                <textarea class="form-control" id="emails" name="emails" rows="4" required><?php echo htmlspecialchars($emailsString); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="button" id="previewBtn" class="btn btn-secondary me-2">Preview Email</button>
            <button type="submit" class="btn btn-primary">Send Emails</button>
        </form>

        <div id="response" class="mt-3"></div>

        <!-- Preview Modal -->
        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">Email Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="previewContent" style="white-space: pre-wrap;"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            // Preview email
            $('#previewBtn').on('click', function() {
                let subject = $('#subject').val();
                let message = $('#message').val();
                if (!subject || !message) {
                    alert("Subject and message are required for preview.");
                    return;
                }

                // Simple HTML preview with Bootstrap styling
                let previewHtml = `<h4>${$('<div>').text(subject).html()}</h4><hr>` +
                    $('<div>').text(message).html().replace(/\n/g, '<br>');

                $('#previewContent').html(previewHtml);
                let previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
                previewModal.show();
            });

            // Send emails
            $('#emailForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'send_emails.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#response').html('<div class="alert alert-info">' + response + '</div>');
                    },
                    error: function() {
                        $('#response').html('<div class="alert alert-danger">An error occurred.</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>