-- ============================================================
--  food_website_full_import.sql
--  XAMPP phpMyAdmin mein Import karne ke liye:
--  1. Open phpMyAdmin  →  http://localhost/phpmyadmin
--  2. Left side mein "New" click karo (ya food_website select karo agar already hai)
--  3. Top mein "Import" tab click karo
--  4. "Choose File" → ye file select karo → "Go" button dabao
--  Done! Database + Saare 5 tables ban jayenge ✅
-- ============================================================

-- Database create karo (agar nahi hai)
CREATE DATABASE IF NOT EXISTS `food_website`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `food_website`;

-- ============================================================
-- TABLE 1 : users  (Sign Up / Login ke liye)
-- ============================================================
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id`         INT          NOT NULL AUTO_INCREMENT,
  `full_name`  VARCHAR(100) NOT NULL,
  `email`      VARCHAR(150) NOT NULL UNIQUE,
  `phone`      VARCHAR(20)  NOT NULL,
  `password`   VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 2 : orders  (Food Order Form ke liye)
-- ============================================================
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 3 : payments  (Payment / Checkout ke liye)
-- ============================================================
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 4 : reviews  (Guest Review / Feedback ke liye)
-- ============================================================
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id`          INT          NOT NULL AUTO_INCREMENT,
  `guest_name`  VARCHAR(100) NOT NULL,
  `email`       VARCHAR(150) NOT NULL,
  `rating`      TINYINT      NOT NULL DEFAULT 5
                             CHECK (`rating` BETWEEN 1 AND 5),
  `review_text` TEXT         NOT NULL,
  `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE 5 : bookings  (Room Booking ke liye)
-- ============================================================
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- ✅ Done! Database: food_website
-- ✅ 5 tables created:
--   1. users     — Sign Up / Login
--   2. orders    — Food Order
--   3. payments  — Payment / Checkout
--   4. reviews   — Guest Feedback
--   5. bookings  — Room Booking
-- ============================================================
