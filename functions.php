<?php
// Function to perform form validation and return an array of error messages
function validateForm($data) {
    $errors = array();

    // Example validation: Ensure project name is not empty
    if (empty($data['project_name'])) {
        $errors[] = "Project name is required.";
    }

    // Add more validation rules as needed

    return $errors;
}

// Function to establish a database connection and return the connection object
function connectDatabase() {
    $host = "localhost";
    $dbUsername = "username";
    $dbPassword = "password";
    $dbName = "database_name";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to insert project details into the database
function insertProject($projectData) {
    $conn = connectDatabase();

    // Sanitize the input data to prevent SQL injection
    $projectName = $conn->real_escape_string($projectData['project_name']);
    $projectDescription = $conn->real_escape_string($projectData['project_description']);

    $query = "INSERT INTO projects (project_name, project_description) VALUES ('$projectName', '$projectDescription')";

    if ($conn->query($query) === TRUE) {
        return true;
    } else {
        return false;
    }

    $conn->close();
}

// Function to retrieve project data from the database
function getProjects() {
    $conn = connectDatabase();

    $query = "SELECT * FROM projects";
    $result = $conn->query($query);

    $projects = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }

    $conn->close();

    return $projects;
}

// Function to update project information in the database
function updateProject($projectId, $projectData) {
    $conn = connectDatabase();

    // Sanitize the input data to prevent SQL injection
    $projectName = $conn->real_escape_string($projectData['project_name']);
    $projectDescription = $conn->real_escape_string($projectData['project_description']);

    $query = "UPDATE projects SET project_name = '$projectName', project_description = '$projectDescription' WHERE id = $projectId";

    if ($conn->query($query) === TRUE) {
        return true;
    } else {
        return false;
    }

    $conn->close();
}

// Function to delete a project from the database
function deleteProject($projectId) {
    $conn = connectDatabase();

    $query = "DELETE FROM projects WHERE id = $projectId";

    if ($conn->query($query) === TRUE) {
        return true;
    } else {
        return false;
    }

    $conn->close();
}

?>

