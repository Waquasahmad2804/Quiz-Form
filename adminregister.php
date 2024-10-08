<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
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
    </style>
</head>
<body>
    <div class="container ">
        <div class="row offset-2 my-4 ">
        <form action="" method="post" class="col-lg-8 col-md-5">
   
   <input type="text" name="username" placeholder="Username">
   <br><br>
   <input type="password" name="password" placeholder="Password">
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
    $password=$_POST['password'];
    $query=$conn->prepare("Insert into admin (username,password,role) values(?,?,1)");
    $query->bindParam(1, $username);
    $query->bindParam(2, $password);
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