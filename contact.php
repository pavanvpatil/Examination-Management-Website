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
<link rel="icon" href="Extra/letter_q.png">
<div class="topnav">
      <a style="font-size: 17px;" href="homepage.php"><i class="fa-solid fa-house-user"></i> Dashboard</a>
      <a style="font-size: 17px;" href="contact.php"><i class="fa-solid fa-phone"></i></i> Contact</a>
      <a style="font-size: 17px;" href="about.php"><i class="fa-solid fa-book"></i> About</a>
      <a style="font-size: 17px;" href="viewprofile.php"><i class="fas fa-user-alt"></i> Profile</a>
      <a style="font-size: 17px;" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
      <div  id="log_img">
      <!-- <img src="login_icon.jpg" alt="no image found" id="login_icon"><br> -->
      <span style="font-size:17px;color:blue;"><i class="fas fa-user-alt"></i> <?php echo "$username"; ?></span>
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
  border:1px solid black;
  background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
}

#k{
  width:100%;
  height:100%;
  color:white;
}

.contact img{
  width:75%;
  height:75%;
  margin-top: 3%;
  border-radius: 5px;
  border: 1px solid white;
}

center{
  margin-bottom: 2%;
}
</style>
    </head>
