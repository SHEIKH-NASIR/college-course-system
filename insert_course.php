<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$teacher_name = $conn->real_escape_string($_POST['teacher_name']);

$program_id = (int) $_POST['program_id'];
$academic_year = $conn->real_escape_string($_POST['academic_year']);
$semester = $conn->real_escape_string($_POST['semester']);
$course_name = $conn->real_escape_string($_POST['course_name']);
$course_code = $conn->real_escape_string($_POST['course_code']);
$course_type = $conn->real_escape_string($_POST['course_type']);
$lectures_per_week = (int) $_POST['lectures_per_week'];

$total_students = isset($_POST['custom_students']) && $_POST['custom_students'] != ''
    ? (int) $_POST['custom_students']
    : (int) $_POST['total_students'];

$lab_name = isset($_POST['lab_name']) ? $conn->real_escape_string($_POST['lab_name']) : '';
$lab_room = isset($_POST['lab_room']) ? $conn->real_escape_string($_POST['lab_room']) : '';

$merged_program = isset($_POST['merged_program']) ? $conn->real_escape_string($_POST['merged_program']) : '';
$merged_semester = isset($_POST['merged_semester']) ? $conn->real_escape_string($_POST['merged_semester']) : '';
$merged_students = isset($_POST['merged_students']) ? (int) $_POST['merged_students'] : 0;

$query = "INSERT INTO courses 
(program_id, academic_year, semester, total_students,
course_name, course_code, course_type,
teacher_name, lectures_per_week,
lab_name, lab_room,
merged_program, merged_semester, merged_students)

VALUES
($program_id,
'$academic_year',
'$semester',
$total_students,
'$course_name',
'$course_code',
'$course_type',
'$teacher_name',
$lectures_per_week,
'$lab_name',
'$lab_room',
'$merged_program',
'$merged_semester',
$merged_students)";

if(!$conn->query($query)){
    die("Insert Error: " . $conn->error);
}

header("Location: view_courses.php");
exit();
?>
