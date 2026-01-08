<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Employer Dashboard - <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <div class="nav">
            <a href="index.php?page=employer_dashboard">Dashboard</a>
            <a href="index.php?page=post_job">Post Job</a>
            <a href="index.php?page=my_jobs">My Jobs</a>
            <a href="index.php?page=view_applications">Applications</a>
            <a href="index.php?page=edit_employer_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <div class="welcome-message">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
    </div>
    
    <?php
        require_once 'controllers/EmployerController.php';
        $data = employer_dashboardAction();
        ?>
        
        <div class="profile-box">
            <h3>Company Information</h3>
            <p><strong>Company:</strong> <?php echo htmlspecialchars($data['profile']['company_name']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($data['profile']['contact']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($data['profile']['address']); ?></p>
        </div>
        
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo $data['jobsCount']; ?></h3>
                <p>Jobs Posted</p>
            </div>
            <div class="stat-box">
                <h3><?php echo $data['applicationsCount']; ?></h3>
                <p>Applications Received</p>
            </div>
        </div>

