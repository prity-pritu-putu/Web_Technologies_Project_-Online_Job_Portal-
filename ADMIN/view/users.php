<!DOCTYPE html>
<html>
<head>
    <title>Manage Users - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Manage Users</h1>
        <div class="nav">
            <a href="index.php?page=admin_dashboard">Dashboard</a>
            <a href="index.php?page=admin_users">Users</a>
            <a href="index.php?page=admin_jobs">Jobs</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <h2>All Users</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
        require_once 'controllers/AdminDeleteUserController.php';
        $result = admin_deleteUserAction();
        if ($result['success']) {
            echo '<p class="success">' . $result['message'] . '</p>';
        } else {
            echo '<p class="error">' . $result['message'] . '</p>';
        }
    }
    ?>
    
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search users...">
    </div>
    
    <div id="usersTable">
            <?php
            require_once 'controllers/AdminController.php';
            // Check if it's a search request
            if (isset($_GET['search'])) {
                $users = admin_searchUsersAction();
            } else {
                $users = admin_viewUsersAction();
            }
            ?>
            
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td><?php echo $user['created_at']; ?></td>
                    <td>
                        <?php if ($user['role'] != 'admin'): ?>
                        <a href="index.php?page=edit_user&id=<?php echo $user['id']; ?>" class="btn-blue">Edit</a>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn-red" onclick="return confirm('Delete this user?')">Delete</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.trim();
            
            if (searchTerm.length > 0) {
                fetch('index.php?page=search_users&search=' + searchTerm)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const newTable = doc.getElementById('usersTable');
                        if (newTable) {
                            document.getElementById('usersTable').innerHTML = newTable.innerHTML;
                        }
                    });
            } else {
                location.reload();
            }
        });
    </script>
</body>
</html>
