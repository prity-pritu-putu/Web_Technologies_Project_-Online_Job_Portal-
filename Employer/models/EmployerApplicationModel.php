<?php
require_once 'Database.php';

function employer_getApplicationsForMyJobs($employerId) {
    $conn = getDBConnection();
    $query = "SELECT a.*, j.title as job_title, js.full_name, js.phone, u.email 
              FROM applications a 
              LEFT JOIN jobs j ON a.job_id = j.id 
              LEFT JOIN job_seekers js ON a.seeker_id = js.id 
              LEFT JOIN users u ON js.user_id = u.id 
              WHERE j.employer_id = '$employerId' 
              ORDER BY a.applied_at DESC";
    $result = mysqli_query($conn, $query);
    
    $applications = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $applications[] = $row;
        }
    }
    return $applications;
}

function employer_getApplicationsByJobId($jobId) {
    $conn = getDBConnection();
    $query = "SELECT a.*, js.full_name, js.phone, u.email 
              FROM applications a 
              LEFT JOIN job_seekers js ON a.seeker_id = js.id 
              LEFT JOIN users u ON js.user_id = u.id 
              WHERE a.job_id = '$jobId' 
              ORDER BY a.applied_at DESC";
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
