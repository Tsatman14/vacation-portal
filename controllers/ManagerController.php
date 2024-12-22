<?php

require_once 'models/UserModel.php';

class ManagerController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // View all users
    public function viewUsers() {
        $users = $this->userModel->getAllUsers();
        require 'views/manager/users.php'; // Load the users view
    }

    // Create a new user
    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $employeeCode = $_POST['employee_code'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $this->userModel->createUser($name, $email, $employeeCode, $password);
            header('Location: /routes.php?action=view_users');
            exit();
        }
        require 'views/manager/create_user.php'; // Load the create user form
    }

    // Update a user's details
    public function updateUser() {
        $userId = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $this->userModel->updateUser($userId, $name, $email, $password);
            header('Location: /routes.php?action=view_users');
            exit();
        }
        $user = $this->userModel->getUserById($userId);
        require 'views/manager/update_user.php'; // Load the update user form
    }

    // Delete a user
    public function deleteUser() {
        $userId = $_GET['id'];
        $this->userModel->deleteUser($userId);
        header('Location: /routes.php?action=view_users');
        exit();
    }
}
