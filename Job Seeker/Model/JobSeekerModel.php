<?php
require_once 'Database.php';

function jobSeeker_createProfile($userId, $fullName, $phone) {
    $conn = getDBConnection();
    $query = "INSERT INTO job_seekers (user_id, full_name, phone) 
              VALUES ('$userId', '$fullName', '$phone')";
    return mysqli_query($conn, $query);
}

function jobSeeker_getProfileByUserId($userId) {
    $conn = getDBConnection();
    $query = "SELECT * FROM job_seekers WHERE user_id = '$userId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function jobSeeker_updateProfile($userId, $fullName, $phone) {
    $conn = getDBConnection();
    $query = "UPDATE job_seekers 
              SET full_name = '$fullName', phone = '$phone' 
              WHERE user_id = '$userId'";
    return mysqli_query($conn, $query);
}
?>
