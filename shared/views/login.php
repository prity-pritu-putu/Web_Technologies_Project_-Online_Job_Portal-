<!DOCTYPE html>
<html>
<head>
    <title>Login - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Job Portal - Login</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'controllers/AuthController.php';
            $result = auth_loginAction();
            
            if ($result['success']) {
                if ($result['role'] == 'admin') {
                    header('Location: index.php?page=admin_dashboard');
                } elseif ($result['role'] == 'jobseeker') {
                    header('Location: index.php?page=jobseeker_dashboard');
                } elseif ($result['role'] == 'employer') {
                    header('Location: index.php?page=employer_dashboard');
                }
                exit();
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        ?>
        
        <form id="loginForm" method="POST" action="">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" id="username">
                <span class="error" id="usernameError"></span>
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" id="password">
                <span class="error" id="passwordError"></span>
            </div>
            
            <div class="form-group">
                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember">Remember Me</label>
            </div>
            
            <button type="submit" class="btn-blue">Login</button>
        </form>
        
        <p>Don't have an account? <a href="index.php?page=register">Register here</a></p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            document.getElementById('usernameError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            
            if (username === '') {
                document.getElementById('usernameError').textContent = 'Username is required';
                isValid = false;
            }
            
            if (password === '') {
                document.getElementById('passwordError').textContent = 'Password is required';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
