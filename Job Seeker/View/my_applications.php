<!DOCTYPE html>
<html>
<head>
    <title>My Applications - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - My Applications</h1>
        <div class="nav">
            <a href="index.php?page=jobseeker_dashboard">Dashboard</a>
            <a href="index.php?page=browse_jobs">Browse Jobs</a>
            <a href="index.php?page=my_applications">My Applications</a>
            <a href="index.php?page=edit_jobseeker_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <h2>My Job Applications</h2>
    
    <?php
        require_once 'controllers/JobApplyController.php';
        $applications = job_viewApplicationsAction();
        ?>
        
        <table>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Applied At</th>
            </tr>
            <?php foreach ($applications as $app): ?>
            <tr>
                <td><?php echo $app['title']; ?></td>
                <td><?php echo $app['company_name']; ?></td>
                <td><?php echo $app['salary']; ?></td>
                <td>
                    <span class="status-<?php echo $app['status']; ?>">
                        <?php echo ucfirst($app['status']); ?>
                    </span>
                </td>
                <td><?php echo $app['applied_at']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
</body>
</html>
