<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['user_id'];

$sql = "INSERT INTO courses 
(program_id, academic_year, semester, total_students,
course_name, course_code, course_type,
teacher_id, lectures_per_week,
lab_name, lab_room,
merged_program, merged_semester, merged_students)

VALUES
('$_POST[program_id]',
'$_POST[academic_year]',
'$_POST[semester]',
(isset($_POST['custom_students']) && $_POST['custom_students'] != '' 
? $_POST['custom_students'] 
: $_POST['total_students']),
'$_POST[course_name]',
'$_POST[course_code]',
'$_POST[course_type]',
'$teacher_id',
'$_POST[lectures_per_week]',
'$_POST[lab_name]',
'$_POST[lab_room]',
'$_POST[merged_program]',
'$_POST[merged_semester]',
'$_POST[merged_students]')";

$conn->query($sql);

header("Location: view_courses.php?year=".$_POST['academic_year']."&semester=".$_POST['semester']);
?>