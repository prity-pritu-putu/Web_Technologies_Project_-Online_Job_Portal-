<?php

function admin_getUserAction() {
    if (!isset($_GET['id'])) {
        return null;
    }
    
    require_once 'models/AdminEditUserModel.php';
    return admin_getUserById($_GET['id']);
}

function admin_updateUserAction() {
    if (!isset($_POST['user_id']) || !isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['role'])) {
        return ['success' => false, 'message' => 'All fields are required.'];
    }
    
    $userId = $_POST['user_id'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($email) || empty($role)) {
        return ['success' => false, 'message' => 'Username, email, and role are required.'];
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Invalid email format.'];
    }
    
    if (!in_array($role, ['jobseeker', 'employer'])) {
        return ['success' => false, 'message' => 'Invalid role.'];
    }
    
    require_once 'models/AdminEditUserModel.php';
    
    // Check if username or email already exists for other users
    if (admin_usernameExistsForOtherUser($username, $userId)) {
        return ['success' => false, 'message' => 'Username already exists.'];
    }
    
    if (admin_emailExistsForOtherUser($email, $userId)) {
        return ['success' => false, 'message' => 'Email already exists.'];
    }
    
    $result = admin_updateUser($userId, $username, $email, $role, $password);
    
    if ($result) {
        return ['success' => true, 'message' => 'User updated successfully.'];
    } else {
        return ['success' => false, 'message' => 'Failed to update user.'];
    }
}
?>
