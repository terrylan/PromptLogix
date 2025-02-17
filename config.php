<?php
// Database Configuration
$host = "localhost"; // Database host (usually 'localhost')
$dbname = "promptlogix"; // Name of the database
$username = "user"; // Database username (default is 'root' for local development)
$password = "pass"; // Database password (leave empty if no password is set)

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding to UTF-8 for proper text handling
$conn->set_charset("utf8");

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
