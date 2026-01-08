<?php
require_once 'Database.php';

function jobSeeker_getApplicationCount($seekerId) {
    $conn = getDBConnection();
    $query = "SELECT COUNT(*) as total FROM applications WHERE seeker_id = '$seekerId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function jobSeeker_getRecentApplications($seekerId, $limit = 5) {
    $conn = getDBConnection();
    $query = "SELECT a.*, j.title, e.company_name 
              FROM applications a 
              LEFT JOIN jobs j ON a.job_id = j.id 
              LEFT JOIN employers e ON j.employer_id = e.id 
              WHERE a.seeker_id = '$seekerId' 
              ORDER BY a.applied_at DESC 
              LIMIT $limit";
    $result = mysqli_query($conn, $query);
    
    $applications = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $applications[] = $row;
        }
    }
    return $applications;
}
?>
