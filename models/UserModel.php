<?php

require_once 'database/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Fetch all users
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT id, name, email, employee_code FROM users WHERE role = 'employee'");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch a single user by ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch a user by email (used for login)
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Create a new user
    public function createUser($name, $email, $employeeCode, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, employee_code, password, role) VALUES (?, ?, ?, ?, 'employee')");
        $stmt->bind_param("ssss", $name, $email, $employeeCode, $password);
        $stmt->execute();
    }

    // Update a user's information
    public function updateUser($id, $name, $email, $password) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $password, $id);
        $stmt->execute();
    }

    // Delete a user and all associated data
    public function deleteUser($id) {
        // Delete vacation requests associated with the user
        $stmt = $this->db->prepare("DELETE FROM vacation_requests WHERE employee_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Delete the user
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
