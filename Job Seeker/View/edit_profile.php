<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Edit Profile</h1>
        <div class="nav">
            <a href="index.php?page=jobseeker_dashboard">Dashboard</a>
            <a href="index.php?page=browse_jobs">Browse Jobs</a>
            <a href="index.php?page=my_applications">My Applications</a>
            <a href="index.php?page=edit_jobseeker_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <h2>Edit Profile</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'controllers/JobSeekerUpdateController.php';
            $result = jobSeeker_updateProfileAction();
            if ($result['success']) {
                echo '<p class="success">' . $result['message'] . '</p>';
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        
        require_once 'controllers/JobSeekerEditController.php';
        $profile = jobSeeker_editProfileAction();
        ?>
        
        <form id="editProfileForm" method="POST" action="">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $profile['full_name']; ?>">
                <span class="error" id="fullNameError"></span>
            </div>
            
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" id="phone" value="<?php echo $profile['phone']; ?>">
                <span class="error" id="phoneError"></span>
            </div>
            
            <button type="submit" class="btn-blue">Update Profile</button>
        </form>
    </div>

    <script>
        document.getElementById('editProfileForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            document.getElementById('fullNameError').textContent = '';
            document.getElementById('phoneError').textContent = '';
            
            const fullName = document.getElementById('full_name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            
            if (fullName === '') {
                document.getElementById('fullNameError').textContent = 'Full name is required';
                isValid = false;
            }
            
            if (phone === '') {
                document.getElementById('phoneError').textContent = 'Phone is required';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
