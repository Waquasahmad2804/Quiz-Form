
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="bootstrap.css">
    <style>
        body{
            background-color: #3498db;

        }
        input{
            width:500px;
            height:40px;
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
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M30,1h40l29,29v40l-29,29h-40l-29-29v-40z" stroke="rgba(255,255,255,0.1)" fill="none" stroke-width="3"/></svg>') 0 0 / 100px 100px;
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
    max-width: 600px;
    width: 100%;
    position: relative;
    z-index: 1;
    backdrop-filter: blur(10px);
}

/* Form elements */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

input {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: none;
    border-radius: 25px;
    background-color: #f1f3f5;
    font-size: 16px;
    transition: all 0.3s ease;
}

input:focus {
    outline: none;
    box-shadow: 0 0 0 2px #3498db;
}

/* Button styles */
.btn {
    width: 50%;
    padding: 15px;
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
    margin-top: 10px;
    /* Ensure button is visible */
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.btn:hover {
    background: linear-gradient(135deg, #2980b9, #3498db);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Typography */
h1 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

/* Links */
.sign-in-link {
    text-align: center;
    margin-top: 20px;
    /* Ensure link is visible */
    display: block;
    color: #34495e;
    font-size: 16px;
}

.sign-in-link a {
    color: #3498db;
    text-decoration: none;
    transition: color 0.3s ease;
}

.sign-in-link a:hover {
    color: #2980b9;
    text-decoration: underline;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 20px;
        margin: 20px;
    }

    input, .btn {
        font-size: 14px;
    }

    h1 {
        font-size: 2rem;
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

form > *, .sign-in-link {
    animation: fadeInUp 0.5s ease-out forwards;
    opacity: 0;
}

form > *:nth-child(1) { animation-delay: 0.1s; }
form > *:nth-child(2) { animation-delay: 0.2s; }
form > *:nth-child(3) { animation-delay: 0.3s; }
form > *:nth-child(4) { animation-delay: 0.4s; }
form > *:nth-child(5) { animation-delay: 0.5s; }
form > *:nth-child(6) { animation-delay: 0.6s; }
.sign-in-link { animation-delay: 0.7s; }
    </style>
</head>
<body>
    <div class="container ">
        <div class="row offset-2 my-4 ">
        <form action="" method="post" class="col-lg-8 col-md-5">
   <input type="text" name="name" placeholder="Name">
   <br><br>
   <input type="text" name="username" placeholder="Username">
   <br><br>
   <input type="password" name="password" placeholder="Password">
   <br><br>
   <input type="text" name="email" placeholder="Email">
   <br><br>
   <input type="text" name="phoneno" placeholder="Contact">
   <br><br>
<button class="btn btn-dark btn-lg offset-3" type="submit" name="register">Register</button>
</form>
<pre>


<p class="offset-1">All ready have an account?  <a href="login.php">sign in</a></p></pre>

        </div>
    </div>
  


</body>
</html>

<?php
 
if(isset($_POST['register'])){
    include("connect.php");
    $username=$_POST['username'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $phoneno=$_POST['phoneno'];
    $query=$conn->prepare("Insert into studentdetail (username,name,password,email,phoneno,role) values(?,?,?,?,?,2)");
    $query->bindParam(1, $username);
    $query->bindParam(2, $name);
    $query->bindParam(3, $password);
    $query->bindParam(4, $email);
    $query->bindParam(5, $phoneno);
    $result=$query->execute();
if($result){
    echo "<script>
    alert('Registration successfull');
    setTimeout(function(){
    window.location.href='login.php'},500);
    
    </script>";
}
}
?>
