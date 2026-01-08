<?php
require_once 'Database.php';

function admin_getTotalUsers() {
    $conn = getDBConnection();
    $query = "SELECT COUNT(*) as total FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function admin_getTotalJobs() {
    $conn = getDBConnection();
    $query = "SELECT COUNT(*) as total FROM jobs";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function admin_getTotalApplications() {
    $conn = getDBConnection();
    $query = "SELECT COUNT(*) as total FROM applications";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}
?>
