<?php
require_once 'Database.php';

function application_updateStatus($applicationId, $status) {
    $conn = getDBConnection();
    $query = "UPDATE applications SET status = '$status' WHERE id = '$applicationId'";
    return mysqli_query($conn, $query);
}
?>
