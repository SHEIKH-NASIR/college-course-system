<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['name'] = $row['name'];
    
    header("Location: dashboard.php");
} else {
    header("Location: login.php?error=1");
}
?>