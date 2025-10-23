<?php
include('dbconnections.php');

if (isset($_POST['btnSubmitTask'])) {
    $taskTitle = trim($_POST['txtTaskTitle'] ?? '');
    $taskCategory = trim($_POST['txtTaskCategories'] ?? '');

    if (empty($taskTitle) || empty($taskCategory)) {
        echo "<script>
                $(document).ready(function() {
                    $('#popupAlert').text('Please fill in all required fields.').show();
                });
              </script>";
        exit;
    }

    $stmtCheck = $conn->prepare("SELECT 1 FROM tbl_task_list WHERE task_title = ?");
    $stmtCheck->bind_param("s", $taskTitle);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        echo "<script>
                $(document).ready(function() {
                    $('#popupAlert').text('A task with this title already exists.').show();
                });
              </script>";
        $stmtCheck->close();
        exit;
    }
    $stmtCheck->close();

    $stmtInsert = $conn->prepare("INSERT INTO tbl_task_list (task_title, task_category) VALUES (?, ?)");
    $stmtInsert->bind_param("ss", $taskTitle, $taskCategory);

    if ($stmtInsert->execute()) {
        header("Location: ./auth-client-task");
        exit;
    } else {
        error_log("Database Error: " . $stmtInsert->error);
        echo "<script>
                $(document).ready(function() {
                    $('#popupAlert').text('An error occurred while saving the task. Please try again.').show();
                });
              </script>";
    }

    $stmtInsert->close();
}
