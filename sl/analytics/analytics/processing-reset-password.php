<?php
if (isset($_SESSION['user_id'])) {
    header("Location: ./dashboard");
    exit();
}

if (isset($_POST['btnResetPass'])) {
    if (empty($_POST['password']) || empty($_POST['email'])) {
        echo "Error: Please fill in both fields.";
        exit();
    }

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $conn->real_escape_string($_POST['email']);

    // First, check if the email exists in the database
    $stmt_check = $conn->prepare("SELECT * FROM `tbl_users` WHERE `email` = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        $stmt_update = $conn->prepare("UPDATE `tbl_users` SET `password` = ? WHERE `email` = ?");
        $stmt_update->bind_param("ss", $password, $email);

        if ($stmt_update->execute()) {
            header("Location: ./index");
        } else {
            echo "Error: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        echo "Error: Email not found in the database.";
    }

    $stmt_check->close();
}

$conn->close();
