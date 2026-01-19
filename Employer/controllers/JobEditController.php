<?php
require_once 'models/JobEditModel.php';

function job_editJobAction() {
    if (isset($_GET['id'])) {
        $jobId = $_GET['id'];
        return job_getJobById($jobId);
    }
    return false;
}
?>
