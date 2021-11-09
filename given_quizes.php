<?php 
    session_start();
    $username = $_SESSION['user'];
    $conn = mysqli_connect("localhost", "root", "",$username);
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
    $conn = mysqli_connect("localhost", "root", "", $username);
    $sql = "SELECT * FROM reg_quizes WHERE attempted = 1";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<head>
<link rel="icon" href="Website-icon/letter_q.png">
<title>Compete</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
         body{
            margin: 0px;
            padding: 0px;
            background-image: linear-gradient(170deg,rgb(243, 247, 247),rgb(166, 239, 252) );
        }
        #container{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .parent{
            width: 25rem;
            position: relative;
            left: -20;
            font-family: 'Courier New', Courier, monospace;
            padding: 15%;
            margin: 4% 0%;
            background-color: teal;
            color: white;
            border-radius: 5px;
            background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
        }
        .parent:hover{
            box-shadow: 3px 3px 20px black;
            transition: 0.2s;
        }
        .btn{
            font-size: 20px;
            border:1px solid white;
            color:black;
            text-decoration: none;
            border-radius: 3px;
            padding: 2%;
            background-color: rgb(166, 239, 252);
            cursor: pointer;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
            float: right;
        }
        .btn:hover{
            color: white;
            background-color: green;
            transition: 0.4s
        }
        #heading{
            font-family: 'Courier New', Courier, monospace;
            color: rgb(66, 66, 66);
            text-align: center;
        }
        /* navbar */
        .topnav {
            font-weight:600;
            font-family: 'Courier New', Courier, monospace;
            overflow: hidden !important;
            position: relative !important;
            background-color:rgb(176, 237, 248);
            height: auto;
            width: auto;
            position: sticky !important;
            top: 0;
            border: 1px solid black;
            z-index: 100;
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
    <span style="font-size:17px;color:blue;"><i class="fas fa-user-alt"></i> <?php echo "$username"; ?></span>
    </div> 
    </div>
    <h1 id="heading">Attempted quizes</h1>
    <div id="container"></div>
    <script>
        var container = document.getElementById("container");
        <?php for($i=0; $i<sizeof($data); $i++){ ?>
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "view_result.php";
            var parent = document.createElement("div");
            var q_name = document.createElement("h2");
            var q_id = document.createElement("h2");
            var q_date = document.createElement("h2");
            var button = document.createElement("button");
            button.value = <?= $data[$i]['id'] ?>;
            button.type = "submit";
            button.name = "submitted";

            button.innerHTML = "View Result";
            q_name.innerHTML = "Quiz name: "+"<?= $data[$i]['q_name']?>"
            q_id.innerHTML = "Quiz ID: "+"<?= $data[$i]['id']?>"
            q_date.innerHTML = "Quiz date: "+"<?= $data[$i]['q_date'] ?>"

            parent.className = "parent";
            q_name.className = "info";
            q_id.className = "info";
            q_date.className = "info";
            button.className = "btn"
            parent.appendChild(q_name);
            parent.appendChild(q_id);
            parent.appendChild(q_date);
            parent.appendChild(button);
            form.appendChild(parent)
            container.appendChild(form);
        <?php } ?>
        if(container.childNodes.length == 0){
            var y = document.getElementById("heading");
            y.innerHTML = "No quizes attempted";
        }
    </script>
</body>