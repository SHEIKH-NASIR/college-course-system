<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<h2>View Courses</h2>

<form method="GET">
Academic Year:
<input type="text" name="year" required>

Semester:
<input type="text" name="semester" required>

<button type="submit">View</button>
</form>

<?php
if(isset($_GET['year']) && isset($_GET['semester'])){

$year = $_GET['year'];
$semester = $_GET['semester'];

$result = $conn->query("
SELECT courses.*, programs.program_name
FROM courses
JOIN programs ON courses.program_id = programs.id
WHERE academic_year='$year' AND semester='$semester'
ORDER BY course_name
");

echo "<h3>Year: $year | Semester: $semester</h3>";

echo '<a href="export_excel.php?year='.$year.'&semester='.$semester.'">
<button>Export to Excel</button>
</a>

<button onclick="window.print()">Print</button><br><br>';

echo "<table border='1'>
<tr>
<th>Program</th>
<th>Course</th>
<th>Code</th>
<th>Type</th>
<th>Students</th>
<th>Lectures</th>
<th>Lab</th>
<th>Room</th>
</tr>";

while($row = $result->fetch_assoc()){
echo "<tr>
<td>".$row['program_name']."</td>
<td>".$row['course_name']."</td>
<td>".$row['course_code']."</td>
<td>".$row['course_type']."</td>
<td>".$row['total_students']."</td>
<td>".$row['lectures_per_week']."</td>
<td>".$row['lab_name']."</td>
<td>".$row['lab_room']."</td>
</tr>";
}

echo "</table>";
}
?>

<br><br>
<a href="dashboard.php">Back to Dashboard</a>