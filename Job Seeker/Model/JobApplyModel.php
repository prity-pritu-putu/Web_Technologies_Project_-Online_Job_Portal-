<?php
require_once 'Database.php';

function job_createApplication($jobId, $seekerId) {
    $conn = getDBConnection();
    $checkQuery = "SELECT * FROM applications WHERE job_id = '$jobId' AND seeker_id = '$seekerId'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        return false;
    }

    $query = "INSERT INTO applications (job_id, seeker_id) VALUES ('$jobId', '$seekerId')";
    return mysqli_query($conn, $query);
}

function job_getApplicationsBySeeker($seekerId) {
    $conn = getDBConnection();
    $query = "SELECT a.*, j.title, j.salary, e.company_name 
              FROM applications a 
              LEFT JOIN jobs j ON a.job_id = j.id 
              LEFT JOIN employers e ON j.employer_id = e.id 
              WHERE a.seeker_id = '$seekerId' 
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
