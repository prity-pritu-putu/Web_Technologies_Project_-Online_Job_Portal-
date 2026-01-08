<?php
require_once 'models/JobSeekerModel.php';

function jobSeeker_updateProfileAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userId = $_SESSION['user_id'];
        $fullName = trim($_POST['full_name']);
        $phone = trim($_POST['phone']);
        
        if (empty($fullName) || empty($phone)) {
            return array('success' => false, 'message' => 'All fields are required');
        }
        
        if (jobSeeker_updateProfile($userId, $fullName, $phone)) {
            return array('success' => true, 'message' => 'Profile updated successfully');
        } else {
            return array('success' => false, 'message' => 'Failed to update profile');
        }
    }
}
?>
