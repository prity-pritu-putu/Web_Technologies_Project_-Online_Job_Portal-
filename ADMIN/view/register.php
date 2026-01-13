<!DOCTYPE html>
<html>
<head>
    <title>Register - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Job Portal - Register</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'controllers/AuthController.php';
            $result = auth_registerAction();
            
            if ($result['success']) {
                echo '<p class="success">' . $result['message'] . '</p>';
                echo '<p><a href="index.php?page=login">Login here</a></p>';
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        ?>
        
        <form id="registerForm" method="POST" action="">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" id="username">
                <span class="error" id="usernameError"></span>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" id="email">
                <span class="error" id="emailError"></span>
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" id="password">
                <span class="error" id="passwordError"></span>
            </div>
            
            <div class="form-group">
                <label>Role:</label>
                <select name="role" id="role">
                    <option value="">Select Role</option>
                    <option value="jobseeker">Job Seeker</option>
                    <option value="employer">Employer</option>
                </select>
                <span class="error" id="roleError"></span>
            </div>
            
            <div id="jobseekerFields" style="display:none;">
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="full_name" id="full_name">
                    <span class="error" id="fullNameError"></span>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone" id="phone">
                    <span class="error" id="phoneError"></span>
                </div>
            </div>
            
            <div id="employerFields" style="display:none;">
                <div class="form-group">
                    <label>Company Name:</label>
                    <input type="text" name="company_name" id="company_name">
                    <span class="error" id="companyNameError"></span>
                </div>
                <div class="form-group">
                    <label>Contact:</label>
                    <input type="text" name="contact" id="contact">
                    <span class="error" id="contactError"></span>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <textarea name="address" id="address"></textarea>
                </div>
            </div>
            
            <button type="submit" class="btn-blue">Register</button>
        </form>
        
        <p>Already have an account? <a href="index.php?page=login">Login here</a></p>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            const role = this.value;
            
            document.getElementById('jobseekerFields').style.display = 'none';
            document.getElementById('employerFields').style.display = 'none';
            
            if (role === 'jobseeker') {
                document.getElementById('jobseekerFields').style.display = 'block';
            } else if (role === 'employer') {
                document.getElementById('employerFields').style.display = 'block';
            }
        });
        
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            document.getElementById('usernameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('roleError').textContent = '';
            
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;
            
            if (username === '') {
                document.getElementById('usernameError').textContent = 'Username is required';
                isValid = false;
            } else if (username.length < 3) {
                document.getElementById('usernameError').textContent = 'Username must be at least 3 characters';
                isValid = false;
            }
            
            if (email === '') {
                document.getElementById('emailError').textContent = 'Email is required';
                isValid = false;
            } else if (!email.includes('@') || !email.includes('.')) {
                document.getElementById('emailError').textContent = 'Invalid email format';
                isValid = false;
            }
            
            if (password === '') {
                document.getElementById('passwordError').textContent = 'Password is required';
                isValid = false;
            } else if (password.length < 6) {
                document.getElementById('passwordError').textContent = 'Password must be at least 6 characters';
                isValid = false;
            }
            
            if (role === '') {
                document.getElementById('roleError').textContent = 'Please select a role';
                isValid = false;
            }
            
            if (role === 'jobseeker') {
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
            }
            
            if (role === 'employer') {
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
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
