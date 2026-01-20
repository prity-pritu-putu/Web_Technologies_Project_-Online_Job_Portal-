<?php
require_once 'Database.php';

function job_deleteJob($jobId) {
    $conn = getDBConnection();
    $query = "DELETE FROM jobs WHERE id = '$jobId'";
    return mysqli_query($conn, $query);
}
?>
