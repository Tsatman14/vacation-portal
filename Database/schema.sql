-- Create the database
CREATE DATABASE company_db;

-- Use the database
USE company_db;

-- Create the users table
CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL UNIQUE,
   employee_code VARCHAR(50) NOT NULL UNIQUE,
   password VARCHAR(255) NOT NULL,
   role ENUM('manager', 'employee') NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the vacation_requests table
CREATE TABLE vacation_requests (
   id INT AUTO_INCREMENT PRIMARY KEY,
   employee_id INT NOT NULL,
   date_from DATE NOT NULL,
   date_to DATE NOT NULL,
   reason TEXT NOT NULL,
   status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
   date_submitted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (employee_id) REFERENCES users(id)
);