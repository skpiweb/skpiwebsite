<?php
// Database connection (if you want to store the data)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpmyadmin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture details
$ip_address = $_SERVER['REMOTE_ADDR']; // User's IP address
$user_agent = $_SERVER['HTTP_USER_AGENT']; // User's browser info
$referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct'; // Where the user came from
$timestamp = date('Y-m-d H:i:s'); // Current timestamp

// Insert into database
$sql = "INSERT INTO link_clicks (ip_address, user_agent, referrer, timestamp)
        VALUES ('$ip_address', '$user_agent', '$referrer', '$timestamp')";

if ($conn->query($sql) === TRUE) {
    // Redirect to the target URL
    $target_url = "http://localhost:8080/SKPIEmployee/"; // Replace with your target URL
    header("Location: $target_url");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>