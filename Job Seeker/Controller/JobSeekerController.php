<?php
require_once 'models/JobSeekerModel.php';
require_once 'models/JobSeekerDashboardModel.php';
require_once 'models/JobBrowseModel.php';

function jobSeeker_dashboardAction() {
    $userId = $_SESSION['user_id'];
    
    $profile = jobSeeker_getProfileByUserId($userId);
    
    if ($profile) {
        $data = array(
            'profile' => $profile,
            'applicationCount' => jobSeeker_getApplicationCount($profile['id']),
            'recentApplications' => jobSeeker_getRecentApplications($profile['id'])
        );
        return $data;
    }
    return array();
}

function jobSeeker_browseJobsAction() {
    return job_getAvailableJobs();
}

function jobSeeker_searchJobsAction() {
    if (isset($_GET['search'])) {
        $searchTerm = trim($_GET['search']);
        return job_searchJobs($searchTerm);
    }
    return array();
}
?>
