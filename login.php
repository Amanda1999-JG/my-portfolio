<?php
session_start();

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "amanda";

// Establishing database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Processing user login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password for secure storage and retrieval
    $hashedPassword = sha1($password);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, set session and redirect
        $_SESSION["username"] = $username;
        header("Location: dashboard.php"); // Redirect to user dashboard
    } else {
        $error = "Invalid login credentials";
    }
}

$conn->close();
?>
