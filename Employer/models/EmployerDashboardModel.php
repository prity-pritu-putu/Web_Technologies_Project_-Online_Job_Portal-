<?php
require_once 'Database.php';

function employer_getMyJobsCount($employerId) {
    $conn = getDBConnection();
    $query = "SELECT COUNT(*) as total FROM jobs WHERE employer_id = '$employerId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function employer_getApplicationsCount($employerId) {
    $conn = getDBConnection();
    $query = "SELECT COUNT(*) as total 
              FROM applications a 
              LEFT JOIN jobs j ON a.job_id = j.id 
              WHERE j.employer_id = '$employerId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}
?>
