<?php
require_once 'models/EmployerModel.php';

function employer_updateProfileAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userId = $_SESSION['user_id'];
        $companyName = trim($_POST['company_name']);
        $contact = trim($_POST['contact']);
        $address = trim($_POST['address']);
        
        if (empty($companyName) || empty($contact)) {
            return array('success' => false, 'message' => 'Company name and contact are required');
        }
        
        if (employer_updateProfile($userId, $companyName, $contact, $address)) {
            return array('success' => true, 'message' => 'Profile updated successfully');
        } else {
            return array('success' => false, 'message' => 'Failed to update profile');
        }
    }
}
?>
