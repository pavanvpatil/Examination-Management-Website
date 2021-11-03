<?php
    session_start();
    $username = $_SESSION['user'];
    $connect = mysqli_connect("localhost", "root", "", $username);
    $sql = "SELECT * FROM reg_quizes; ";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<head>
    <title>Attempt a quiz</title>
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
    <h1 id="heading">Quizes available for attempt</h1>
    <div id="container"></div>
    <form action="homepage.php">
      <div style="display: flex; justify-content:center; margin: 3%;">
        <button class="btn" style="float: none" type="submit">Back</button>
      </div>
    </form>
    <script>
        var y = document.getElementById("container");
        <?php for($i = 0; $i < sizeof($data); $i++) { ?>
            var form = document.createElement("form");
            form.action = "#";
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

            heading.innerHTML = "Quiz name: "+"<?= $data[$i]['q_name'] ?>";
            startTime.innerHTML = "Start time(24hrs format): "+"<?= $data[$i]['starttime'] ?>";
            endTime.innerHTML = "End time(24hrs format): "+"<?= $data[$i]['endtime'] ?>";
            hostName.innerHTML = "Host name: "+"<?= $data[$i]['host'] ?>";
            id.innerHTML = "Quiz ID: "+"<?= $data[$i]['id'] ?>";
            button.innerHTML = "Attempt";
            quizDate.innerHTML = "Date of conduct: "+"<?= $data[$i]['q_date'] ?>";

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
        <?php } ?>
    </script>
</body>