<!DOCTYPE html>
<html>
<head>
    <title>Job Seeker Dashboard - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Job Seeker Dashboard - <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <div class="nav">
            <a href="index.php?page=jobseeker_dashboard">Dashboard</a>
            <a href="index.php?page=browse_jobs">Browse Jobs</a>
            <a href="index.php?page=my_applications">My Applications</a>
            <a href="index.php?page=edit_jobseeker_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <div class="welcome-message">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
    </div>
    
    <?php
        require_once 'controllers/JobSeekerController.php';
        $data = jobSeeker_dashboardAction();
        ?>
        
        <div class="profile-box">
            <h3>Profile Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($data['profile']['full_name']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($data['profile']['phone']); ?></p>
        </div>
        
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo $data['applicationCount']; ?></h3>
                <p>Total Applications</p>
            </div>
        </div>
        
        <h3>Recent Applications</h3>
        <?php if (empty($data['recentApplications'])): ?>
            <p>No applications yet. <a href="index.php?page=browse_jobs">Browse jobs</a> to apply!</p>
        <?php else: ?>
        <table>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Status</th>
                <th>Applied At</th>
            </tr>
            <?php foreach ($data['recentApplications'] as $app): ?>
            <tr>
                <td><?php echo htmlspecialchars($app['title']); ?></td>
                <td><?php echo htmlspecialchars($app['company_name']); ?></td>
                <td><span class="status-<?php echo $app['status']; ?>"><?php echo ucfirst($app['status']); ?></span></td>
                <td><?php echo $app['applied_at']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
</body>
</html>
