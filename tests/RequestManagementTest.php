<?php
require_once 'models/RequestModel.php';

class RequestManagementTest {
    private $requestModel;

    public function __construct() {
        $this->requestModel = new RequestModel();
    }

    public function testCreateRequest() {
        $request = [
            'employee_id' => 1,
            'date_from' => '2023-12-01',
            'date_to' => '2023-12-10',
            'reason' => 'Vacation',
            'status' => 'pending'
        ];
        $result = $this->requestModel->createRequest($request);
        assert($result === true, 'Failed to create request');
    }

    public function testGetRequestsByEmployeeId() {
        $employee_id = 1;
        $requests = $this->requestModel->getRequestsByEmployeeId($employee_id);
        assert(!empty($requests), 'Failed to get requests by employee ID');
    }

    // Add more test cases as needed
}

$test = new RequestManagementTest();
$test->testCreateRequest();
$test->testGetRequestsByEmployeeId();