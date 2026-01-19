<?php
require_once 'models/JobPostModel.php';
require_once 'models/EmployerModel.php';

function job_createJobAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $requirements = trim($_POST['requirements']);
        $salary = trim($_POST['salary']);
        $userId = $_SESSION['user_id'];
        
        if (empty($title) || empty($description)) {
            return array('success' => false, 'message' => 'Title and description are required');
        }
        
        $profile = employer_getProfileByUserId($userId);
        
        if (!$profile) {
            return array('success' => false, 'message' => 'Employer profile not found');
        }
        
        if (job_createJob($profile['id'], $title, $description, $requirements, $salary)) {
            return array('success' => true, 'message' => 'Job posted successfully');
        } else {
            return array('success' => false, 'message' => 'Failed to post job');
        }
    }
}
?>
