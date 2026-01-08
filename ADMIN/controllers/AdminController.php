<?php
require_once 'models/AdminDashboardModel.php';
require_once 'models/AdminUserListModel.php';
require_once 'models/AdminJobListModel.php';

function admin_dashboardAction() {
    $data = array(
        'totalUsers' => admin_getTotalUsers(),
        'totalJobs' => admin_getTotalJobs(),
        'totalApplications' => admin_getTotalApplications()
    );
    return $data;
}

function admin_viewUsersAction() {
    return admin_getAllUsers();
}

function admin_searchUsersAction() {
    if (isset($_GET['search'])) {
        $searchTerm = trim($_GET['search']);
        return admin_searchUsers($searchTerm);
    }
    return array();
}

function admin_viewJobsAction() {
    return admin_getAllJobs();
}
?>
