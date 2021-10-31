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

.contact{
  display: flex;
  justify-content: center;
  flex-direction: row;
  margin-top: 5%;
}

#h{
  margin-left: 2.5%;
  margin-right: 2.5%;
  border-radius: 5px;
  width:33.33%;
  border:2px solid black;
}

#k{
  width:100%;
  height:100%;
}

.contact img{
  width:75%;
  height:75%;
  margin-top: 3%;
  border-radius: 5px;
  border: 1px solid black;
}

center{
  margin-bottom: 2%;
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
        <div class="contact"> 
           <div id="h">
             <div id="k"><center><img src="contact_img/anand.jpeg" alt=""><br><br><span id="m">Anand Hegde<br>200020007@iitdh.ac.in</span></center></div>
             
           </div>
           <div id="h">
             <div id="k"><center><img src="contact_img/karthik.jpeg" alt=""><br><br><span id="m">Karthik JP<br>200010022@iitdh.ac.in</span></center></div>
           </div>
           <div id="h">
             <div id="k"><center><img src="contact_img/pavan.png" alt=""><br><br><span id="m">Pavan Kumar V Patil<br>200030041@iitdh.ac.in</span></center></div>
           </div>
        </div>
    </body>
</html>
