CREATE TABLE `referrals` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ref_code` VARCHAR(32) NOT NULL UNIQUE,
    `coins` INT NOT NULL DEFAULT 0,
    `email` VARCHAR(120),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `referral_clicks` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ref_code` VARCHAR(32) NOT NULL,
    `visitor_fp` VARCHAR(64) NOT NULL,
    `visitor_ip` VARCHAR(64) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `tiktok_entries` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ref_code` VARCHAR(32) NOT NULL,
    `tiktok_url` VARCHAR(255) NOT NULL,
    `approved` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `redemptions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ref_code` VARCHAR(32) NOT NULL,
    `prize` VARCHAR(64) NOT NULL,
    `coins_spent` INT NOT NULL,
    `email` VARCHAR(120),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);