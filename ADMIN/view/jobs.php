<!DOCTYPE html>
<html>
<head>
    <title>Manage Jobs - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Manage Jobs</h1>
        <div class="nav">
            <a href="index.php?page=admin_dashboard">Dashboard</a>
            <a href="index.php?page=admin_users">Users</a>
            <a href="index.php?page=admin_jobs">Jobs</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <h2>All Jobs</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
        require_once 'controllers/AdminDeleteJobController.php';
        $result = admin_deleteJobAction();
        if ($result['success']) {
            echo '<p class="success">' . $result['message'] . '</p>';
        } else {
            echo '<p class="error">' . $result['message'] . '</p>';
        }
    }
    ?>
    
    <?php
        require_once 'controllers/AdminController.php';
        $jobs = admin_viewJobsAction();
        ?>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Company</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Posted At</th>
                <th>Action</th>
            </tr>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?php echo $job['id']; ?></td>
                <td><?php echo $job['title']; ?></td>
                <td><?php echo $job['company_name']; ?></td>
                <td><?php echo $job['salary']; ?></td>
                <td><?php echo $job['status']; ?></td>
                <td><?php echo $job['created_at']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                        <button type="submit" class="btn-red" onclick="return confirm('Delete this job?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
</body>
</html>
