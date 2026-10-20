<?php
// ============================================================
//  create_reviews_table.php  —  TABLE 4: reviews (Guest Reviews/Feedback)
//  URL: http://localhost/Food Website/php/database/create_reviews_table.php
// ============================================================

$conn = new mysqli('localhost', 'root', '', 'luxe_hotel');

if ($conn->connect_error) {
    die("<div style='color:red; font-family:Arial; padding:20px;'>
         ❌ Connection Failed: " . $conn->connect_error . "
         <br>Pehle <a href='create_database.php'>create_database.php</a> run karo!
         </div>");
}

$conn->set_charset('utf8mb4');

$sql = "CREATE TABLE IF NOT EXISTS `reviews` (
    `id`          INT          NOT NULL AUTO_INCREMENT,
    `guest_name`  VARCHAR(100) NOT NULL,
    `email`       VARCHAR(150) NOT NULL,
    `rating`      TINYINT      NOT NULL DEFAULT 5
                               CHECK (`rating` BETWEEN 1 AND 5),
    `review_text` TEXT         NOT NULL,
    `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family:Arial; padding:20px;'>
          <h2 style='color:green;'>✅ Table 'reviews' created successfully!</h2>
          <p><strong>Columns:</strong> id, guest_name, email, rating (1-5), review_text, created_at</p>
          <p>Ye table Guest Reviews/Feedback ka data store karegi.</p>
          <br><a href='create_bookings_table.php'>➡️ Next: Bookings Table Create karo</a>
          | <a href='setup_all_tables.php'>⚡ Sab Tables Ek Saath</a>
          </div>";
} else {
    echo "<div style='color:red; font-family:Arial; padding:20px;'>
          ❌ Error: " . $conn->error . "</div>";
}

$conn->close();
?>
