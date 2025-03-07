<?php
require 'db.php'; // Include your database connection
require 'functions.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Required fields check
    $requiredFields = ['full_name', 'email', 'phone_number', 'city', 'topic', 'message'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo '<div class="alert alert-danger">All fields are required.</div>';
            exit();
        }
    }

    // Sanitize input data
    $full_name = htmlspecialchars($_POST["full_name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone_number = htmlspecialchars($_POST["phone_number"]);
    $city = htmlspecialchars($_POST["city"]);
    $topic = htmlspecialchars($_POST["topic"]);
    $other_topic = isset($_POST["other_topic"]) ? htmlspecialchars($_POST["other_topic"]) : null;
    $message = htmlspecialchars($_POST["message"]);
    $status = "pending";
    $created_at = date("Y-m-d H:i:s");

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger">Invalid email format.</div>';
        exit();
    }

    // Insert into database
    $sql = "INSERT INTO contact (full_name, email, phone, city, topic, other_topic, message, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssss", $full_name, $email, $phone_number, $city, $topic, $other_topic, $message, $created_at);
        
        if ($stmt->execute()) {
            createNotification($full_name . " Just Submited Contact Form" , "contact.php?s=" . $email);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thank you for contacting us!</strong> We will get back to you shortly.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger">Error: Could not submit your request.</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="alert alert-danger">Error: Database query failed.</div>';
    }

    $con->close();
} else {
    echo '<div class="alert alert-danger">Invalid request.</div>';
}
?>
