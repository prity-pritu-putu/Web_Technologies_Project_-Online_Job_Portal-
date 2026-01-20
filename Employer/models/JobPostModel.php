<?php
require_once 'Database.php';

function job_createJob($employerId, $title, $description, $requirements, $salary) {
    $conn = getDBConnection();
    $query = "INSERT INTO jobs (employer_id, title, description, requirements, salary, status) 
              VALUES ('$employerId', '$title', '$description', '$requirements', '$salary', 'active')";
    return mysqli_query($conn, $query);
}
?>
