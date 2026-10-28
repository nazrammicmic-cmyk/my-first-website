CREATE DATABASE IF NOT EXISTS sfhs_complaints CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sfhs_complaints;
CREATE TABLE IF NOT EXISTS admins (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, full_name VARCHAR(120) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS complaints (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, tracking_code VARCHAR(32) NOT NULL UNIQUE,
 category VARCHAR(80) NOT NULL, subject VARCHAR(180) NOT NULL, details TEXT NOT NULL,
 is_anonymous TINYINT(1) NOT NULL DEFAULT 1, reporter_name VARCHAR(120) NULL,
 reporter_contact VARCHAR(190) NULL,
 status ENUM('New','In Review','Action Taken','Closed') NOT NULL DEFAULT 'New',
 admin_notes TEXT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 INDEX(status), INDEX(created_at)
);
INSERT INTO admins(full_name,email,password_hash) VALUES
('School Administrator','admin@sfhs.local','$2y$12$0.PHQ6KFNekvq2YC1pOlxu7wVCN8TLPQEBiubtaETlCBkyRcESluC')
ON DUPLICATE KEY UPDATE email=VALUES(email);
