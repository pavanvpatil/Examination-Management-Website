<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
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
        }
        #head{
            background-color: rgb(91, 91, 216);
            color: white;
            padding: 5px;
            text-align: center;
            margin: 5px 5px 0px 5px;
        }
        #body{
            background-color: rgb(181, 181, 241);
            color: rgb(20, 19, 19);
            padding: 5px;
            text-align: center;
            margin: 5px 5px 0px 5px;
        }
        #footer{
            background-color:rgb(91, 91, 216);
            color: white;
            padding: 5px;
            text-align: center;
            margin: 5px 5px 0px 5px;
            margin-bottom: 5px;
        }
        #footer button{
            color: brown;
            background-color: #fff;
            width: 40%;
            border-color: black;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px;
        }
        #footer button:hover{
            background-color: cyan;
            transition: 0.5s;
        }
    </style>
</head>
<body>
<div id="layout"></div>
     <div id="dlgbox">
         <div id="head">Website name</div>
         <div id="body">Sign-Up Successfull</div>
         <div id="footer"><button onclick="ok()">OK</button></div>
     </div>
     <script type="text/javascript">
        function ok(){
            var whitebg = document.getElementById("layout");
            var dlg = document.getElementById("dlgbox");
            whitebg.style.display = "none";
            dlg.style.display = "none";
        }
        function ALERT(){
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
        if($_GET['user']==1)
            echo '<script type="text/javascript">ALERT()</script>';
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
?>

    <h1>DARE2COMPETE</h1>
    <!--<center><p id="errors"></p></center>-->
    <div class="container">
        <div  id='bgm'></div>
        <div class="Login">
            <div style="text-align:center"><span style="font-size:40px;">Login User</span></div>
            <form action="" method="post"> <!--Login form-->
                 <div id="email">
                 <input type="text" name="Email" placeholder="Email-Id"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required> <br>
                 </div>
                 <div id="password">
                 <input type="password" name="Password" placeholder="Password" required> <br>
                 </div>
                <div id="btnlogin">
                <button type="submit" value="login" name='login'>Log in</button><br><br>
                </div>
                <a href="" style="color:yellow;">Forgot Password</a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <a href="signup.php" style="color:yellow;">Sign Up</a>
            </form>
        </div>
    </div>
</body>
</html>