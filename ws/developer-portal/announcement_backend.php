<?php
// Database configuration

if (isset($_POST['btnBroadcast'])) {
    $description = $conn->real_escape_string($_POST['description']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);

    $sql = "INSERT INTO tbl_post_updates (`description`, `start_date`, `end_date`) 
            VALUES ('$description', '$start_date', '$end_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
                alert('Announcement posted successfully.');
                window.location.href = 'announcement';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error: " . $conn->error . "');
              </script>";
    }
}

$conn->close();
