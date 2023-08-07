<?php
// Database credentials
$host = "localhost";     
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName = "amanda"; 

// Create a connection
$conn = new mysqli('localhost','root','','amanda');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close the connection when done
$conn->close();
?>
