<?php
session_start();

require_once 'shared/controllers/AuthController.php';
AuthController::checkCookie();

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

if (!isset($_SESSION['user_id']) && $page != 'register') {
    $page = 'login';
}

switch($page) {
    case 'login':
        include 'shared/views/login.php';
        break;
        
    case 'register':
        include 'shared/views/register.php';
        break;
        
    case 'logout':
        require_once 'shared/controllers/AuthController.php';
        AuthController::logoutAction();
        break;
        
    case 'admin_dashboard':
        if($_SESSION['role'] == 'admin') {
            include 'ADMIN/view/dashboard.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'admin_users':
        if($_SESSION['role'] == 'admin') {
            include 'ADMIN/view/users.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'admin_jobs':
        if($_SESSION['role'] == 'admin') {
            include 'ADMIN/view/jobs.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_user':
        if($_SESSION['role'] == 'admin') {
            include 'ADMIN/view/edit_user.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'search_users':
        if($_SESSION['role'] == 'admin') {
            include 'ADMIN/view/users.php';
        }
        break;
        
    case 'jobseeker_dashboard':
        if($_SESSION['role'] == 'jobseeker') {
            include 'Job Seeker/View/dashboard.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'browse_jobs':
        if($_SESSION['role'] == 'jobseeker') {
            include 'Job Seeker/View/browse_jobs.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'search_jobs':
        if($_SESSION['role'] == 'jobseeker') {
            include 'Job Seeker/View/browse_jobs.php';
        }
        break;
        
    case 'my_applications':
        if($_SESSION['role'] == 'jobseeker') {
            include 'Job Seeker/View/my_applications.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_jobseeker_profile':
        if($_SESSION['role'] == 'jobseeker') {
            include 'Job Seeker/View/edit_profile.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'employer_dashboard':
        if($_SESSION['role'] == 'employer') {
            include 'Employer/view/dashboard.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'post_job':
        if($_SESSION['role'] == 'employer') {
            include 'Employer/view/post_job.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'my_jobs':
        if($_SESSION['role'] == 'employer') {
            include 'Employer/view/my_jobs.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_job':
        if($_SESSION['role'] == 'employer') {
            include 'Employer/view/edit_job.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'view_applications':
        if($_SESSION['role'] == 'employer') {
            include 'Employer/view/view_applications.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_employer_profile':
        if($_SESSION['role'] == 'employer') {
            include 'Employer/view/edit_profile.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    default:
        include 'shared/views/login.php';
}
?>
