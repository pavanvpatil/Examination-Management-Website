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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Compete</title>
<style>
body{
  margin: 0rem;
  padding: 0rem;
  font-family: 'Courier New', Courier, monospace;
  font-weight:600;
  background-image: linear-gradient(170deg,rgb(243, 247, 247),rgb(166, 239, 252) );
}
.topnav {
  overflow: hidden;
  /*background-color:#cfcccc;*/
 /* background-image: linear-gradient(170deg,rgb(166, 239, 252),rgb(243, 247, 247) );*/
 background-color:rgb(176, 237, 248);
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
  position: absolute;
  top: 15%;
  right: 1%;

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
    border-radius: 4px;
    text-align: center;
} 

.flex-child2{
    border: 2px solid black;
    margin-right: 10px;
    margin-left: 10px;
    width: 30%;
    border-radius: 4px;
    color:white;
    text-align: center;
    background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
}

.flex-child2 a{
  border:1.5px solid white;
  color:black;
  text-decoration: none;
  border-radius: 5px;
  padding: 2%;
  width: 42%;
  display: inline-block;
  font-size: 20px;
  background-color: rgb(166, 239, 252);
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
  border-radius: 6px;
  text-align: center;
  background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
}

.flex2{
  border: 2px solid black;
  width: 33.33%;
  margin-left: 10px;
  margin-right: 10px;
  border-radius: 6px;
  text-align: center;
  background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
}

.flex3{
  border: 2px solid black;
  width: 33.33%;
  margin-left: 10px;
  margin-right: 10px;
  border-radius: 6px;
  text-align: center;
  background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
}

</style>
</head>
<body>
<div class="topnav">
  <a style="font-size: 17px;" href="homepage.php"><i class="fa-solid fa-house-user"></i> Home</a>
  <a style="font-size: 17px;" href="contact.php"><i class="fa-solid fa-phone"></i></i> Contact</a>
  <a style="font-size: 17px;" href="about.php"><i class="fa-solid fa-book"></i> About</a>
  <a style="font-size: 17px;" href="viewprofile.php"><i class="fas fa-user-alt"></i> Profile</a>
  <a style="font-size: 17px;" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
  <div  id="log_img">
  <!-- <img src="login_icon.jpg" alt="no image found" id="login_icon"><br> -->
  <span style="font-size:17px;color:blue;"><i class="fas fa-user-alt"></i> <?php echo "$username"; ?></span>
  </div> 
</div>
<div class="flex-container">
  <div class="flex-child1">
    HERE WE WILL BE SLIDES OF QUIZ HOSTED BY OTHER USERS
  </div>
  <div class="flex-child2">
    <h1 style="text-align: center;">QUIZ PANEL</h1>
    <a href="attempt.php">Attempt Quiz</a><br>
    <a href="question.php">Host Quiz</a><br>
    <a href="#Given_Quizs.php">Given Quizs</a><br>
    <a href="register.php">Register</a>
  </div>
</div>
<div class="flex-container2">
  <div class="flex1">
    <h1 style="color: white;"><i class="fa-solid fa-book-open"></i> Quizzes</h1>
    <h1 style="font-size: 100px; color: white;margin-top: -2%;"><?php echo sizeof($data) ?></h1>
  </div>
  <div class="flex2">
    <h1 style="color: white;"><i class="fa-regular fa-pen-to-square"></i> Quizzes Hosted</h1>
    <h1 style="font-size: 100px; color: white;margin-top: -2%;">19</h1>
  </div>
  <div class="flex3">
    <h1 style="color: white;"><i class="fa-solid fa-users"></i> Users</h1>
    <h1 style="font-size: 100px; color: white;margin-top: -2%;"><?php echo "$no_of_users" ?></h1>
  </div>
</div>
<br><br>
<hr>
</body>
</html>