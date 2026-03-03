<?php
include "db.php";

$year = $_GET['year'];
$semester = $_GET['semester'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Course_List_$year_Sem_$semester.xls");

echo "Program\tCourse Name\tCourse Code\tType\tStudents\tLectures\tLab Name\tLab Room\n";

$result = $conn->query("
SELECT courses.*, programs.program_name
FROM courses
JOIN programs ON courses.program_id = programs.id
WHERE academic_year='$year' AND semester='$semester'
ORDER BY course_name
");

while($row = $result->fetch_assoc()){
    echo $row['program_name']."\t";
    echo $row['course_name']."\t";
    echo $row['course_code']."\t";
    echo $row['course_type']."\t";
    echo $row['total_students']."\t";
    echo $row['lectures_per_week']."\t";
    echo $row['lab_name']."\t";
    echo $row['lab_room']."\n";
}
?>