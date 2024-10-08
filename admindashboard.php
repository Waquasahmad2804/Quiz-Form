<?php
session_start();
include("./connect.php");
$query=$conn->prepare("Select * from studentdetail");
$query->execute();
$result=$query->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST['delete'])){
    $username=$_POST['delete'];
    $delete=$conn->prepare("delete from studentdetail where username= :username");
    $delete->bindParam(':username',$username);
    $update=$delete->execute();
    if($update){
        header("location:".$_SERVER['PHP_SELF']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        body{
          font-family:'Merriweather',sans-serif;
          background-color:#70a1ff;
        }
        </style>
</head>
<body>
    <div class="container">
        <div class="row">

     
<table class="table table-bordered mx-3 my-3">
<tr><th>Name</th><th>Username</th><th>Password</th><th>Phone-No</th><th>Email</th><th>Action</th></tr>

    <?php

foreach($result as $value){
    echo"<tr>";
echo"<td>".$value['name']."</td>";
echo"<td>".$value['username']."</td>";
echo"<td>".$value['password']."</td>";
echo"<td>".$value['phoneno']."</td>";
echo"<td>".$value['email']."</td>";

echo "<td><form action='' method='post' ><button class='btn btn-dark type='submit' name='delete' value='".$value['username']."'>Delete User</button></form></td>";
echo "</tr>
</div>
</div>";
}

echo "<button  id='logoutbtn' class='btn btn-lg btn-dark mx-3 my-3 col-lg-1' type='submit' name='logout'>Logout</button>";

echo "<script>
let btn=document.querySelector('#logoutbtn');
btn.addEventListener('click',function(){
setTimeout(function(){
window.location='login.php';},500)
});

</script>";
?>
</table>

<div class="container">
    <div class="row">
    <h2>Add A question</h2>
<form action="" method="post">
    <textarea name="question_text" rows="4" cols="50" placeholder="Enter Your Question" required></textarea>
    <br><br>
    <label for="answers">Answers:</label><br>
    <input type="text" name="answer1" required>
    <input type="radio" name="correct_answer" value="1"> Correct<br><br>
    
    <input type="text" name="answer2" required>
    <input type="radio" name="correct_answer" value="2"> Correct<br><br>
    
    <input type="text" name="answer3" required>
    <input type="radio" name="correct_answer" value="3"> Correct<br><br>

    <input type="text" name="answer4" required>
    <input type="radio" name="correct_answer" value="4"> Correct<br><br>
    <button class="btn btn-lg btn-dark "type="submit" name="question_btn">Add Question</button>
</form>
    </div>
</div>

</body>
</html>
<?php
include("./connect.php");

if(isset($_POST['question_btn'])){
    $question_text=$_POST['question_text'];
    $query = $conn->prepare("INSERT INTO questions (question_text) VALUES (:question_text)");
    $query->bindParam(':question_text', $question_text);
   
    $result = $query->execute();
    $question_id = $conn->lastInsertId();
    for ($i = 1; $i <= 4; $i++) {
        $answer = $_POST["answer$i"];
        $is_correct = ($i == $_POST['correct_answer']) ? 1 : 0;
        $conn->query("INSERT INTO answers (question_id, answer_text, is_correct) VALUES ($question_id, '$answer', $is_correct)");
       
    }
    




    if($result){
        echo "Question Inserted successfully";
    }

}

?>