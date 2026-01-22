<?php
require_once 'models/UserModel.php';
require_once 'models/Job SeekerModel.php';
require_once 'models/EmployerModel.php';

function auth_loginAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $remember = isset($_POST['remember']) ? $_POST['remember'] : false;
        
        if (empty($username) || empty($password)) {
            return array('success' => false, 'message' => 'All fields are required');
        }
        
        $user = verifyLogin($username, $password);
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            if ($remember) {
                setcookie('user_id', $user['id'], time() + (30 * 60), '/');
            }
            
            return array('success' => true, 'role' => $user['role']);
        } else {
            return array('success' => false, 'message' => 'Invalid username or password');
        }
    }
}

function auth_registerAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $email = trim($_POST['email']);
        $role = $_POST['role'];
        
        if (empty($username) || empty($password) || empty($email) || empty($role)) {
            return array('success' => false, 'message' => 'All fields are required');
        }
        
        if (strlen($username) < 3) {
            return array('success' => false, 'message' => 'Username must be at least 3 characters');
        }
        
        if (strlen($password) < 6) {
            return array('success' => false, 'message' => 'Password must be at least 6 characters');
        }
        
        if (checkUsernameExists($username)) {
            return array('success' => false, 'message' => 'Username already exists');
        }
        
        if (checkEmailExists($email)) {
            return array('success' => false, 'message' => 'Email already exists');
        }
        
        $userId = createUser($username, $password, $email, $role);
        
        if ($userId) {
            if ($role == 'jobseeker') {
                $fullName = trim($_POST['full_name']);
                $phone = trim($_POST['phone']);
                
                if (empty($fullName) || empty($phone)) {
                    return array('success' => false, 'message' => 'Full name and phone are required');
                }
                
                jobSeeker_createProfile($userId, $fullName, $phone);
                
            } elseif ($role == 'employer') {
                $companyName = trim($_POST['company_name']);
                $contact = trim($_POST['contact']);
                $address = trim($_POST['address']);
                
                if (empty($companyName) || empty($contact)) {
                    return array('success' => false, 'message' => 'Company name and contact are required');
                }
                
                employer_createProfile($userId, $companyName, $contact, $address);
            }
            
            return array('success' => true, 'message' => 'Registration successful');
        } else {
            return array('success' => false, 'message' => 'Registration failed');
        }
    }
}

function auth_logoutAction() {
    session_destroy();
    setcookie('user_id', '', time() - 3600, '/');
    header('Location: index.php?page=login');
    exit();
}

function auth_checkCookie() {
    if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
        $user = getUserById($_COOKIE['user_id']);
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        } else {
            setcookie('user_id', '', time() - 3600, '/');
        }
    }
    return false;
}
?>
