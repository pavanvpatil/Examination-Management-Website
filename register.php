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

    $conn = mysqli_connect("localhost", "root", "", "userInfo");
    $sqlQuery = "SELECT * FROM quizes";
    $result = mysqli_query($conn, $sqlQuery);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //edit
    $sql= "CREATE DATABASE IF NOT EXISTS `$username`";
    $connq=mysqli_connect('localhost', 'root', '');
    $connq->query($sql);
    $conn = mysqli_connect("localhost", "root", "",$username);
    if(!$conn)
    {
        echo "cool";
    }
    $sql= "CREATE TABLE IF NOT EXISTS reg_quizes( 
        id INT NOT NULL ,
        attempted INT NOT NULL,
        host TEXT NOT NULL ,
        q_date DATE NOT NULL , 
        starttime TIME NOT NULL , 
        endtime TIME NOT NULL , 
        duration TIME NOT NULL ,
        q_name TEXT NOT NULL )";
    mysqli_query($conn, $sql);

    
    //fetch from db
    //datafilter->user registered quizes
    //data->all available quizes
    $sql = "SELECT * FROM reg_quizes";
    $resultFilter = mysqli_query($conn, $sql);
    $dataFilter = mysqli_fetch_all($resultFilter, MYSQLI_ASSOC);

    $c_day=(int)date("d");
    $c_month=(int)date("m");
    $c_year=(int)date("Y");
    
    date_default_timezone_set('Asia/Kolkata');
    $c_hour=(int)date("H");
    $c_min=(int)date("i");
    $c_sec=(int)date("s");

?>
<head>
    <title>Register</title>
    <link rel="icon" href="Website-icon/letter_q.png">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      body{
        margin: 0rem;
        padding: 0rem;
        font-family: 'Courier New', Courier, monospace;
        font-weight:600;
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
    </style>
</head>
<body>
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
    <h1 id="heading">Quizes available for registration</h1>
    <div id="container"></div>
    <form action="homepage.php">
      <div style="display: flex; justify-content:center; margin: 3%;">
        <button class="btn_back" style="float: none" type="submit">Back</button>
      </div>
    </form>
  
   
    <script>
        var heading = document.getElementById("heading");
        var y = document.getElementById("container");
   <?php for($i = 0; $i < sizeof($data); $i++)
      {
          $year=(int)substr($data[$i]['date'],0,4);
          $month=(int)substr($data[$i]['date'],5,2);
          $day=(int)substr($data[$i]['date'],8,2);
          $hour=(int)substr($data[$i]["end time"],0,2);
          $min=(int)substr($data[$i]["end time"],3,2);
          $sec=(int)substr($data[$i]["end time"],6,2);
          if($c_year<$year)
             $key=1;
          else if($c_year>=$year)
          {
             $key=0;
            if($c_year==$year)
             {
                if($c_month<$month)
                   $key=1;
                else if($c_month>=$month)
                {
                   $key=0;
                   if($c_month==$month)
                   {
                      if($c_day<$day)
                         $key=1;
                      else if($c_day>=$day)
                      {
                         $key=0;
                         if($c_day==$day)
                         {
                            if($c_hour<$hour)
                               $key=1;
                            else if($c_hour>=$hour)
                            {
                               $key=0;
                               if($c_hour==$hour)
                               {
                                  if($c_min<$min)
                                     $key=1;
                                  else if($c_min>=$min)
                                  {
                                     $key=0;
                                  }
                               }
                            }
                         }
                      }
                   }
                }
             }
          }
          for($j = 0; $j < sizeof($dataFilter); $j++)
          {
              if($dataFilter[$j]['id'] == $data[$i]['id'])
              {
                $key = 0;
                break;
              }
          }
         if($key == 1)
         { ?>
            var form = document.createElement("form");
            form.action = "reg_quiz.php"
            form.method = "POST";
            var quizBody = document.createElement("div");
            var heading = document.createElement("h2");
            var startTime = document.createElement("h2");
            var endTime = document.createElement("h2");
            var hostName = document.createElement("h2");
            var id = document.createElement("h2");
            var button = document.createElement("button");
            button.value = "<?= $i+1 ?>";
            button.name = "submitted";
            button.type = "submit";
            var quizDate = document.createElement("h2");

            heading.innerHTML = "Quiz Name: "+"<?= $data[$i]['name'] ?>";
            startTime.innerHTML = "*Start time(24hrs format): "+"<?= $data[$i]['start time'] ?>";
            endTime.innerHTML = "*End time(24hrs format): "+"<?= $data[$i]['end time'] ?>";
            hostName.innerHTML = "*Host name: "+"<?= $data[$i]['host'] ?>";
            id.innerHTML = "*Quiz ID: "+"<?= $data[$i]['id'] ?>";
            button.innerHTML = "Register";
            quizDate.innerHTML = "*Date of conduct: "+"<?= $data[$i]['date'] ?>";

            quizBody.className = "quizContainer";
            heading.className = "heading";
            startTime.className = "startTime";
            endTime.className = "endTime";
            hostName.className = "hostName";
            id.className = "id";
            button.className = "btn";
            quizDate.className = "quizDate";

            heading.style = "text-align: center; color: white;"
           

            quizBody.appendChild(heading);
            quizBody.appendChild(id);
            quizBody.appendChild(hostName);
            quizBody.appendChild(quizDate);
            quizBody.appendChild(startTime);
            quizBody.appendChild(button);
            quizBody.appendChild(endTime);
            form.appendChild(quizBody);
            y.appendChild(form);
        <?php } } ?>
        var parent = document.getElementById("container");
        var childs = parent.childNodes.length;
        if(childs == 0){
          heading.innerHTML = "No quizes available";
        }
    </script>
</body>