<?php
function getDBConnection() {
    $host = 'localhost';
    $db_name = 'job_portal';
    $username = 'root';
    $password = '';
    
    $conn = mysqli_connect($host, $username, $password, $db_name);
    
    if (!$conn) {
        die('Connection Error: ' . mysqli_connect_error());
    }
    
    return $conn;
}
?>
