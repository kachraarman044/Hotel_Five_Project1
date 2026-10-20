<?php
// ============================================================
//  create_orders_table.php  —  TABLE 2: orders (Food Order Form)
//  URL: http://localhost/Food Website/php/database/create_orders_table.php
// ============================================================

$conn = new mysqli('localhost', 'root', '', 'luxe_hotel');

if ($conn->connect_error) {
    die("<div style='color:red; font-family:Arial; padding:20px;'>
         ❌ Connection Failed: " . $conn->connect_error . "
         <br>Pehle <a href='create_database.php'>create_database.php</a> run karo!
         </div>");
}

$conn->set_charset('utf8mb4');

$sql = "CREATE TABLE IF NOT EXISTS `orders` (
    `id`           INT           NOT NULL AUTO_INCREMENT,
    `user_name`    VARCHAR(100)  NOT NULL,
    `phone`        VARCHAR(20)   NOT NULL,
    `address`      VARCHAR(255)  NOT NULL,
    `food_item`    VARCHAR(100)  NOT NULL,
    `quantity`     INT           NOT NULL DEFAULT 1,
    `total_price`  DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `status`       ENUM('pending','confirmed','delivered','cancelled')
                                 NOT NULL DEFAULT 'pending',
    `ordered_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family:Arial; padding:20px;'>
          <h2 style='color:green;'>✅ Table 'orders' created successfully!</h2>
          <p><strong>Columns:</strong> id, user_name, phone, address, food_item, quantity, total_price, status, ordered_at</p>
          <p>Ye table Food Order form ka data store karegi.</p>
          <br><a href='create_payments_table.php'>➡️ Next: Payments Table Create karo</a>
          | <a href='setup_all_tables.php'>⚡ Sab Tables Ek Saath</a>
          </div>";
} else {
    echo "<div style='color:red; font-family:Arial; padding:20px;'>
          ❌ Error: " . $conn->error . "</div>";
}

$conn->close();
?>
