<?php
// ============================================================
//  create_database.php  —  Creates the food_website database
//  Run this file FIRST before creating tables
//  URL: http://localhost/Food Website/php/database/create_database.php
// ============================================================

// Connect to MySQL WITHOUT selecting a database
$conn = new mysqli('localhost', 'root', '');

if ($conn->connect_error) {
    die("<div style='color:red; font-family:Arial; padding:20px;'>
         ❌ MySQL Connection Failed: " . $conn->connect_error . "
         <br><br>Make sure XAMPP Apache & MySQL are running!
         </div>");
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS `food_website`
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci";

if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family:Arial; padding:20px;'>
          <h2 style='color:green;'>✅ Database 'food_website' created successfully!</h2>
          <p>Ab neeche ke links se tables create karo:</p>
          <ul>
            <li><a href='create_users_table.php'>1. Users Table Create karo</a></li>
            <li><a href='create_orders_table.php'>2. Orders Table Create karo</a></li>
            <li><a href='create_payments_table.php'>3. Payments Table Create karo</a></li>
            <li><a href='create_reviews_table.php'>4. Reviews Table Create karo</a></li>
            <li><a href='create_bookings_table.php'>5. Bookings Table Create karo</a></li>
            <li><strong><a href='setup_all_tables.php'>⚡ Sab Tables Ek Saath Create karo</a></strong></li>
          </ul>
          </div>";
} else {
    echo "<div style='color:red; font-family:Arial; padding:20px;'>
          ❌ Database creation failed: " . $conn->error . "
          </div>";
}

$conn->close();
?>
