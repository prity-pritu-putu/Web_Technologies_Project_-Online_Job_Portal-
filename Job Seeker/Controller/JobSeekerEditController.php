<?php
require_once 'models/JobSeekerModel.php';

function jobSeeker_editProfileAction() {
    $userId = $_SESSION['user_id'];
    return jobSeeker_getProfileByUserId($userId);
}
?>
