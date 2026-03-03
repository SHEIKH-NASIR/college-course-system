<?php

$host = "dpg-d6jes18gjchc739jgn70-a";
$port = "5432";
$dbname = "college_course_system";
$user = "college_course_system_user";
$password = "lHgOV1OaCxdMVJQvy9EhjIeEdPPxXOp9";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if(!$conn){
    die("Database connection failed.");
}

?>
