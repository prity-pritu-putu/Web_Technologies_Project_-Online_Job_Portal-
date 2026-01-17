<?php
require_once 'Database.php';

function admin_getAllJobs() {
    $conn = getDBConnection();
    $query = "SELECT j.*, e.company_name 
              FROM jobs j 
              LEFT JOIN employers e ON j.employer_id = e.id 
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
