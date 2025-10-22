<?php
include_once 'dbconnections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stars = intval($_POST["stars"]);
    $clientName = $conn->real_escape_string($_POST["clientName"]);
    $feedback = $conn->real_escape_string($_POST["feedback"]);
    $clientId = $conn->real_escape_string($_POST["clientId"]);
    $companyId = $conn->real_escape_string($_POST["companyId"]);

    if ($stars >= 1 && $stars <= 5 && !empty($feedback)) {
        $sql = "INSERT INTO tbl_ratings (stars, clientName, feedback, uryyToeSS4, col_company_Id) 
        VALUES ($stars, '$clientName', '$feedback', '$clientId', '$companyId')";
        if ($conn->query($sql) === TRUE) {
            echo "Thank you for your feedback!";
        } else {
            echo "Error saving your feedback.";
        }
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request.";
}
