<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php
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