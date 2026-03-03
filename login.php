<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - College Course System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #1f4037, #99f2c8);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', sans-serif;
}

.login-card {
    width: 100%;
    max-width: 420px;
    background: white;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

.login-title {
    text-align: center;
    font-weight: 600;
    margin-bottom: 25px;
}

.form-control {
    height: 45px;
}

.btn-custom {
    background: #1f4037;
    color: white;
    height: 45px;
    font-weight: 500;
}

.btn-custom:hover {
    background: #16302a;
    color: white;
}

.error {
    color: red;
    text-align: center;
    margin-top: 10px;
}
</style>
</head>

<body>

<div class="login-card">

<h3 class="login-title">College Course System</h3>

<form action="authenticate.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-custom w-100">Login</button>
</form>

<?php
if(isset($_GET['error'])){
    echo "<p class='error'>Invalid Username or Password</p>";
}
?>

</div>

</body>
</html>
