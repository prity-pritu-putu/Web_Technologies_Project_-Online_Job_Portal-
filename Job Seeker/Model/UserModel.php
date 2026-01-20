<?php
require_once 'Database.php';

function createUser($username, $password, $email, $role) {
    $conn = getDBConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (username, password, email, role) 
              VALUES ('$username', '$hashedPassword', '$email', '$role')";
    
    if (mysqli_query($conn, $query)) {
        return mysqli_insert_id($conn);
    }
    return false;
}

function verifyLogin($username, $password) {
    $conn = getDBConnection();
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}

function getUserById($id) {
    $conn = getDBConnection();
    $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function checkUsernameExists($username) {
    $conn = getDBConnection();
    $query = "SELECT id FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function checkEmailExists($email) {
    $conn = getDBConnection();
    $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}
?>
