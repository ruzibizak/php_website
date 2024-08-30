<?php
// contact_form_handler.php

// Include the database configuration file
include 'config.php';

// Initialize response variable
$response = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare an SQL statement for insertion
    $sql = "INSERT INTO messages (message, created_at) VALUES (?, NOW())";
    
    // Prepare the statement
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("s", $message);
        
        // Execute the statement
        if ($stmt->execute()) {
            $response = 'Message sent successfully!';
        } else {
            $response = 'Failed to send message.';
        }
        
        // Close the statement
        $stmt->close();
    } else {
        $response = 'Failed to prepare statement.';
    }
    
    // Close the database connection
    $mysqli->close();
    
    // Display JavaScript for dialog and redirection
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Form Submission</title>
        <style>
            .dialog {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                background: #f4f4f4;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }
        </style>
    </head>
    <body>
        <div class='dialog'>
            <p>$response</p>
            <p>Redirecting you shortly...</p>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'index.php'; // Change to the page you want to redirect to
            }, 2000); // Delay in milliseconds (2 seconds)
        </script>
    </body>
    </html>";
}
?>
