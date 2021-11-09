<?php
    session_start();
    $username = $_SESSION['user'];
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


   
    $connect = mysqli_connect("localhost", "root", "", $username);
    $sql = "SELECT * FROM reg_quizes; ";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<head>
    <title>Attempt a quiz</title>
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
.ins{
   font-family: 'Courier New', Courier, monospace;
   float: right;
   position: absolute;
   margin: 1%;
   padding: 1%;
   top: 8%;
   right: 1%;
   border-radius: 4px;
   border: 0.2px solid black;
   background: teal;
   color: white;
   font-size: 15px;
   font-weight: 600;
   z-index: -1;
}
   .ins:hover{
      box-shadow: 4px 4px 10px grey;
      background: green;
      transition: 0.7s;
      cursor: pointer;
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
    <h1 id="heading">Quizes available for attempt</h1>
    <button class="ins" onclick="switchs();">Instructions</button>
    <p id="1"></p>
    <div id="container"></div>
    <form action="homepage.php">
      <div style="display: flex; justify-content:center; margin: 3%;">
        <button class="btn_back" style="float: none" type="submit">Back</button>
      </div>
    </form>
    <script>
        var y = document.getElementById("container");
        <?php for($i = 0; $i < sizeof($data); $i++) 
        { 
         $c_day=(int)date("d");
         $c_month=(int)date("m");
         $c_year=(int)date("Y");
         date_default_timezone_set('Asia/Kolkata');
         $c_hour=(int)date("H");
         $c_min=(int)date("i");
         $c_sec=(int)date("s");
         $year=(int)substr($data[$i]['q_date'],0,4);
         $month=(int)substr($data[$i]['q_date'],5,2);
         $day=(int)substr($data[$i]['q_date'],8,2);
         $hour=(int)substr($data[$i]["endtime"],0,2);
         $min=(int)substr($data[$i]["endtime"],3,2);
         $sec=(int)substr($data[$i]["endtime"],6,2);
         $shour=(int)substr($data[$i]["starttime"],0,2);
         $smin=(int)substr($data[$i]["starttime"],3,2);
         $ssec=(int)substr($data[$i]["starttime"],6,2);   
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
          if($data[$i]['attempted'] == 1){
             $key = 0;
          }
         if($key==1)
          { ?>
        
            var form = document.createElement("form");
            form.action = "attemptBackend.php";
            form.method = "POST";
            var quizBody = document.createElement("div");
            var heading = document.createElement("h2");
            var startTime = document.createElement("h2");
            var endTime = document.createElement("h2");
            var hostName = document.createElement("h2");
            var id = document.createElement("h2");
            var button = document.createElement("button");
            button.value = "<?= $data[$i]['id'] ?>";
            button.name = "submitted";
            button.type = "submit";
            button.style.background = 'grey';
            button.disabled = true;
            <?php 
               $key1 = 0;
               if($c_year == $year && $c_month == $month && $c_day == $day){ 
                  if($c_hour<$shour)
                  {  
                     $key1=0;
                  }
                  else if($c_hour>=$shour)
                  {
                     $key1=1;
                     if($c_hour==$shour)
                     {
                       
                        if($c_min>=$smin)
                           $key1=1;
                        else if($c_min<$smin)
                        {
                           $key1=0;
                        }
                     }
                  }
               } 
            ?>
           <?php if($key1 == 1){ ?>
              button.disabled = false;
              button.style.background = 'green';
           <?php  }?>

            var quizDate = document.createElement("h2");

            heading.innerHTML = "Quiz Name: "+"<?= $data[$i]['q_name'] ?>";
            startTime.innerHTML = "*Start time(24hrs format): "+"<?= $data[$i]['starttime'] ?>";
            endTime.innerHTML = "*End time(24hrs format): "+"<?= $data[$i]['endtime'] ?>";
            hostName.innerHTML = "*Host name: "+"<?= $data[$i]['host'] ?>";
            id.innerHTML = "*Quiz ID: "+"<?= $data[$i]['id'] ?>";
            button.innerHTML = "Attempt";
            quizDate.innerHTML = "*Date of conduct: "+"<?= $data[$i]['q_date'] ?>";

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
          
        <?php } }?>
            var heading = document.getElementById("heading");
            var parent = document.getElementById("container");
            var childs = parent.childNodes.length;
            if(childs == 0)
            {
              heading.innerHTML = "No quizes available";
            }
         function switchs(){
            location.replace("instructions.html");
         }
    </script>
   
</body>