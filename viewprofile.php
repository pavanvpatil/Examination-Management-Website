<?php
    session_start();
    $email=$_SESSION['mail'];
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }
    $connect=mysqli_connect("localhost","root","","userInfo");
    $sql="SELECT * FROM usertable WHERE uGmail='$email'";
    $result=mysqli_query($connect,$sql);
    $row = $result->fetch_assoc();
    $username=$row['uName'];
    $institute=$row['uInstitute'];
?>
<link rel="icon" href="Website-icon/letter_q.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="topnav">
      <a style="font-size: 17px;" href="homepage.php"><i class="fa-solid fa-house-user"></i> Dashboard</a>
      <a style="font-size: 17px;" href="contact.php"><i class="fa-solid fa-phone"></i></i> Contact</a>
      <a style="font-size: 17px;" href="about.php"><i class="fa-solid fa-book"></i> About</a>
      <a style="font-size: 17px;" href="viewprofile.php"><i class="fas fa-user-alt"></i> Profile</a>
      <a style="font-size: 17px;" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
      <div  id="log_img">
      <span style="font-size:17px;color:blue;"><i class="fas fa-user-alt"></i> <?php echo "$username"; ?></span>
      </div> 
</div>
        <h1 style="text-align: center;font-family: 'Courier New', Courier, monospace;">User Profile</h1>
        <div class="container">
        <div class="profile_container">
            <div style="text-align:center;"><span><i class="fa-solid fa-user-large"></i> Username</span><br><br><span><?php echo "$username";?></span></div>
            <div style="text-align:center;"><span><i class="fa fa-university" aria-hidden="true"></i> Institute</span><br><br><span><?php echo "$institute";?></span></div>
            <div style="text-align:center;"><span><i class="fa fa-envelope" aria-hidden="true"></i> Email-ID</span><br><br><span><?php echo "$email"?></span></div>
        </div>
       </div>
<head>
        <title>Compete</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  background-color:rgb(176, 237, 248);
  height: auto;
  width: auto;
  position: sticky;
  top: 0;
  border: 1px solid black;
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
.container{
  display: flex;
  justify-content: center;
  direction: row;
}
.profile_container{
  border: 2px solid white;
  border-radius: 5px;
  min-width: 60%;
  max-width: 100%;
  padding:1%;
  background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
}
.profile_container div{
  border: 1px solid white;
  font-family: 'Courier New', Courier, monospace;
  font-size: 25px;
  font-weight: 550;
  padding:3%;
  color: white;
  box-sizing:border-box;
}
</style>
</head>