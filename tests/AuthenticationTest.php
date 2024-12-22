<?php
require_once 'controllers/AuthController.php';

class AuthenticationTest {
    private $authController;

    public function __construct() {
        $this->authController = new AuthController();
    }

    public function testLogin() {
        $_POST['email'] = 'testuser@example.com';
        $_POST['password'] = 'password';
        ob_start();
        $this->authController->login();
        $output = ob_get_clean();
        assert(strpos($output, 'Invalid email or password.') === false, 'Failed to login');
    }

    // Add more test cases as needed
}

$test = new AuthenticationTest();
$test->testLogin();