-- Create the database
CREATE DATABASE IF NOT EXISTS agapeo_orphanage;

-- Select the database
USE agapeo_orphanage;

-- Create the admins table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create the images table
CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a default admin user (username: admin, password: admin123)
INSERT INTO admins (username, password) VALUES (
    'admin', 
    '$2y$10$3fQz7z9y9Xz8z9y9Xz8z9u9y9Xz8z9y9Xz8z9y9Xz8z9y9Xz8z9'
);