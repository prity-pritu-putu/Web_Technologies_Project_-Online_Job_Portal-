<?php
require_once 'Database.php';

function employer_createProfile($userId, $companyName, $contact, $address = '') {
    $conn = getDBConnection();
    $query = "INSERT INTO employers (user_id, company_name, contact, address) 
              VALUES ('$userId', '$companyName', '$contact', '$address')";
    return mysqli_query($conn, $query);
}

function employer_getProfileByUserId($userId) {
    $conn = getDBConnection();
    $query = "SELECT * FROM employers WHERE user_id = '$userId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function employer_updateProfile($userId, $companyName, $contact, $address) {
    $conn = getDBConnection();
    $query = "UPDATE employers 
              SET company_name = '$companyName', contact = '$contact', address = '$address' 
              WHERE user_id = '$userId'";
    return mysqli_query($conn, $query);
}
?>
