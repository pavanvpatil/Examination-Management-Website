<?php
    session_start();
    $id = $_POST['submitted'];
    $username = $_SESSION['user'];
    $conn1 = mysqli_connect("localhost", "root", "", "userInfo");
    $sql = "SELECT * FROM quizes WHERE id = '$id'";
    $result = mysqli_query($conn1, $sql);
    $data = $result->fetch_assoc();
    $tableName = $data['name']."responses";
    $conn = mysqli_connect("localhost", "root", "", "$username");
    $sql = "SELECT* FROM $tableName";
    $result1 = mysqli_query($conn, $sql);
    $data1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
?>
<head>
    <title>Compete</title>
<link rel="icon" href="Website-icon/letter_q.png">
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
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
        }
        .parent{
            margin: 2%;
            font-family: 'Courier New', Courier, monospace;
            margin-top: 4%;
            padding: 6%;
            color: white;
            border-radius: 3px;
            background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
            height: auto;
            width: auto;
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
        .printBtn{
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
            padding: 0.8rem;
            font-size: 1.1rem;
            border: .6px solid darkblue;
            border-radius: 4px;
            color: white;
            background:rgb(102, 48, 84);
            margin: 3%;
        }
        .printBtn:hover{
            background-color: green;
            transition: 0.7s;
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
    <h1 id= "heading">Registered candidates for the quiz : <?php echo $data['name']; ?> </h1>
    <div id="container"></div>
    <div style="display: flex; justify-content: center;">
        <button class="printBtn" onclick="switchs()">Back</button>
    </div>
   
    <script>
        var container = document.getElementById("container");
    <?php for($i=0; $i<sizeof($data1); $i++){ ?>
        var parent = document.createElement("div");
        var c_name = document.createElement("h2");
        var c_score = document.createElement("h2");
        c_name.className = "info";
        c_score.className = "info";
        parent.className = "parent";
        c_name.innerHTML = "Candidate name: "+"<?= $data1[$i]['username'] ?>";
        c_score.innerHTML = "Candidate result: "+"<?= $data1[$i]['result']  ?>";
        parent.appendChild(c_name);
        parent.appendChild(c_score);
        container.appendChild(parent);
    <?php }?>
    if(container.childNodes.length == 0){
        var y = document.getElementById("heading");
        y.innerHTML = "No candidates registered";
    }
    function switchs(){
        location.replace("hosted_quizes.php");
    }
    </script>
</body>