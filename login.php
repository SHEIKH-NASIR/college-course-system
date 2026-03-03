<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>College Course System - Login</h2>

<form action="authenticate.php" method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<?php
if(isset($_GET['error'])){
    echo "<p style='color:red;'>Invalid Username or Password</p>";
}
?>

</body>
</html>