<?php
require_once 'models/UserModel.php';

class UserManagementTest {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function testCreateUser() {
        $user = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'employee_code' => 'EMP001',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'role' => 'employee'
        ];
        $result = $this->userModel->createUser($user);
        assert($result === true, 'Failed to create user');
    }

    public function testGetUserByEmail() {
        $email = 'testuser@example.com';
        $user = $this->userModel->getUserByEmail($email);
        assert($user !== false, 'Failed to get user by email');
    }

    // Add more test cases as needed
}

$test = new UserManagementTest();
$test->testCreateUser();
$test->testGetUserByEmail();