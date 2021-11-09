<?php
    session_start();
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }
    $username=$_SESSION['user'];
?>
<link rel="icon" href="Extra/letter_q.png">
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add questions</title>
    <link rel="stylesheet" href="question.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
    </style>
</head>
<body>
        <h1 style="text-align:center;font-size:40px">Host a Quiz</h1>
        <form action="" method="post">
            <div class="Host_form">    
                <div class="name a">
                <label for="qname">*Quiz Name*</label><br>
                <input type="text" name="qname" id="qname" placeholder="Ex: Programming quiz" required>
                </div>
                <div class="date a">
                <label for="qdate">*Quiz date*</label><br>
                <input type="date" name="qdate" id="qdate" required>
                </div>
                <div class="qstime a">
                <label for="qstime">*Quiz Start time*</label><br>
                <input type="time" name="qstime" id="qstime" step="1" required>
                </div>
                <div class="qetime a">
                <label for="qetime">*Quiz end time*</label><br>
                <input type="time" name="qetime" id="qetime" step="1" required>
                </div>
                <div class="submit">
                <input type="submit" name="add" value="Create" id="submit">
                </div>
            </div>
        </form>
</body>
</html>
<?php
    $conn = mysqli_connect('localhost', 'root', '');
    $sqlQuery = 'CREATE DATABASE IF NOT EXISTS userInfo ;';
    $username= $_SESSION['user'];
    $sql= "CREATE DATABASE IF NOT EXISTS `$username`";
    if(!$conn->query($sql))
    {
        echo "eroor creating database";
    }
    mysqli_query($conn, $sqlQuery);
    $sql= 'CREATE TABLE IF NOT EXISTS `userinfo`.`quizes` ( `id` INT NOT NULL AUTO_INCREMENT ,
    `host` TEXT NOT NULL ,
    `date` DATE NOT NULL , 
    `start time` TIME NOT NULL , 
    `end time` TIME NOT NULL , 
    `duration` TIME NOT NULL ,
    `name` TEXT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $conn->query($sql);

    if(isset($_POST['add']))
    {
        $name= $_POST['qname'];
        $stime= $_POST['qstime'];
        $etime=$_POST['qetime'];
        $date= $_POST['qdate'];
        // $_SESSION['qname']= $name;
     
        $start_date = new DateTime("2007-09-01 $stime");
        $since_start = $start_date->diff(new DateTime("2007-09-01 $etime"));
        $seconds= 0;
        $start= strtotime($stime);
        $end= strtotime($etime);
        $seconds= $end- $start; 

        // $seconds += $since_start->h * 60*60;
        // $seconds += $since_start->i*60;
        // $seconds+= $since_start->s;
    
         if($seconds<=0)
        {
            echo "<script>alert('Please select proper Start and End time')</script>";
        }
        else
        {
            $sql= "INSERT INTO `userinfo`.`quizes` (`id`, `host`, `date`, `start time`, `end time`, `duration`, `name`) 
            VALUES (NULL,'$username' , '$date', '$stime', '$etime', '$seconds', '$name');";
            if(!$conn->query($sql))
            {
                echo $conn->error;
            }
            // $conn1 = mysqli_connect('localhost', 'root', '', $username);
            $_SESSION['qname']= $name;
            header("Location: questionsadd.php");
        }
    }
?>