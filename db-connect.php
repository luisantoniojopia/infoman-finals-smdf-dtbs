<?php

// Connection to smdf database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "smdf_dtbs";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4 for proper character encoding
$conn->set_charset("utf8mb4");
?>