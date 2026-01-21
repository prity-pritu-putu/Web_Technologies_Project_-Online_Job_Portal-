<?php
require_once 'models/EmployerModel.php';
require_once 'models/EmployerDashboardModel.php';
require_once 'models/EmployerJobListModel.php';
require_once 'models/EmployerApplicationModel.php';
 
function employer_dashboardAction() {
    $userId = $_SESSION['user_id'];
   
    $profile = employer_getProfileByUserId($userId);
   
    if ($profile) {
        $data = array(
            'profile' => $profile,
            'jobsCount' => employer_getMyJobsCount($profile['id']),
            'applicationsCount' => employer_getApplicationsCount($profile['id'])
        );
        return $data;
    }
    return array();
}
 
function employer_viewMyJobsAction() {
    $userId = $_SESSION['user_id'];
   
    $profile = employer_getProfileByUserId($userId);
   
    if ($profile) {
        return employer_getMyJobs($profile['id']);
    }
    return array();
}
 
function employer_viewApplicationsAction() {
    $userId = $_SESSION['user_id'];
   
    $profile = employer_getProfileByUserId($userId);
   
    if ($profile) {
        if (isset($_GET['job_id'])) {
            return employer_getApplicationsByJobId($_GET['job_id']);
        } else {
            return employer_getApplicationsForMyJobs($profile['id']);
        }
    }
    return array();
}
 
function employer_searchMyJobsAction() {
    if (isset($_GET['search'])) {
        $userId = $_SESSION['user_id'];
        $searchTerm = trim($_GET['search']);
       
        $profile = employer_getProfileByUserId($userId);
       
        if ($profile) {
            return employer_searchMyJobs($profile['id'], $searchTerm);
        }
    }
    return array();
}
?>