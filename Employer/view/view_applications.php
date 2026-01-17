<!DOCTYPE html>
<html>
<head>
    <title>Applications - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Job Applications</h1>
        <div class="nav">
            <a href="index.php?page=employer_dashboard">Dashboard</a>
            <a href="index.php?page=post_job">Post Job</a>
            <a href="index.php?page=my_jobs">My Jobs</a>
            <a href="index.php?page=view_applications">Applications</a>
            <a href="index.php?page=edit_employer_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <h2>Job Applications</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['application_id'])) {
        require_once 'controllers/ApplicationUpdateController.php';
        $result = application_updateStatusAction();
        if ($result['success']) {
            echo '<p class="success">' . $result['message'] . '</p>';
        } else {
            echo '<p class="error">' . $result['message'] . '</p>';
        }
    }
    ?>
    
    <?php
        require_once 'controllers/EmployerController.php';
        $applications = employer_viewApplicationsAction();
        ?>
        
        <table>
            <tr>
                <th>Job Title</th>
                <th>Applicant Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Applied At</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($applications as $app): ?>
            <tr>
                <td><?php echo isset($app['job_title']) ? $app['job_title'] : 'N/A'; ?></td>
                <td><?php echo $app['full_name']; ?></td>
                <td><?php echo $app['email']; ?></td>
                <td><?php echo $app['phone']; ?></td>
                <td>
                    <span class="status-<?php echo $app['status']; ?>">
                        <?php echo ucfirst($app['status']); ?>
                    </span>
                </td>
                <td><?php echo $app['applied_at']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                        <select name="status">
                            <option value="pending" <?php echo $app['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="accepted" <?php echo $app['status'] == 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                            <option value="rejected" <?php echo $app['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                        <button type="submit" class="btn-blue">Update</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
</body>
</html>
