<!DOCTYPE html>
<html>
<head>
    <title>Edit Job - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Edit Job</h1>
        <div class="nav">
            <a href="index.php?page=employer_dashboard">Dashboard</a>
            <a href="index.php?page=post_job">Post Job</a>
            <a href="index.php?page=my_jobs">My Jobs</a>
            <a href="index.php?page=view_applications">Applications</a>
            <a href="index.php?page=edit_employer_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <h2>Edit Job</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'controllers/JobUpdateController.php';
            $result = job_updateJobAction();
            if ($result['success']) {
                echo '<p class="success">' . $result['message'] . '</p>';
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        
        require_once 'controllers/JobEditController.php';
        $job = job_editJobAction();
        
        if (!$job) {
            echo '<p class="error">Job not found</p>';
            exit;
        }
        ?>
        
        <form id="editJobForm" method="POST" action="">
            <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
            
            <div class="form-group">
                <label>Job Title:</label>
                <input type="text" name="title" id="title" value="<?php echo $job['title']; ?>">
                <span class="error" id="titleError"></span>
            </div>
            
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" id="description" rows="5"><?php echo $job['description']; ?></textarea>
                <span class="error" id="descriptionError"></span>
            </div>
            
            <div class="form-group">
                <label>Requirements:</label>
                <textarea name="requirements" id="requirements" rows="3"><?php echo $job['requirements']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Salary:</label>
                <input type="text" name="salary" id="salary" value="<?php echo $job['salary']; ?>">
            </div>
            
            <div class="form-group">
                <label>Status:</label>
                <select name="status" id="status">
                    <option value="active" <?php echo $job['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="closed" <?php echo $job['status'] == 'closed' ? 'selected' : ''; ?>>Closed</option>
                </select>
            </div>
            
            <button type="submit" class="btn-blue">Update Job</button>
            <a href="index.php?page=my_jobs" class="btn-white">Cancel</a>
        </form>
    </div>

    <script>
        document.getElementById('editJobForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            document.getElementById('titleError').textContent = '';
            document.getElementById('descriptionError').textContent = '';
            
            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            
            if (title === '') {
                document.getElementById('titleError').textContent = 'Job title is required';
                isValid = false;
            }
            
            if (description === '') {
                document.getElementById('descriptionError').textContent = 'Description is required';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
