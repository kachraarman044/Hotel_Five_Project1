<?php
// ============================================================
//  create_payments_table.php  —  TABLE 3: payments (Payment / Checkout)
//  URL: http://localhost/Food Website/php/database/create_payments_table.php
// ============================================================

$conn = new mysqli('localhost', 'root', '', 'luxe_hotel');

if ($conn->connect_error) {
    die("<div style='color:red; font-family:Arial; padding:20px;'>
         ❌ Connection Failed: " . $conn->connect_error . "
         <br>Pehle <a href='create_database.php'>create_database.php</a> run karo!
         </div>");
}

$conn->set_charset('utf8mb4');

$sql = "CREATE TABLE IF NOT EXISTS `payments` (
    `id`           INT           NOT NULL AUTO_INCREMENT,
    `full_name`    VARCHAR(100)  NOT NULL,
    `email`        VARCHAR(150)  NOT NULL,
    `address`      VARCHAR(255)  NOT NULL,
    `city`         VARCHAR(100)  NOT NULL,
    `zip_code`     VARCHAR(20)   NOT NULL,
    `card_name`    VARCHAR(100)  NOT NULL,
    `card_last4`   CHAR(4)       NOT NULL,
    `amount`       DECIMAL(10,2) NOT NULL DEFAULT 2290.00,
    `status`       ENUM('pending','success','failed')
                                 NOT NULL DEFAULT 'pending',
    `paid_at`      TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family:Arial; padding:20px;'>
          <h2 style='color:green;'>✅ Table 'payments' created successfully!</h2>
          <p><strong>Columns:</strong> id, full_name, email, address, city, zip_code, card_name, card_last4, amount, status, paid_at</p>
          <p>Ye table Payment/Checkout form ka data store karegi. Sirf card ke last 4 digits save hote hain (security).</p>
          <br><a href='create_reviews_table.php'>➡️ Next: Reviews Table Create karo</a>
          | <a href='setup_all_tables.php'>⚡ Sab Tables Ek Saath</a>
          </div>";
} else {
    echo "<div style='color:red; font-family:Arial; padding:20px;'>
          ❌ Error: " . $conn->error . "</div>";
}

$conn->close();
?>
