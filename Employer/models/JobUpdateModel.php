<?php
require_once 'Database.php';

function job_updateJob($jobId, $title, $description, $requirements, $salary, $status) {
    $conn = getDBConnection();
    $query = "UPDATE jobs 
              SET title = '$title', description = '$description', 
                  requirements = '$requirements', salary = '$salary', status = '$status' 
              WHERE id = '$jobId'";
    return mysqli_query($conn, $query);
}
?>