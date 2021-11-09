<?php
        session_start();
        $conn= mysqli_connect('localhost','root','','userinfo');
        if(@$_POST['submit'])
        {
            $Email= $_SESSION['emailp'];
           $password= $_POST['password'];
           $sql= "UPDATE usertable
           SET 
                uPassword='$password'
            WHERE uGmail='$Email';";
            if($conn->query($sql))
            {
                header("Location: index.php?flag=2");
            } 
            else
            {
                echo $conn->error;
                echo "There was en error in updating Your password";
            }
        }
    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>New Password</title>
    <style>
        body{
            background-image: linear-gradient(170deg,rgb(59, 59, 238), white);
        }
        #container{
            display:flex;
            flex-direction:row;
            justify-content:center;
            margin-top:10%;
        }
        form{
            display:flex;
            flex-direction:column;
            justify-content:center;
            font-family: 'Courier New', Courier, monospace;
            background-image: linear-gradient(170deg, teal, rgb(85, 85, 231));
            color:white;
            padding:2%;
            font-size:17px;
            font-weight:700;
            border-radius:3px;
        }
        #submit{
            margin-top:6%;
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            border: 1px solid white;
            font-size: 17px;
            font-weight: none;
            padding: 1%;
            color: white;
            border-radius: 5px;
            background-color: teal;
            cursor: pointer;
            margin-left:40%;
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
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password"><br>
        <label for="password">Confirm New Password:</label>
        <input type="password" name="cpassword" id="cpassword" onkeyup="compare()">
        <div class="submit">
        <input type="submit" value="Save" id='submit' class="btn btn-primary mb-3" name="submit" disabled>
        </div>
    </form>
    </div>

    <script>
        function compare(){
        var x= document.getElementById("password").value;
        var y= document.getElementById("cpassword").value;
        if(x==y)
        {   
            console.log("correct");
            document.getElementById("submit").disabled= false;
        }   
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>