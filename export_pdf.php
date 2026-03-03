<?php
include "db.php";

if(!isset($_GET['program_id']) || !isset($_GET['year']) || !isset($_GET['semester'])){
    die("Invalid Request");
}

$program_id = (int) $_GET['program_id'];
$year = $conn->real_escape_string($_GET['year']);
$semester = $conn->real_escape_string($_GET['semester']);

$query = "
SELECT courses.*, programs.program_name
FROM courses
JOIN programs ON courses.program_id = programs.id
WHERE courses.program_id=$program_id
AND academic_year='$year'
AND semester='$semester'
ORDER BY course_name
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Course Report</title>

<style>
body {
    font-family: Arial, sans-serif;
    padding: 20px;
}

h2, h3 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
    font-size: 12px;
}

@media print {
    button {
        display: none;
    }
}
</style>

</head>
<body>

<h2>Integral University</h2>
<h3>Course Allocation Report</h3>
<p><strong>Academic Year:</strong> <?php echo $year; ?> |
<strong>Semester:</strong> <?php echo $semester; ?></p>

<button onclick="window.print()">Download as PDF</button>

<table>
<tr>
<th>Program</th>
<th>Course</th>
<th>Code</th>
<th>Type</th>
<th>Teacher</th>
<th>Students</th>
<th>Lectures</th>
<th>Lab</th>
<th>Room</th>
<th>Merged Program</th>
<th>Merged Semester</th>
<th>Merged Students</th>
</tr>

<?php
while($row = $result->fetch_assoc()){
echo "<tr>
<td>".$row['program_name']."</td>
<td>".$row['course_name']."</td>
<td>".$row['course_code']."</td>
<td>".$row['course_type']."</td>
<td>".$row['teacher_name']."</td>
<td>".$row['total_students']."</td>
<td>".$row['lectures_per_week']."</td>
<td>".$row['lab_name']."</td>
<td>".$row['lab_room']."</td>
<td>".$row['merged_program']."</td>
<td>".$row['merged_semester']."</td>
<td>".$row['merged_students']."</td>
</tr>";
}
?>

</table>

</body>
</html>