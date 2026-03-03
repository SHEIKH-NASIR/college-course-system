<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard - College Course System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #141e30, #243b55);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', sans-serif;
}

.dashboard-card {
    width: 100%;
    max-width: 600px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    text-align: center;
    color: white;
}

.dashboard-title {
    font-weight: 600;
    margin-bottom: 10px;
}

.role-text {
    margin-bottom: 30px;
    font-size: 18px;
    opacity: 0.8;
}

.btn-custom {
    padding: 14px;
    font-size: 16px;
    border-radius: 10px;
    margin-bottom: 15px;
    transition: 0.3s;
}

.btn-primary-custom {
    background: #00c6ff;
    border: none;
}

.btn-success-custom {
    background: #00f260;
    border: none;
}

.btn-danger-custom {
    background: #ff416c;
    border: none;
}

.btn-primary-custom:hover,
.btn-success-custom:hover,
.btn-danger-custom:hover {
    transform: scale(1.05);
    opacity: 0.9;
}
</style>
</head>

<body>

<div class="dashboard-card">

<h2 class="dashboard-title">College Course System</h2>
<p class="role-text">Welcome, <strong><?php echo $_SESSION['role']; ?></strong></p>

<div class="d-grid">

<a href="add_course.php" class="btn btn-primary-custom btn-custom text-white">
<i class="fas fa-plus-circle me-2"></i> Add Course
</a>

<a href="view_courses.php" class="btn btn-success-custom btn-custom text-white">
<i class="fas fa-table me-2"></i> View Courses
</a>

<a href="logout.php" class="btn btn-danger-custom btn-custom text-white">
<i class="fas fa-sign-out-alt me-2"></i> Logout
</a>

</div>

</div>

</body>
</html>
