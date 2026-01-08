<!DOCTYPE html>
<html>
<head>
    <title>Edit User - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Edit User</h1>
        <div class="nav">
            <a href="index.php?page=admin_dashboard">Dashboard</a>
            <a href="index.php?page=admin_users">Users</a>
            <a href="index.php?page=admin_jobs">Jobs</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <h2>Edit User</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once 'controllers/AdminEditUserController.php';
        $result = admin_updateUserAction();
        if ($result['success']) {
            echo '<p class="success">' . $result['message'] . '</p>';
        } else {
            echo '<p class="error">' . $result['message'] . '</p>';
        }
    }
    
    require_once 'controllers/AdminEditUserController.php';
    $userData = admin_getUserAction();
    
    if (!$userData) {
        echo '<p class="error">User not found.</p>';
        echo '</body></html>';
        exit;
    }
    ?>
    
    <form method="POST" action="">
        <input type="hidden" name="user_id" value="<?php echo $userData['id']; ?>">
        
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Role:</label>
            <select name="role" required>
                <option value="jobseeker" <?php echo $userData['role'] == 'jobseeker' ? 'selected' : ''; ?>>Job Seeker</option>
                <option value="employer" <?php echo $userData['role'] == 'employer' ? 'selected' : ''; ?>>Employer</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>New Password (Leave blank to keep current):</label>
            <input type="password" name="password">
        </div>
        
        <button type="submit" class="btn-blue">Update User</button>
        <a href="index.php?page=admin_users" class="btn-white">Cancel</a>
    </form>
</body>
</html>
