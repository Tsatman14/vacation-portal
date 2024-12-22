<?php

require_once 'database/Database.php';

class EmployeeModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Fetch all vacation requests by employee
    public function getRequestsByEmployee($employeeId) {
        $stmt = $this->db->prepare("SELECT * FROM vacation_requests WHERE employee_id = ? ORDER BY date_submitted DESC");
        $stmt->bind_param("i", $employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Create a new vacation request
    public function createRequest($employeeId, $dateFrom, $dateTo, $reason) {
        $stmt = $this->db->prepare("INSERT INTO vacation_requests (employee_id, date_from, date_to, reason, status, date_submitted) VALUES (?, ?, ?, ?, 'pending', NOW())");
        $stmt->bind_param("isss", $employeeId, $dateFrom, $dateTo, $reason);
        $stmt->execute();
    }

    // Delete a vacation request (only if it is pending)
    public function deleteRequest($requestId, $employeeId) {
        $stmt = $this->db->prepare("DELETE FROM vacation_requests WHERE id = ? AND employee_id = ? AND status = 'pending'");
        $stmt->bind_param("ii", $requestId, $employeeId);
        $stmt->execute();
    }
}
