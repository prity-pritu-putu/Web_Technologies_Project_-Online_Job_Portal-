<?php
require_once 'models/AdminDeleteUserModel.php';

function admin_deleteUserAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userId = $_POST['user_id'];
        
        if (empty($userId)) {
            return array('success' => false, 'message' => 'Invalid user ID');
        }
        
        if (admin_deleteUser($userId)) {
            return array('success' => true, 'message' => 'User deleted successfully');
        } else {
            return array('success' => false, 'message' => 'Failed to delete user');
        }
    }
}
?>
