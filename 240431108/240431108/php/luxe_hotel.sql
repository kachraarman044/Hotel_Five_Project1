-- ============================================================
--  luxe_hotel.sql
--  Import this file in phpMyAdmin:
--  1. Open phpMyAdmin  →  http://localhost/phpmyadmin
--  2. Click "New" → Database name: luxe_hotel → Create
--  3. Select luxe_hotel → Click "Import" → Choose this file → Go
-- ============================================================

CREATE DATABASE IF NOT EXISTS `luxe_hotel`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `luxe_hotel`;

-- ------------------------------------------------------------
-- TABLE 1 : users  (Sign Up / Login)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id`         INT          NOT NULL AUTO_INCREMENT,
  `full_name`  VARCHAR(100) NOT NULL,
  `email`      VARCHAR(150) NOT NULL UNIQUE,
  `phone`      VARCHAR(20)  NOT NULL,
  `password`   VARCHAR(255) NOT NULL,        -- stored as bcrypt hash
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- TABLE 2 : orders  (Food Order Form)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
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

-- ------------------------------------------------------------
-- TABLE 3 : payments  (Payment / Checkout Form)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `payments` (
  `id`           INT           NOT NULL AUTO_INCREMENT,
  `full_name`    VARCHAR(100)  NOT NULL,
  `email`        VARCHAR(150)  NOT NULL,
  `address`      VARCHAR(255)  NOT NULL,
  `city`         VARCHAR(100)  NOT NULL,
  `zip_code`     VARCHAR(20)   NOT NULL,
  `card_name`    VARCHAR(100)  NOT NULL,
  `card_last4`   CHAR(4)       NOT NULL,      -- store ONLY last 4 digits
  `amount`       DECIMAL(10,2) NOT NULL DEFAULT 2290.00,
  `status`       ENUM('pending','success','failed')
                               NOT NULL DEFAULT 'pending',
  `paid_at`      TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- TABLE 4 : reviews  (Guest Review / Feedback)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `reviews` (
  `id`          INT          NOT NULL AUTO_INCREMENT,
  `guest_name`  VARCHAR(100) NOT NULL,
  `email`       VARCHAR(150) NOT NULL,
  `rating`      TINYINT      NOT NULL DEFAULT 5
                             CHECK (`rating` BETWEEN 1 AND 5),
  `review_text` TEXT         NOT NULL,
  `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- TABLE 5 : bookings  (Room Booking)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookings` (
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
-- Done! 5 tables created:
--   users, orders, payments, reviews, bookings
-- ============================================================
