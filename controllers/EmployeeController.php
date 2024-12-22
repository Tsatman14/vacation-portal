<?php

require_once 'models/EmployeeModel.php';

class EmployeeController {
    private $employeeModel;

    public function __construct() {
        $this->employeeModel = new EmployeeModel();
    }

    // View all vacation requests
    public function viewRequests() {
        $employeeId = $_SESSION['user_id'];
        $requests = $this->employeeModel->getRequestsByEmployee($employeeId);
        require 'views/employee/requests.php'; // Load the requests view
    }

    // Create a new vacation request
    public function createRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeId = $_SESSION['user_id'];
            $dateFrom = $_POST['date_from'];
            $dateTo = $_POST['date_to'];
            $reason = $_POST['reason'];

            $this->employeeModel->createRequest($employeeId, $dateFrom, $dateTo, $reason);
            header('Location: /routes.php?action=view_requests');
            exit();
        }
        require 'views/employee/create_request.php'; // Load the create request form
    }

    // Delete a vacation request (only if it is pending)
    public function deleteRequest() {
        $requestId = $_GET['id'];
        $this->employeeModel->deleteRequest($requestId, $_SESSION['user_id']);
        header('Location: /routes.php?action=view_requests');
        exit();
    }
}
