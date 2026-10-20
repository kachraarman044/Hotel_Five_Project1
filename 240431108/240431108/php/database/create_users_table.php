<?php
// ============================================================
//  create_users_table.php  —  TABLE 1: users (Sign Up / Login)
//  URL: http://localhost/Food Website/php/database/create_users_table.php
// ============================================================

$conn = new mysqli('localhost', 'root', '', 'luxe_hotel');

if ($conn->connect_error) {
    die("<div style='color:red; font-family:Arial; padding:20px;'>
         ❌ Connection Failed: " . $conn->connect_error . "
         <br>Pehle <a href='create_database.php'>create_database.php</a> run karo!
         </div>");
}

$conn->set_charset('utf8mb4');

$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT          NOT NULL AUTO_INCREMENT,
    `full_name`  VARCHAR(100) NOT NULL,
    `email`      VARCHAR(150) NOT NULL UNIQUE,
    `phone`      VARCHAR(20)  NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family:Arial; padding:20px;'>
          <h2 style='color:green;'>✅ Table 'users' created successfully!</h2>
          <p><strong>Columns:</strong> id, full_name, email, phone, password, created_at</p>
          <p>Ye table Sign Up aur Login ke liye use hogi.</p>
          <br><a href='create_orders_table.php'>➡️ Next: Orders Table Create karo</a>
          | <a href='setup_all_tables.php'>⚡ Sab Tables Ek Saath</a>
          </div>";
} else {
    echo "<div style='color:red; font-family:Arial; padding:20px;'>
          ❌ Error: " . $conn->error . "</div>";
}

$conn->close();
?>
