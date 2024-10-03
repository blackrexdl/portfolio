<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$db_host = 'localhost';      // Database host
$db_username = 'root';       // MySQL username
$db_password = '';       // MySQL password
$db_name = 'Po';             // Database name
$table_name = 'message';     // Table name

// Create a connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection and display a detailed error message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data handling
$form_data = $_POST;

if (!empty($form_data)) {
    // Validate and sanitize form data
    $fullname = filter_var($form_data['fullname'], FILTER_SANITIZE_STRING);
    $email = filter_var($form_data['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($form_data['message'], FILTER_SANITIZE_STRING);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO $table_name (fullname, email, message) VALUES (?, ?, ?)");
    
    // Check if statement preparation was successful
    if ($stmt === false) {
        die("Statement preparation failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $fullname, $email, $message);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        header("Location: success.php?response=Message sent successfully!");
        exit();
    } else {
        header("Location: success.php?response=Error: " . urlencode($stmt->error));
        exit();
    }
} else {
    echo "No form data received.";
}

// Close connection
$stmt->close();
$conn->close();
?>