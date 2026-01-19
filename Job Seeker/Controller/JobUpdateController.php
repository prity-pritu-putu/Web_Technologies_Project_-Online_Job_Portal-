<?php
require_once 'models/JobUpdateModel.php';

function job_updateJobAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $jobId = $_POST['job_id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $requirements = trim($_POST['requirements']);
        $salary = trim($_POST['salary']);
        $status = $_POST['status'];
        
        if (empty($jobId) || empty($title) || empty($description)) {
            return array('success' => false, 'message' => 'Job ID, title and description are required');
        }
        
        if (job_updateJob($jobId, $title, $description, $requirements, $salary, $status)) {
            return array('success' => true, 'message' => 'Job updated successfully');
        } else {
            return array('success' => false, 'message' => 'Failed to update job');
        }
    }
}
?>
