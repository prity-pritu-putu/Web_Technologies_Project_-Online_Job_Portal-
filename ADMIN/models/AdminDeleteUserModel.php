<?php
require_once 'Database.php';

function admin_deleteUser($userId) {
    $conn = getDBConnection();
    $query = "DELETE FROM users WHERE id = '$userId'";
    return mysqli_query($conn, $query);
}
?>
