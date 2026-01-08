<?php
require_once 'models/AdminDeleteJobModel.php';

function admin_deleteJobAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $jobId = $_POST['job_id'];
        
        if (empty($jobId)) {
            return array('success' => false, 'message' => 'Invalid job ID');
        }
        
        if (admin_deleteJob($jobId)) {
            return array('success' => true, 'message' => 'Job deleted successfully');
        } else {
            return array('success' => false, 'message' => 'Failed to delete job');
        }
    }
}
?>
