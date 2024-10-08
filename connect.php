<?php
$hostname="localhost";
$dbname="quiz";
$username="root";
$password="";

$conn=new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
try{
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "Connection successfull with databse";
}
catch (PDOException $err){
    echo "Connection failed due to ".$err->getmessage();
}



?>