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

            heading.innerHTML = "Quiz name: <br> "+"<?= $data[$i]['q_name'] ?>";
            startTime.innerHTML = "Start time(24hrs format): <br> "+"<?= $data[$i]['starttime'] ?>";
            endTime.innerHTML = "End time(24hrs format): <br> "+"<?= $data[$i]['endtime'] ?>";
            hostName.innerHTML = "Host name: <br> "+"<?= $data[$i]['host'] ?>";
            id.innerHTML = "Quiz ID: <br> "+"<?= $data[$i]['id'] ?>";
            button.innerHTML = "Attempt";
            quizDate.innerHTML = "Date of conduct: <br> "+"<?= $data[$i]['q_date'] ?>";

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