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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compete</title>
        <link rel="icon" href="Extra/letter_q.png">
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
        <h1>Here we will write how website works</h1>
    </body>
</html>