<?php

// Start the session to track user login status
session_start();

// Determine the action from the query string
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Function to verify login for protected routes
function checkLogin($role = null) {
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login if the user is not logged in
        header('Location: /routes.php?action=login');
        exit();
    }

    // If a specific role is required, verify user's role
    if ($role && $_SESSION['role'] !== $role) {
        // Redirect to login if the user does not have the required role
        header('Location: /routes.php?action=login');
        exit();
    }
}

// Routes for authentication
if ($action === 'login') {
    require_once 'controllers/AuthController.php';
    $authController = new AuthController();
    $authController->login();
} elseif ($action === 'logout') {
    require_once 'controllers/AuthController.php';
    $authController = new AuthController();
    $authController->logout();

// Routes for manager
} elseif ($action === 'view_users') {
    checkLogin('manager'); // Ensure only managers have access
    require_once 'controllers/ManagerController.php';
    $managerController = new ManagerController();
    $managerController->viewUsers();
} elseif ($action === 'create_user') {
    checkLogin('manager');
    require_once 'controllers/ManagerController.php';
    $managerController = new ManagerController();
    $managerController->createUser();
} elseif ($action === 'delete_user') {
    checkLogin('manager');
    require_once 'controllers/ManagerController.php';
    $managerController = new ManagerController();
    $managerController->deleteUser();
} elseif ($action === 'update_user') {
    checkLogin('manager');
    require_once 'controllers/ManagerController.php';
    $managerController = new ManagerController();
    $managerController->updateUser();

// Routes for employee
} elseif ($action === 'view_requests') {
    checkLogin('employee'); // Ensure only employees have access
    require_once 'controllers/EmployeeController.php';
    $employeeController = new EmployeeController();
    $employeeController->viewRequests();
} elseif ($action === 'create_request') {
    checkLogin('employee');
    require_once 'controllers/EmployeeController.php';
    $employeeController = new EmployeeController();
    $employeeController->createRequest();
} elseif ($action === 'delete_request') {
    checkLogin('employee');
    require_once 'controllers/EmployeeController.php';
    $employeeController = new EmployeeController();
    $employeeController->deleteRequest();

// Default action if no valid route is provided
} else {
    header('Location: /routes.php?action=login');
    exit();
}
