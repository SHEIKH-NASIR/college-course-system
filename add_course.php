<?php
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
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>

<h2>Add Course Details</h2>

<form action="insert_course.php" method="POST">

Program:
<select name="program_id" id="program" style="width:300px;" required>
<option value="">Select Program</option>
<?php
$result = $conn->query("SELECT * FROM programs ORDER BY program_name");
while($row = $result->fetch_assoc()){
    echo "<option value='".$row['id']."'>".$row['program_name']."</option>";
}
?>
</select><br><br>

Academic Year:
<select name="academic_year" required>
<option value="">Select Year</option>
<option>2025-2026</option>
<option>2026-2027</option>
<option>2027-2028</option>
<option>2028-2029</option>
<option>2029-2030</option>
</select><br><br>

Semester:
<select name="semester" required>
<option value="">Select Semester</option>
<?php
for($i=1; $i<=10; $i++){
    echo "<option value='$i'>$i</option>";
}
?>
</select><br><br>

Total Students:
<select name="total_students" id="students" onchange="checkCustom()" required>
<option value="">Select</option>
<?php
for($i=1; $i<=100; $i++){
    echo "<option value='$i'>$i</option>";
}
?>
<option value="custom">More than 100</option>
</select>

<input type="number" name="custom_students" id="custom_students" style="display:none;" placeholder="Enter Number"><br><br>

Course Name:
<input type="text" name="course_name" required><br><br>

Course Code:
<input type="text" name="course_code" required><br><br>

Course Type:
<select name="course_type" id="course_type" onchange="toggleLab()" required>
    <option value="Theory">Theory</option>
    <option value="Lab">Lab</option>
</select><br><br>

Teacher Name:
<input type="text" name="teacher_name" required><br><br>

Lectures per Week:
<input type="number" name="lectures_per_week" required><br><br>

<div id="lab_fields" style="display:none;">
Lab Name:
<input type="text" name="lab_name"><br><br>

Lab Room:
<input type="text" name="lab_room"><br><br>
</div>

<h3>Optional (Merged Program)</h3>

Merged Program Name:
<input type="text" name="merged_program"><br><br>

Merged Semester:
<input type="text" name="merged_semester"><br><br>

Merged Students:
<input type="number" name="merged_students"><br><br>

<button type="submit">Submit</button>

</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>

<script>
function toggleLab(){
    var type = document.getElementById("course_type").value;
    var labFields = document.getElementById("lab_fields");
    labFields.style.display = (type === "Lab") ? "block" : "none";
}
</script>
<script>
$(document).ready(function() {
    $('#program').select2({
        placeholder: "Search Program",
        allowClear: true
    });
});
</script>
<script>
function checkCustom(){
    var value = document.getElementById("students").value;
    if(value === "custom"){
        document.getElementById("custom_students").style.display = "inline";
    } else {
        document.getElementById("custom_students").style.display = "none";
    }
}
</script>

</body>
</html>