<?php
require_once 'Database.php';
 
function employer_getMyJobs($employerId) {
    $conn = getDBConnection();
    $query = "SELECT * FROM jobs WHERE employer_id = '$employerId' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);
   
    $jobs = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
    }
    return $jobs;
}
 
function employer_searchMyJobs($employerId, $searchTerm) {
    $conn = getDBConnection();
    $query = "SELECT * FROM jobs
              WHERE employer_id = '$employerId'
              AND (title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%' OR requirements LIKE '%$searchTerm%')
              ORDER BY created_at DESC";
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