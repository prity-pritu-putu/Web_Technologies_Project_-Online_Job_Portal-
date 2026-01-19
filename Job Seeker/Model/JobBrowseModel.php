<?php
require_once 'Database.php';

function job_getAvailableJobs() {
    $conn = getDBConnection();
    $query = "SELECT j.*, e.company_name 
              FROM jobs j 
              LEFT JOIN employers e ON j.employer_id = e.id 
              WHERE j.status = 'active' 
              ORDER BY j.created_at DESC";
    $result = mysqli_query($conn, $query);
    
    $jobs = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
    }
    return $jobs;
}

function job_searchJobs($searchTerm) {
    $conn = getDBConnection();
    $query = "SELECT j.*, e.company_name 
              FROM jobs j 
              LEFT JOIN employers e ON j.employer_id = e.id 
              WHERE j.status = 'active' 
              AND (j.title LIKE '%$searchTerm%' OR e.company_name LIKE '%$searchTerm%') 
              ORDER BY j.created_at DESC";
    $result = mysqli_query($conn, $query);
    
    $jobs = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
    }
    return $jobs;
}
?>
