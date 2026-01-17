<!DOCTYPE html>
<html>
<head>
    <title>Browse Jobs - Job Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <h1>Job Portal - Browse Jobs</h1>
        <div class="nav">
            <a href="index.php?page=jobseeker_dashboard">Dashboard</a>
            <a href="index.php?page=browse_jobs">Browse Jobs</a>
            <a href="index.php?page=my_applications">My Applications</a>
            <a href="index.php?page=edit_jobseeker_profile">Edit Profile</a>
            <a href="index.php?page=logout" class="btn-red">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <h2>Available Jobs</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
            require_once 'controllers/JobApplyController.php';
            $result = job_applyAction();
            if ($result['success']) {
                echo '<p class="success">' . $result['message'] . '</p>';
            } else {
                echo '<p class="error">' . $result['message'] . '</p>';
            }
        }
        ?>
        
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search jobs by title or company...">
        </div>
        
        <div id="jobsContainer">
            <?php
            require_once 'controllers/JobSeekerController.php';
            $jobs = jobSeeker_browseJobsAction();
            
            foreach ($jobs as $job):
            ?>
            <div class="job-card">
                <h3><?php echo $job['title']; ?></h3>
                <p><strong>Company:</strong> <?php echo $job['company_name']; ?></p>
                <p><strong>Salary:</strong> <?php echo $job['salary']; ?></p>
                <p><strong>Description:</strong> <?php echo $job['description']; ?></p>
                <p><strong>Requirements:</strong> <?php echo $job['requirements']; ?></p>
                <form method="POST" action="">
                    <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                    <button type="submit" class="btn-blue">Apply Now</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.trim();
            
            if (searchTerm.length > 0) {
                fetch('index.php?page=search_jobs&search=' + searchTerm)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const newContainer = doc.getElementById('jobsContainer');
                        if (newContainer) {
                            document.getElementById('jobsContainer').innerHTML = newContainer.innerHTML;
                        }
                    });
            } else {
                location.reload();
            }
        });
    </script>
</body>
</html>
