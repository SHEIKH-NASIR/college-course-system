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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Course - College Course System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
body {
    background: linear-gradient(-45deg, #1f4037, #99f2c8, #243b55, #141e30);
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

@keyframes gradientBG {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

.form-card {
    width: 100%;
    max-width: 750px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    color: white;
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
}

.form-control, .form-select {
    background: rgba(255,255,255,0.9);
    border-radius: 10px;
    height: 45px;
}

label {
    margin-top: 10px;
}

.btn-custom {
    background: #00c6ff;
    border: none;
    border-radius: 10px;
    height: 45px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-custom:hover {
    background: #0072ff;
    transform: scale(1.03);
}

.select2-container {
    width: 100% !important;
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

<div class="form-card">

<h2><i class="fas fa-plus-circle me-2"></i>Add Course</h2>

<form action="insert_course.php" method="POST">

<label>Program</label>
<select name="program_id" id="program" class="form-select" required>
<option value="">Select Program</option>
<?php
$result = $conn->query("SELECT * FROM programs ORDER BY program_name");
while($row = $result->fetch_assoc()){
    echo "<option value='".$row['id']."'>".$row['program_name']."</option>";
}
?>
</select>

<label>Academic Year</label>
<select name="academic_year" class="form-select" required>
<option>2025-2026</option>
<option>2026-2027</option>
<option>2027-2028</option>
<option>2028-2029</option>
<option>2029-2030</option>
</select>

<label>Semester</label>
<select name="semester" class="form-select" required>
<?php for($i=1;$i<=10;$i++){ echo "<option value='$i'>$i</option>"; } ?>
</select>

<label>Total Students</label>
<select name="total_students" id="students" class="form-select" onchange="checkCustom()" required>
<?php for($i=1;$i<=100;$i++){ echo "<option value='$i'>$i</option>"; } ?>
<option value="custom">More than 100</option>
</select>

<input type="number" name="custom_students" id="custom_students" class="form-control mt-2" style="display:none;" placeholder="Enter Number">

<label>Course Name</label>
<input type="text" name="course_name" class="form-control" required>

<label>Course Code</label>
<input type="text" name="course_code" class="form-control" required>

<label>Course Type</label>
<select name="course_type" id="course_type" class="form-select" onchange="toggleLab()" required>
<option value="Theory">Theory</option>
<option value="Lab">Lab</option>
</select>

<label>Teacher Name</label>
<input type="text" name="teacher_name" class="form-control" required>

<label>Lectures Per Week</label>
<input type="number" name="lectures_per_week" class="form-control" required>

<div id="lab_fields" style="display:none;">
<label>Lab Name</label>
<input type="text" name="lab_name" class="form-control">

<label>Lab Room</label>
<input type="text" name="lab_room" class="form-control">
</div>

<hr>

<h5 class="mt-3">Optional (Merged Program)</h5>

<label>Merged Program Name</label>
<input type="text" name="merged_program" class="form-control">

<label>Merged Semester</label>
<input type="text" name="merged_semester" class="form-control">

<label>Merged Students</label>
<input type="number" name="merged_students" class="form-control">

<button type="submit" class="btn btn-custom w-100 mt-4">
<i class="fas fa-save me-2"></i>Submit
</button>

</form>

<a href="dashboard.php" class="back-link">
<i class="fas fa-arrow-left me-2"></i>Back to Dashboard
</a>

</div>

<script>
function toggleLab(){
    var type = document.getElementById("course_type").value;
    document.getElementById("lab_fields").style.display = (type === "Lab") ? "block" : "none";
}

function checkCustom(){
    var value = document.getElementById("students").value;
    document.getElementById("custom_students").style.display = (value === "custom") ? "block" : "none";
}

$(document).ready(function() {
    $('#program').select2({
        placeholder: "Search Program",
        allowClear: true,
        width: '100%'
    });
});
</script>

</body>
</html>
