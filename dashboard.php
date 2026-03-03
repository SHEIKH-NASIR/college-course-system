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
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['name']; ?></h2>
<br><br>
<a href="add_course.php">
<button>Add Course</button>
</a>

<br><br>

<a href="view_courses.php">
<button>View Courses</button>
</a>
<p>Role: <?php echo $_SESSION['role']; ?></p>

<br>

<a href="logout.php">Logout</a>

</body>
</html>