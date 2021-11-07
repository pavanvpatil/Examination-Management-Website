<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Extra/letter_q.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="SliderCode/slider-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Compete</title>
    <style>
        #layout{
            display: none;
                width: 100%;
                height: 100%;
                position: fixed;
                top: 0px;
                left: 0px;
                background-color: #fefefe;
                opacity: 0.7;
                z-index: 9999;
        }
        #dlgbox{
            display: none;
           background-color: rgb(48, 47, 46);
           margin: 1px 1px 1px 1px;
           width: 300px;
           position: fixed;
           z-index: 9999;
           border-radius: 5px;
           font-weight:800;
        }
        #head{
            background-color: rgb(91, 91, 216);
            color: white;
            padding: 5px;
            text-align: center;
            margin: 5px 5px 0px 5px;
            font-weight:800;
        }
        #body{
            background-color: rgb(181, 181, 241);
            color: rgb(20, 19, 19);
            padding: 5px;
            text-align: center;
            margin: 5px 5px 0px 5px;
            font-weight:800;
        }
        #footer{
            background-color:rgb(91, 91, 216);
            color: white;
            padding: 5px;
            text-align: center;
            margin: 5px 5px 0px 5px;
            margin-bottom: 5px;
            font-weight:800;
        }
        #footer button{ 
            color: brown;
            background-color: #fff;
            width: 20%;
            border-color: black;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px;
            font-weight:800;
        }
        #footer button:hover{
            background-color: cyan;
            transition: 0.5s;
        }
    </style>
</head>
<body style="font-family: 'Courier New', Courier, monospace;">
<?php
    session_start();
    if(isset($_SESSION['loggedin']))
    {
        header("Location: homepage.php");
    }
?>

<div id="layout"></div>
     <div id="dlgbox">
         <div id="head">Compete</div>
         <div id="body">Sign-Up Successfull <br> Information regarding Username and Password is sent to Your Mail-Id</div>
         <div id="footer"><button onclick="ok()">OK</button></div>
     </div>
     <script type="text/javascript">
        function ok()
        {
            var whitebg = document.getElementById("layout");
            var dlg = document.getElementById("dlgbox");
            whitebg.style.display = "none";
            dlg.style.display = "none";
        }
        function ALERT()
        {
            var whitebg = document.getElementById("layout");
            var dlg = document.getElementById("dlgbox");
            whitebg.style.display = "block";
            dlg.style.display = "block";
            
            var winWidth = window.innerWidth;
            var winHeight = window.innerHeight;
            
            dlg.style.left = (winWidth/2) - 300/2 + "px";
            dlg.style.top = "150px";
        }
    </script>

<?php
    if($_GET)
    {
        if($_GET['flag']==1)
        {
            echo '<script type="text/javascript">ALERT()</script>';
        }
    }
    $conn = mysqli_connect('localhost', 'root', '');
    $sqlQuery = 'CREATE DATABASE IF NOT EXISTS userInfo ;';
    mysqli_query($conn, $sqlQuery);
    $conn1 = mysqli_connect('localhost', 'root', '', 'userInfo');
    $query = 'CREATE TABLE IF NOT EXISTS userTable(
        uName VARCHAR(120) NOT NULL, 
        uGmail VARCHAR(200) NOT NULL,
         uAge INT NOT NULL, uInstitute VARCHAR(120) NOT NULL, 
         uPassword VARCHAR(50) ); ';
    mysqli_query($conn1, $query);
    @$login= $_POST['login'];
    if($login)
    {
        $Email= $_POST['Email'];
        $password= $_POST['Password'];
        $query= "SELECT * FROM userTable WHERE uGmail='$Email'";
        $result= $conn1->query($query);
        if($result->num_rows>0)
        {
            $use= 1;
            $row= $result->fetch_assoc();
            // THIS WILL LOGIN THE USER ANY SESSION RELATED ACTIVITIES THAT MUST HAPPEN DURING LOGIN SHOULD BE DONE HERE
            if($password==$row['uPassword'])
            {
                $_SESSION['loggedin']= true;
                $_SESSION['mail']= $Email;          
                header("Location:homepage.php"); 
                $z=1;
            }
        }
    }
?>
    
    <div class="logo_title">
        <!-- <img src="logo.png" alt="image not loaded" width=100px height=100px style="border-radius: 50%;margin-top: 1.8%;"> -->
        <h1 id="title" style="letter-spacing: 0.1rem;font-size:100px;"></i><i class="fa-solid fa-arrow-trend-up" style="font-size: 70px; color: white; letter-spacing: 1rem"></i>COMPETE</h1>
    </div>
   <!-- <center><p id="errors"></p></center> -->
    <div class="container">
        <!-- <div class="slideContainer" id="#bgm">
            <div class="slider">
                <img src="sliderImages/5.jpeg" alt="" id="img">
            </div>
            <div class="slider">
                <img src="sliderImages/6.jpeg" alt="" id="img">
            </div>
            <div class="slider">
                <img src="sliderImages/1.jpeg" alt="" id="img">
            </div>
            <div class="slider">
                <img src="sliderImages/2.jpeg" alt="" id="img">
            </div>
            <div class="slider">
                <img src="sliderImages/3.jpeg" alt="" id="img">
            </div>
            <div class="slider">
                <img src="sliderImages/4.jpeg" alt="" id="img">
            </div>
            <span class="button left" onclick="control(-1)">&#10094</span>
            <span class="button right" onclick="control(1)">&#10095</span>
        </div>  -->
        <div class="Login">
        <div style="text-align:center;margin-bottom:6%" >
                <span style="font-size:35px;color:white;font-weight:650;">
                    Login User
                <span>
        </div>
            <form method="post"> <!--Login form-->
                 <div id="email">
                 <i class="fa-solid fa-user-large"></i><input type="text"  name="Email" placeholder="Email-Id"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required><br>
                 </div>
                 <div id="password">
                 <i class="fa-solid fa-lock"></i><input type="password" name="Password" placeholder="Password" required><br>
                 <span style="color:yellow;" id="errors"></span><br>
                 </div>
                <div id="btnlogin">
                <input type="submit" style="font-family: 'Courier New', Courier, monospace;font-weight:800" value="Login" name='login' id="log"></input><br><br>
                </div>
                <div style="display: flex;flex-direction: row;">
                    <div style="text-align:center;margin-left:-7.5%"><a href="forgot_password.php" style="color:white;">Forgot Password</a></div>
                    <div style="margin-left:60%;margin-right:-2%;text-align:center;"><a href="signup.php" style="color:white;">Sign Up</a></div>
                </div>
            </form>
        </div>
    </div>
<!--<script src="SliderCode/slider-script.js"></script> -->

<?php 
//Checking for login details
//anand: I need this script at end. else the error message won't be displayed;
    if($login)
    {
        if(!isset($z))
        {
            ?>
            <script>document.getElementById('errors').innerHTML="*Password does not match"</script>
            <?php
        }
        if(!isset($use))
        {
            ?>
            <script>document.getElementById("errors").innerHTML="*There is no account with the given email"</script>
            <?php
        }
    }
?>
</body>
</html>