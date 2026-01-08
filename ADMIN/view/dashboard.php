<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Admin Dashboard - <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <div class="nav">
            <a href="index.php?page=admin_dashboard">Dashboard</a>
            <a href="index.php?page=admin_users">Users</a>
            <a href="index.php?page=admin_jobs">Jobs</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <div class="welcome-message">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
    </div>
    
    <?php
        require_once 'controllers/AdminController.php';
        $stats = admin_dashboardAction();
        ?>
        
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo $stats['totalUsers']; ?></h3>
                <p>Total Users</p>
            </div>
            <div class="stat-box">
                <h3><?php echo $stats['totalJobs']; ?></h3>
                <p>Total Jobs</p>
            </div>
            <div class="stat-box">
                <h3><?php echo $stats['totalApplications']; ?></h3>
                <p>Total Applications</p>
            </div>
        </div>

