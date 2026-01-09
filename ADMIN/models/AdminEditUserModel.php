<?php

require_once 'models/Database.php';

function admin_getUserById($userId) {
    $db = getDBConnection();
    $query = "SELECT id, username, email, role FROM users WHERE id = '$userId'";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);
    $db->close();
    return $user;
}

function admin_usernameExistsForOtherUser($username, $userId) {
    $db = getDBConnection();
    $query = "SELECT id FROM users WHERE username = '$username' AND id != '$userId'";
    $result = mysqli_query($db, $query);
    $exists = mysqli_num_rows($result) > 0;
    $db->close();
    return $exists;
}

function admin_emailExistsForOtherUser($email, $userId) {
    $db = getDBConnection();
    $query = "SELECT id FROM users WHERE email = '$email' AND id != '$userId'";
    $result = mysqli_query($db, $query);
    $exists = mysqli_num_rows($result) > 0;
    $db->close();
    return $exists;
}

function admin_updateUser($userId, $username, $email, $role, $password) {
    $db = getDBConnection();
    
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET username = '$username', email = '$email', role = '$role', password = '$hashedPassword' WHERE id = '$userId'";
    } else {
        $query = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE id = '$userId'";
    }
    
    $result = mysqli_query($db, $query);
    $db->close();
    return $result;
}
?>
