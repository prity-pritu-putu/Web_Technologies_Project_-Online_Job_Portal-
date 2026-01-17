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
            <a href="index.php?page=employer_dashboard">Dashboard</a>
            <a href="index.php?page=post_job">Post Job</a>
            <a href="index.php?page=my_jobs">My Jobs</a>
            <a href="index.php?page=view_applications">Applications</a>
            <a href="index.php?page=edit_employer_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <h2>Edit Company Profile</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'controllers/EmployerUpdateController.php';
            $result = employer_updateProfileAction();
            if ($result['success']) {
                echo '<p class="success">' . $result['message'] . '</p>';
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        
        require_once 'controllers/EmployerEditController.php';
        $profile = employer_editProfileAction();
        ?>
        
        <form id="editProfileForm" method="POST" action="">
            <div class="form-group">
                <label>Company Name:</label>
                <input type="text" name="company_name" id="company_name" value="<?php echo $profile['company_name']; ?>">
                <span class="error" id="companyNameError"></span>
            </div>
            
            <div class="form-group">
                <label>Contact:</label>
                <input type="text" name="contact" id="contact" value="<?php echo $profile['contact']; ?>">
                <span class="error" id="contactError"></span>
            </div>
            
            <div class="form-group">
                <label>Address:</label>
                <textarea name="address" id="address" rows="3"><?php echo $profile['address']; ?></textarea>
            </div>
            
            <button type="submit" class="btn-blue">Update Profile</button>
        </form>
    </div>

    <script>
        document.getElementById('editProfileForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            document.getElementById('companyNameError').textContent = '';
            document.getElementById('contactError').textContent = '';
            
            const companyName = document.getElementById('company_name').value.trim();
            const contact = document.getElementById('contact').value.trim();
            
            if (companyName === '') {
                document.getElementById('companyNameError').textContent = 'Company name is required';
                isValid = false;
            }
            
            if (contact === '') {
                document.getElementById('contactError').textContent = 'Contact is required';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
