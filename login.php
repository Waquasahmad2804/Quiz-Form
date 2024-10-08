<?php
session_start();
include("./connect.php");
if(isset($_POST['register'])){
$username=$_POST['username'];
$password=$_POST['password'];
$role=$_POST['role'];
if($role==2){
$query=$conn->prepare("select username ,password,role from studentdetail where username=?");
}
if($role==1){
    $query=$conn->prepare("select username ,password,role from admin where username=?");
}
$query->execute([$username]);
$result=$query->fetch(PDO::FETCH_ASSOC);


    if($result){
        if(password_verify($password,$result['password']))
        $_SESSION['username']=$username;
        if($role==2){
echo "<script>
alert('Login Successfull')
</script>";
echo"<script>
window.location='userdashboard.php'
</script> ";
}



if($role==1){
    if($result){
        if(password_verify($password,$result['password']))
        $_SESSION['username']=$username;
    echo "<script>
    alert('Login Successfull')
    </script>";
    echo"<script>
    window.location='admindashboard.php'
    </script> ";}
}
else{
    echo"<script>
    alert('Invalid Admin Password');
    </script>";
}}
else{
    echo "<script>alert('Invalid Password Or You are trying to log as an admin');
    </script>";
}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="bootstrap.css">
    <style>
        body{
            background-color: #3498db;

        }
        input{
            width:300px;
            height:30px;
        }
        a,p{
            color:black;
            font-size:18px;
        }
        /* Base styles and reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #3498db, #8e44ad);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Animated background */
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>') 0 0 / 100px 100px;
    opacity: 0.5;
    animation: backgroundMove 20s linear infinite;
}

@keyframes backgroundMove {
    0% { background-position: 0 0; }
    100% { background-position: 100px 100px; }
}

.container {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
    position: relative;
    z-index: 1;
    backdrop-filter: blur(10px);
}

/* Typography */
.display-1 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 30px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

/* Form elements */
input, select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border: none;
    border-radius: 25px;
    background-color: #f1f3f5;
    font-size: 16px;
    transition: all 0.3s ease;
}

input:focus, select:focus {
    outline: none;
    box-shadow: 0 0 0 2px #3498db;
}

select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 15px;
}

/* Button styles */
.btn {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 25px;
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn:hover {
    background: linear-gradient(135deg, #2980b9, #3498db);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Links */
a, p {
    color: #34495e;
    font-size: 16px;
    text-decoration: none;
    transition: color 0.3s ease;
}

a:hover {
    color: #3498db;
}

pre {
    margin-top: 20px;
}

/* Responsive adjustments */
@media (max-width: 480px) {
    .container {
        padding: 20px;
    }

    .display-1 {
        font-size: 2rem;
    }

    input, select, .btn {
        font-size: 14px;
    }
}

/* Animation for form elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.container > * {
    animation: fadeInUp 0.5s ease-out forwards;
    opacity: 0;
}

.container > *:nth-child(1) { animation-delay: 0.1s; }
.container > *:nth-child(2) { animation-delay: 0.2s; }
.container > *:nth-child(3) { animation-delay: 0.3s; }
.container > *:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <p class="display-1">User Login</p>
            <form method="post" action="" >
<input type="text" name="username" placeholder="Username">
<br><br>
<input type="password" name="password" placeholder="Password">
<br><br>
<select name="role">
    <option value="1">Admin</option>
    <option value="2">Student</option>
</select>
<br><br>
<button class="btn btn-dark btn-lg" type="submit" name= "register">Login</button>
    <br><br>
</form>
<pre>
<p>Don't have an account?  <a href="register.php">Register Here</a></p></pre>



        </div>
    </div>
</body>
</html>