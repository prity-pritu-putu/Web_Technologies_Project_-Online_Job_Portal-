<?php
require_once 'models/ApplicationUpdateModel.php';

function application_updateStatusAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $applicationId = $_POST['application_id'];
        $status = $_POST['status'];
        
        if (empty($applicationId) || empty($status)) {
            return array('success' => false, 'message' => 'Invalid data');
        }
        
        if (application_updateStatus($applicationId, $status)) {
            return array('success' => true, 'message' => 'Status updated successfully');
        } else {
            return array('success' => false, 'message' => 'Failed to update status');
        }
    }
}
?>
