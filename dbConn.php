<?php
$host = "localhost"; 
$username = "root"; 
$password = "8298"; 
$database = "assignment"; 

// Create a MySQL connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>