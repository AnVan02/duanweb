<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'nvpbgqcv_rosa_courses');
define('DB_PASS', 'Vietson@ROSA@150');
define('DB_NAME', 'nvpbgqcv_rosa_courses');

// Create database connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4 for proper Vietnamese character support
    $conn->set_charset("utf8mb4");
    
    return $conn;
}
?>
