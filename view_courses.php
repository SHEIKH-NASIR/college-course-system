<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Courses</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(-45deg, #141e30, #243b55, #1f4037, #99f2c8);
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;
    padding: 30px;
}

@keyframes gradientBG {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

.card-glass {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    color: white;
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}

.table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
}

.table th {
    background: #243b55;
    color: white;
}

.btn-custom {
    border-radius: 10px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-custom:hover {
    transform: scale(1.05);
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: white;
    text-decoration: none;
}
</style>
</head>

<body>

<div class="container">
<div class="card-glass">

<h2 class="text-center mb-4"><i class="fas fa-table me-2"></i>View Courses</h2>

<form method="GET" class="row g-3">

<div class="col-md-4">
<label class="form-label">Program</label>
<select name="program_id" class="form-select" required>
<option value="">Select Program</option>
<?php
$programs = $conn->query("SELECT * FROM programs ORDER BY program_name");
while($p = $programs->fetch_assoc()){
    $selected = (isset($_GET['program_id']) && $_GET['program_id']==$p['id']) ? "selected" : "";
    echo "<option value='".$p['id']."' $selected>".$p['program_name']."</option>";
}
?>
</select>
</div>

<div class="col-md-4">
<label class="form-label">Academic Year</label>
<select name="year" class="form-select" required>
<?php
$years = ['2025-2026','2026-2027','2027-2028','2028-2029','2029-2030'];
foreach($years as $y){
    $selected = (isset($_GET['year']) && $_GET['year']==$y) ? "selected" : "";
    echo "<option value='$y' $selected>$y</option>";
}
?>
</select>
</div>

<div class="col-md-4">
<label class="form-label">Semester</label>
<select name="semester" class="form-select" required>
<?php
for($i=1;$i<=10;$i++){
    $selected = (isset($_GET['semester']) && $_GET['semester']==$i) ? "selected" : "";
    echo "<option value='$i' $selected>$i</option>";
}
?>
</select>
</div>

<div class="col-12 text-center">
<button type="submit" class="btn btn-primary btn-custom mt-3">
<i class="fas fa-search me-2"></i>View
</button>
</div>

</form>

<?php
if(isset($_GET['program_id']) && isset($_GET['year']) && isset($_GET['semester'])){

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

echo "<div class='text-center mt-4'>";
echo "<a href='export_pdf.php?program_id=$program_id&year=$year&semester=$semester' target='_blank' class='btn btn-success btn-custom me-2'>
<i class='fas fa-file-pdf me-2'></i>Export PDF
</a>";
echo "<button onclick='window.print()' class='btn btn-warning btn-custom'>
<i class='fas fa-print me-2'></i>Print
</button>";
echo "</div>";

echo "<div class='table-responsive mt-4'>";
echo "<table class='table table-bordered table-hover text-center'>";

echo "<thead>
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
</thead><tbody>";

while($row = $result->fetch_assoc()){

$merged_program  = !empty($row['merged_program']) ? $row['merged_program'] : '';
$merged_semester = !empty($row['merged_semester']) ? $row['merged_semester'] : '';
$merged_students = (!empty($row['merged_students']) && $row['merged_students'] != 0)
                   ? $row['merged_students']
                   : '';

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
<td>".$merged_program."</td>
<td>".$merged_semester."</td>
<td>".$merged_students."</td>
</tr>";
}

echo "</tbody></table></div>";
}
?>

<a href="dashboard.php" class="back-link">
<i class="fas fa-arrow-left me-2"></i>Back to Dashboard
</a>

</div>
</div>

</body>
</html>
