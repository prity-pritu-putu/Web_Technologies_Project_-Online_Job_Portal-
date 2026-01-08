<?php
require_once 'models/EmployerModel.php';

function employer_editProfileAction() {
    $userId = $_SESSION['user_id'];
    return employer_getProfileByUserId($userId);
}
?>
