<?php

require_once 'models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Handle login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role']; // 'manager' or 'employee'

                // Redirect based on role
                if ($user['role'] === 'manager') {
                    header('Location: /routes.php?action=view_users');
                } else {
                    header('Location: /routes.php?action=view_requests');
                }
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        }
        require 'views/auth/login.php'; // Load the login form
    }

    // Handle logout
    public function logout() {
        session_destroy();
        header('Location: /routes.php?action=login');
        exit();
    }
}
