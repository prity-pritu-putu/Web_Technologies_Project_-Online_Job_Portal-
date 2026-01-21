<?php
session_start();

require_once 'controllers/AuthController.php';
auth_checkCookie();

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

if (!isset($_SESSION['user_id']) && $page != 'register') {
    $page = 'login';
}

switch($page) {
    case 'login':
        include 'views/login.php';
        break;
    
    case 'register':
        include 'views/register.php';
        break;
        
    case 'logout':
        require_once 'controllers/AuthController.php';
        auth_logoutAction();
        break;
        
    case 'admin_dashboard':
        if($_SESSION['role'] == 'admin') {
            include 'views/admin/dashboard.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'admin_users':
        if($_SESSION['role'] == 'admin') {
            include 'views/admin/users.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'admin_jobs':
        if($_SESSION['role'] == 'admin') {
            include 'views/admin/jobs.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_user':
        if($_SESSION['role'] == 'admin') {
            include 'views/admin/edit_user.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'search_users':
        if($_SESSION['role'] == 'admin') {
            include 'views/admin/users.php';
        }
        break;
        
    case 'jobseeker_dashboard':
        if($_SESSION['role'] == 'jobseeker') {
            include 'views/jobseeker/dashboard.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'browse_jobs':
        if($_SESSION['role'] == 'jobseeker') {
            include 'views/jobseeker/browse_jobs.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'search_jobs':
        if($_SESSION['role'] == 'jobseeker') {
            include 'views/jobseeker/browse_jobs.php';
        }
        break;
        
    case 'my_applications':
        if($_SESSION['role'] == 'jobseeker') {
            include 'views/jobseeker/my_applications.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_jobseeker_profile':
        if($_SESSION['role'] == 'jobseeker') {
            include 'views/jobseeker/edit_profile.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'employer_dashboard':
        if($_SESSION['role'] == 'employer') {
            include 'views/employer/dashboard.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'post_job':
        if($_SESSION['role'] == 'employer') {
            include 'views/employer/post_job.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'my_jobs':
        if($_SESSION['role'] == 'employer') {
            include 'views/employer/my_jobs.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_job':
        if($_SESSION['role'] == 'employer') {
            include 'views/employer/edit_job.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'view_applications':
        if($_SESSION['role'] == 'employer') {
            include 'views/employer/view_applications.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    case 'edit_employer_profile':
        if($_SESSION['role'] == 'employer') {
            include 'views/employer/edit_profile.php';
        } else {
            header('Location: index.php');
        }
        break;
        
    default:
        include 'views/login.php';
}
?>
