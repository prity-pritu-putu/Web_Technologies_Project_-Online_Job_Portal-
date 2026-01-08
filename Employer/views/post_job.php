<!DOCTYPE html>
<html>
<head>
    <title>Post Job - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Post New Job</h1>
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
        <h2>Post a New Job</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'controllers/JobPostController.php';
            $result = job_createJobAction();
            if ($result['success']) {
                echo '<p class="success">' . $result['message'] . '</p>';
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        ?>
        
        <form id="postJobForm" method="POST" action="">
            <div class="form-group">
                <label>Job Title:</label>
                <input type="text" name="title" id="title">
                <span class="error" id="titleError"></span>
            </div>
            
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" id="description" rows="5"></textarea>
                <span class="error" id="descriptionError"></span>
            </div>
            
            <div class="form-group">
                <label>Requirements:</label>
                <textarea name="requirements" id="requirements" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label>Salary:</label>
                <input type="text" name="salary" id="salary">
            </div>
            
            <button type="submit" class="btn-blue">Post Job</button>
        </form>
    </div>

    <script>
        document.getElementById('postJobForm').addEventListener('submit', function(e) {
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
