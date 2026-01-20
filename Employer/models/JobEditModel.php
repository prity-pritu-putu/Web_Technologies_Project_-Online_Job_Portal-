<?php
require_once 'Database.php';

function job_getJobById($jobId) {
    $conn = getDBConnection();
    $query = "SELECT * FROM jobs WHERE id = '$jobId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}
?>
