<?php
    session_start();
    $email=$_SESSION['mail'];
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }
    $connect=mysqli_connect("localhost","root","","userInfo");
    $sql="SELECT * FROM usertable";
    $result=mysqli_query($connect,$sql);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $no_of_users=sizeof($data);
    $sql="SELECT * FROM usertable WHERE uGmail='$email'";
    $result=mysqli_query($connect,$sql);
    $row=$result->fetch_assoc();
    $username=$row['uName'];
    $_SESSION['user'] = $username;

    //no of quizes
    $sqlQuery = "SELECT * FROM quizes";
    $result = mysqli_query($connect, $sqlQuery);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Extra/letter_q.png">
    <title>Compete</title>
<style>
body{
  margin: 0rem;
  padding: 0rem;
  font-family: 'Courier New', Courier, monospace;
  font-weight:600;
}
.topnav {
  overflow: hidden;
  background-color:#cfcccc;
  height: auto;
  width: auto;
  position: sticky;
  top: 0;
}

.topnav a {
  float: left;
  color:black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 22px;
}

.topnav a:hover {
  background-color:skyblue;
  color: black;
}

#login_icon{
  width: 27px;
  height: 27px;
  border-radius: 50%;
}

#log_img{
  padding-top: 8px;
  padding-right: 8px;
  cursor: pointer;
}

.flex-container {
    display: flex;
    margin-top: 2%;
    width: auto;
    justify-content: center;
    flex-direction: row;
    height: 350px;
    padding: 0.5%;
}

.flex-child1{
    border: 2px solid black;
    margin-right: 10px;
    margin-left: 10px;
    width: 70%;
    border-radius: 10px;
    text-align: center;
} 

.flex-child2{
    border: 2px solid black;
    margin-right: 10px;
    margin-left: 10px;
    width: 30%;
    border-radius: 10px;
    color:blue;
    text-align: center;
}

.flex-child2 a{
  border:2px solid black;
  color:darkblue;
  text-decoration: none;
  border-radius: 5px;
  padding: 2%;
  width: 40%;
  display: inline-block;
  font-size: 20px;
  background-color: rgb(228, 226, 226);
  margin-top: 2.5%;
  margin-bottom: 2.5%;
}

.flex-child2 a:hover{
  background-color: rgb(238, 253, 154);
}

.flex-container2{
  display: flex;
  margin-top: 2%;
  height: 250px;
  flex-direction: row;
  justify-content: center;
}

.flex1{
  border: 2px solid black;
  width: 33.33%;
  margin-left: 10px;
  margin-right: 10px;
  border-radius: 10px;
  text-align: center;
}

.flex2{
  border: 2px solid black;
  width: 33.33%;
  margin-left: 10px;
  margin-right: 10px;
  border-radius: 10px;
  text-align: center;
}

.flex3{
  border: 2px solid black;
  width: 33.33%;
  margin-left: 10px;
  margin-right: 10px;
  border-radius: 10px;
  text-align: center;
}

</style>
</head>
<body>
<div class="topnav">
  <a href="homepage.php">🏠Home</a>
  <a href="contact.php">📞Contact</a>
  <a href="about.php">📚About</a>
  <a href="viewprofile.php">👨‍🎓Profile</a>
  <a href="logout.php">🚪Logout</a>
  <div align="right" id="log_img">
  <img src="login_icon.jpg" alt="no image found" id="login_icon"><br>
  <span style="font-size:15px;color:blue;"><?php echo "$username"; ?></span>
  </div> 
</div>
<div class="flex-container">
  <div class="flex-child1">
    HERE WE WILL BE SLIDES OF QUIZ HOSTED BY OTHER USERS
  </div>
  <div class="flex-child2">
    <h1 style="text-align: center;">QUIZ PANEL</h1><br>
    <a href="#Register_Quiz.php">Attempt Quiz</a><br>
    <a href="question.php">Host Quiz</a><br>
    <a href="#Given_Quizs.php">Given Quizs</a><br>
    <a href="register.php">Register</a>
  </div>
</div>
<div class="flex-container2">
  <div class="flex1">
    <h1>📝Quizzes</h1>
    <h1 style="font-size: 100px; color: red;margin-top: -2%;"><?php echo sizeof($data) ?></h1>
  </div>
  <div class="flex2">
    <h1>✒️Quizzes Hosted</h1>
    <h1 style="font-size: 100px; color: red;margin-top: -2%;">19</h1>
  </div>
  <div class="flex3">
    <h1>👨‍🎓Users</h1>
    <h1 style="font-size: 100px; color: red;margin-top: -2%;"><?php echo "$no_of_users" ?></h1>
  </div>
</div><br><br>
<hr>
</body>
</html>