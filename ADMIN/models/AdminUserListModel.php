<?php
require_once 'Database.php';

function admin_getAllUsers() {
    $conn = getDBConnection();
    $query = "SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);
    
    $users = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    return $users;
}

function admin_searchUsers($searchTerm) {
    $conn = getDBConnection();
    $query = "SELECT id, username, email, role, created_at FROM users 
              WHERE username LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' 
              ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);
    
    $users = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    return $users;
}
?>
