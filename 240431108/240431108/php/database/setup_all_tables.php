<?php
// ============================================================
//  setup_all_tables.php  —  MASTER SETUP FILE
//  Ek click mein Database + Saare 5 Tables create karo!
//  URL: http://localhost/Food Website/php/database/setup_all_tables.php
// ============================================================

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Luxe Hotel - Database Setup</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 40px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            text-align: center;
            color: #0f3460;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .result {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
        .icon { font-size: 22px; }
        .summary {
            margin-top: 25px;
            padding: 20px;
            background: linear-gradient(135deg, #0f3460, #1a1a2e);
            color: white;
            border-radius: 12px;
            text-align: center;
        }
        .summary h3 { margin-bottom: 10px; font-size: 20px; }
        .summary p { font-size: 14px; opacity: 0.9; }
        .table-name { font-weight: bold; }
        .columns { font-size: 12px; color: #888; margin-top: 3px; }
    </style>
</head>
<body>
<div class='container'>
    <h1>🏨 Luxe Hotel & Dine</h1>
    <p class='subtitle'>Database Setup — XAMPP Server</p>";

$success_count = 0;
$total_tables = 5;

// ========== STEP 1: Create Database ==========
$conn = new mysqli('localhost', 'root', '');

if ($conn->connect_error) {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>MySQL Connection Failed: " . $conn->connect_error . "<br>
          <small>XAMPP mein Apache aur MySQL start karo!</small></div>
          </div>";
    echo "</div></body></html>";
    exit;
}

$sql = "CREATE DATABASE IF NOT EXISTS `food_website`
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci";

if ($conn->query($sql) === TRUE) {
    echo "<div class='result success'>
          <span class='icon'>✅</span>
          <div><span class='table-name'>Database 'food_website'</span> — Created / Already exists</div>
          </div>";
} else {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>Database creation failed: " . $conn->error . "</div>
          </div>";
}

$conn->close();

// ========== STEP 2: Connect to food_website & Create Tables ==========
$conn = new mysqli('localhost', 'root', '', 'food_website');

if ($conn->connect_error) {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>Cannot connect to food_website: " . $conn->connect_error . "</div>
          </div>";
    echo "</div></body></html>";
    exit;
}

$conn->set_charset('utf8mb4');

// ---------- TABLE 1: users ----------
$sql1 = "CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT          NOT NULL AUTO_INCREMENT,
    `full_name`  VARCHAR(100) NOT NULL,
    `email`      VARCHAR(150) NOT NULL UNIQUE,
    `phone`      VARCHAR(20)  NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql1) === TRUE) {
    $success_count++;
    echo "<div class='result success'>
          <span class='icon'>✅</span>
          <div><span class='table-name'>Table 1: users</span> — Sign Up / Login
          <div class='columns'>Columns: id, full_name, email, phone, password, created_at</div></div>
          </div>";
} else {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>users table failed: " . $conn->error . "</div>
          </div>";
}

// ---------- TABLE 2: orders ----------
$sql2 = "CREATE TABLE IF NOT EXISTS `orders` (
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

if ($conn->query($sql2) === TRUE) {
    $success_count++;
    echo "<div class='result success'>
          <span class='icon'>✅</span>
          <div><span class='table-name'>Table 2: orders</span> — Food Order Form
          <div class='columns'>Columns: id, user_name, phone, address, food_item, quantity, total_price, status, ordered_at</div></div>
          </div>";
} else {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>orders table failed: " . $conn->error . "</div>
          </div>";
}

// ---------- TABLE 3: payments ----------
$sql3 = "CREATE TABLE IF NOT EXISTS `payments` (
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

if ($conn->query($sql3) === TRUE) {
    $success_count++;
    echo "<div class='result success'>
          <span class='icon'>✅</span>
          <div><span class='table-name'>Table 3: payments</span> — Payment / Checkout
          <div class='columns'>Columns: id, full_name, email, address, city, zip_code, card_name, card_last4, amount, status, paid_at</div></div>
          </div>";
} else {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>payments table failed: " . $conn->error . "</div>
          </div>";
}

// ---------- TABLE 4: reviews ----------
$sql4 = "CREATE TABLE IF NOT EXISTS `reviews` (
    `id`          INT          NOT NULL AUTO_INCREMENT,
    `guest_name`  VARCHAR(100) NOT NULL,
    `email`       VARCHAR(150) NOT NULL,
    `rating`      TINYINT      NOT NULL DEFAULT 5
                               CHECK (`rating` BETWEEN 1 AND 5),
    `review_text` TEXT         NOT NULL,
    `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql4) === TRUE) {
    $success_count++;
    echo "<div class='result success'>
          <span class='icon'>✅</span>
          <div><span class='table-name'>Table 4: reviews</span> — Guest Reviews / Feedback
          <div class='columns'>Columns: id, guest_name, email, rating (1-5), review_text, created_at</div></div>
          </div>";
} else {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>reviews table failed: " . $conn->error . "</div>
          </div>";
}

// ---------- TABLE 5: bookings ----------
$sql5 = "CREATE TABLE IF NOT EXISTS `bookings` (
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

if ($conn->query($sql5) === TRUE) {
    $success_count++;
    echo "<div class='result success'>
          <span class='icon'>✅</span>
          <div><span class='table-name'>Table 5: bookings</span> — Room Booking
          <div class='columns'>Columns: id, user_name, email, phone, room_type, check_in, check_out, guests, total_price, status, booked_at</div></div>
          </div>";
} else {
    echo "<div class='result error'>
          <span class='icon'>❌</span>
          <div>bookings table failed: " . $conn->error . "</div>
          </div>";
}

$conn->close();

// ========== Summary ==========
if ($success_count === $total_tables) {
    echo "<div class='summary'>
          <h3>🎉 Setup Complete!</h3>
          <p>Database 'food_website' + $success_count/$total_tables tables successfully created!</p>
          <p style='margin-top:10px; font-size:13px;'>Ab phpMyAdmin mein check karo: <strong>http://localhost/phpmyadmin</strong></p>
          </div>";
} else {
    echo "<div class='summary' style='background: linear-gradient(135deg, #dc3545, #721c24);'>
          <h3>⚠️ Partial Setup</h3>
          <p>$success_count/$total_tables tables created. Errors upar dekho.</p>
          </div>";
}

echo "</div></body></html>";
?>
