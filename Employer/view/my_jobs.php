<!DOCTYPE html>
<html>
<head>
    <title>My Jobs - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - My Jobs</h1>
        <div class="nav">
            <a href="index.php?page=employer_dashboard">Dashboard</a>
            <a href="index.php?page=post_job">Post Job</a>
            <a href="index.php?page=my_jobs">My Jobs</a>
            <a href="index.php?page=view_applications">Applications</a>
            <a href="index.php?page=edit_employer_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
   
    <h2>My Posted Jobs</h2>
   
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
        require_once 'controllers/JobDeleteController.php';
        $result = job_deleteJobAction();
        if ($result['success']) {
            echo '<p class="success">' . $result['message'] . '</p>';
        } else {
            echo '<p class="error">' . $result['message'] . '</p>';
        }
    }
    ?>
   
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search jobs by title, description, or requirements...">
    </div>
   
    <div id="jobsTable">
        <?php
        require_once 'controllers/EmployerController.php';
        // Check if it's a search request
        if (isset($_GET['search'])) {
            $jobs = employer_searchMyJobsAction();
        } else {
            $jobs = employer_viewMyJobsAction();
        }
        ?>
       
        <table>
            <tr>
                <th>Title</th>
                <th>Salary</th>
                <th>Status</th>
                <th>Posted At</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?php echo $job['title']; ?></td>
                <td><?php echo $job['salary']; ?></td>
                <td><?php echo $job['status']; ?></td>
                <td><?php echo $job['created_at']; ?></td>
                <td>
                    <a href="index.php?page=edit_job&id=<?php echo $job['id']; ?>" class="btn-blue">Edit</a>
                    <a href="index.php?page=view_applications&job_id=<?php echo $job['id']; ?>" class="btn-blue">View Applications</a>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                        <button type="submit" class="btn-red" onclick="return confirm('Delete this job?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
 
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.trim();
           
            if (searchTerm.length > 0) {
                fetch('index.php?page=search_employer_jobs&search=' + searchTerm)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const newTable = doc.getElementById('jobsTable');
                        if (newTable) {
                            document.getElementById('jobsTable').innerHTML = newTable.innerHTML;
                        }
                    });
            } else {
                location.reload();
            }
        });
    </script>
</body>
</html>