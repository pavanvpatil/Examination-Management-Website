<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
   
</head>
<body>
<?php
        if(isset($_POST['sendotp']))
        {
            $Email= $_POST['email'];
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
    ?>
    <form action="" method="post">
        <input type="text" name="email" id="email">
        <input type="submit" name="sendotp" value="Send OTP">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>