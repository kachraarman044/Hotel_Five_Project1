<?php
// ============================================================
//  db_connect.php  —  XAMPP MySQL Database Connection
//  Database : food_website
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // XAMPP default user
define('DB_PASS', '');            // XAMPP default password (empty)
define('DB_NAME', 'food_website');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        'status'  => 'error',
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

// Set character set
$conn->set_charset('utf8mb4');
?>
