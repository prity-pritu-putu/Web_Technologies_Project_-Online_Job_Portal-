<?php
require_once 'models/JobApplyModel.php';
require_once 'models/JobSeekerModel.php';

function job_applyAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $jobId = $_POST['job_id'];
        $userId = $_SESSION['user_id'];
        
        if (empty($jobId)) {
            return array('success' => false, 'message' => 'Invalid job ID');
        }
        
        $profile = jobSeeker_getProfileByUserId($userId);
        
        if (!$profile) {
            return array('success' => false, 'message' => 'Profile not found');
        }
        
        if (job_createApplication($jobId, $profile['id'])) {
            return array('success' => true, 'message' => 'Application submitted successfully');
        } else {
            return array('success' => false, 'message' => 'Already applied or error occurred');
        }
    }
}

function job_viewApplicationsAction() {
    $userId = $_SESSION['user_id'];
    
    $profile = jobSeeker_getProfileByUserId($userId);
    
    if ($profile) {
        return job_getApplicationsBySeeker($profile['id']);
    }
    return array();
}
?>
