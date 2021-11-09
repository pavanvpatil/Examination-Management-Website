<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body{
            background-image: linear-gradient(170deg,rgb(59, 59, 238), white);
            font-family: 'Courier New', Courier, monospace;;
        }
        #container{
            flex-direction:row;
            display:flex;
            justify-content:center;
            margin-top:15%;
        }
        form{
            flex-direction:column;
            display:flex;
            justify-content:center;
            background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
            padding:10px;
            color:white;
            border:1px solid black;
            border-radius:5px;
            font-family: 'Courier New', Courier, monospace;
            font-weight:700;
            width:30%;
            height:200px;
            font-size:20px;
        }
        input{
            width:100%;
            font-family: 'Courier New', Courier, monospace;
            font-weight:700;
            border-radius:3px;
            border:1px solid white;
        }
        #submit{
    text-align: center;
    font-family: 'Courier New', Courier, monospace;
    border: 1px solid white;
    font-size: 20px;
    font-weight: 600;
    padding: 0.5%;
    margin-left:24%;
    width:50%;
    color: white;
    border-radius: 5px;
    background-color: teal;
    cursor: pointer;
}

#submit:hover{
    background-color: rgb(75, 35, 187);
    color: white;
    transition: 0.3s;
}
    </style>
   
</head>
<body>
    <div id="container">
    <form action="" method="post">
        <input type="text" name="email" id="email" placeholder="Email-Id"><br>
        <input type="submit" name="sendotp" value="Send OTP" id="submit">
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
        if(isset($_POST['sendotp']))
        {
            $Email= $_POST['email'];
            $conn= mysqli_connect('localhost','root','','userinfo');
            $sql= "SELECT * FROM `usertable` WHERE `uGmail`='$Email';";
            $result= $conn->query($sql);
            
            if(!$result->fetch_assoc())
            {
               
                echo "<script> alert('There is no account with the given Email Id');</script>";
            }
            
            else{

            

            session_start();
            
            //echo 'Created the account successfully';
            $otp= rand(100000,999999);
            $msg = "Your OTP for Changing the password is $otp";
            $conn= mysqli_connect("localhost","root","","userinfo");
            $sql= "CREATE TABLE IF NOT EXISTS `userinfo`.`otp` ( `EMAIL` VARCHAR(30) NOT NULL , `OTP` INT(8) NOT NULL,`NO` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`NO`) ) ENGINE = InnoDB;";
            if(!$conn->query($sql))
            {
                echo $conn->error;
            }
            $sql= "INSERT INTO `otp` (`EMAIL`, `OTP`) VALUES ('$Email', '$otp');";
            $conn->query($sql);
            $subject= "Compete Password Assistance";    
            $msg = wordwrap($msg,70);
            $txt = "Hello world!";
            $headers = "From: Compete@example.com" . "\r\n" ."BCC: anandishegde@gmail.com";//200030041@iitdh.ac.in, 200010022@iitdh.ac.in
            // send email

            if(mail("$Email",$subject,$msg,$headers))
            {
                $_SESSION['emailp']=$Email;
                header("Location: enterotp.php");
            }     
            else
            {
                echo "The verification Email Couldn't be sent.Please try again later";
            
            } 
        }
    }
?>