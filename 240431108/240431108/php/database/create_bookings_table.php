<?php
// ============================================================
//  create_bookings_table.php  —  TABLE 5: bookings (Room Booking)
//  URL: http://localhost/Food Website/php/database/create_bookings_table.php
// ============================================================

$conn = new mysqli('localhost', 'root', '', 'luxe_hotel');

if ($conn->connect_error) {
    die("<div style='color:red; font-family:Arial; padding:20px;'>
         ❌ Connection Failed: " . $conn->connect_error . "
         <br>Pehle <a href='create_database.php'>create_database.php</a> run karo!
         </div>");
}

$conn->set_charset('utf8mb4');

$sql = "CREATE TABLE IF NOT EXISTS `bookings` (
    `id`           INT           NOT NULL AUTO_INCREMENT,
    `user_name`    VARCHAR(100)  NOT NULL,
    `email`        VARCHAR(150)  NOT NULL,
    `phone`        VARCHAR(20)   NOT NULL,
    `room_type`    VARCHAR(100)  NOT NULL,
    `check_in`     DATE          NOT NULL,
    `check_out`    DATE          NOT NULL,
    `guests`       INT           NOT NULL DEFAULT 1,
    `total_price`  DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `status`       ENUM('pending','confirmed','cancelled')
                                 NOT NULL DEFAULT 'pending',
    `booked_at`    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family:Arial; padding:20px;'>
          <h2 style='color:green;'>✅ Table 'bookings' created successfully!</h2>
          <p><strong>Columns:</strong> id, user_name, email, phone, room_type, check_in, check_out, guests, total_price, status, booked_at</p>
          <p>Ye table Room Booking ka data store karegi.</p>
          <br><a href='setup_all_tables.php'>⚡ Sab Tables Ek Saath Create karo</a>
          </div>";
} else {
    echo "<div style='color:red; font-family:Arial; padding:20px;'>
          ❌ Error: " . $conn->error . "</div>";
}

$conn->close();
?>
