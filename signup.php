<?php 
    $nameerror=$ageerror=$inerror=$emailerror=$passerror=$cpasserror=$perror="";
    $Username=$cpassword=$password="";
    $conn = mysqli_connect('localhost', 'root', '');
    $sqlQuery = 'CREATE DATABASE IF NOT EXISTS userInfo ;';
    mysqli_query($conn,$sqlQuery);
    $conn1 = mysqli_connect('localhost', 'root', '', 'userInfo');
    $query = 'CREATE TABLE IF NOT EXISTS userTable(
        uName VARCHAR(120) NOT NULL, 
        uGmail VARCHAR(200) NOT NULL,
        uAge INT NOT NULL, uInstitute VARCHAR(120) NOT NULL, 
        uPassword VARCHAR(50) );';
    mysqli_query($conn1,$query);
    $flag=1;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["Username"])){
            $flag=0;
            $nameerror="Name is required";
        }  
        else
             $Username=$_POST['Username'];
        if(empty($_POST['Email'])){
            $flag=0;
            $emailerror="Email required";
        }
        else
             $Email= $_POST['Email'];
        if(empty($_POST['Age'])){
            $flag=0;
            $ageerror= "Age required";
        }   
        else
             $age= $_POST['Age'];
        if(empty($_POST['Institute'])){
            $flag=0;
            $inerror="Institute name required";
        } 
        else
             $Insti= $_POST['Institute'];
        if(empty($_POST['CrPassword'])){
            $flag=0;
            $passerror="Password required";
        }   
        else{
            $password= $_POST['CrPassword'];
        }
        if(empty($_POST['CnPassword'])){
            $flag=0;
            $cpasserror="Password required";
        }  
        else{
            $cpassword=$_POST['CnPassword'];
        }
        if($password!=$cpassword){
            $perror="Password does not match";
            $flag=0;
        }
        $sql= "SELECT uName FROM userTable WHERE uName='$Username'";
        $result= $conn1->query($sql);
        if($result->num_rows>0)
        {
            echo "<script>alert('Username Already exists')</script>";
        }
        else
        {
            if($flag==1)
            {
                $sql= "INSERT INTO userTable (uName,uGmail,uAge,uInstitute,uPassword) VALUES('$Username','$Email','$age','$Insti','$password');";
                if($conn1->query($sql))
                {
                    //echo 'Created the account successfully';
                    $msg = "Thank you for registering in our Exam management application\n\nFollowing are the information that u have entered\n username= $Username\n password= $password";
                    $subject= "Thanks for signing up";
                    // use wordwrap() if lines are longer than 70 characters
                    $msg = wordwrap($msg,70);
                    $txt = "Hello world!";
                    $headers = "From: webmaster@example.com" . "\r\n" .
                    "BCC: anandishegde@gmail.com";//200030041@iitdh.ac.in, 200010022@iitdh.ac.in
                    // send email
                    if(mail("$Email",$subject,$msg,$headers))
                    {
                        //echo 'mailed successfully';
                    }
                    else
                    {
                        echo "sesesfes";
                    } 
                    header("location: index.php?user=$flag");
                }
            
            }
        }
    }
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="SignUP">
        <h2>Sign Up</h2>
        <h3 style="color: yellow;">* Required</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!--Sign up-->
            <span style="color: yellow">*</span> 
            Username: <span style="color: yellow;"><?php echo $nameerror; ?></span>
            <input type="text" name="Username"><br>
            <span style="color: yellow">*</span> 
            Age: <span style="color: yellow;"><?php echo $ageerror; ?></span>
            <input type="number" name="Age"> <br>
            <span style="color: yellow">*</span> 
            Insititute: <span style="color: yellow;"><?php echo $inerror; ?></span>
            <input type="text" name="Institute"> <br>
            <fieldset>
            <legend style="font-size:20px">Login-details</legend><br>
            <span style="color: yellow">*</span> 
            Email ID: <span style="color: yellow;"><?php echo $emailerror; ?></span>
            <input type="text" name="Email"><br>
            <span style="color: yellow">*</span> 
            Create Password: <span style="color: yellow;"><?php echo $passerror; ?></span>
            <input type="password" name="CrPassword"> <br>
            <span style="color: yellow">*</span> 
            Confirm Password: <span style="color: yellow;"><?php echo $cpasserror; ?></span>
            <input type="password" name="CnPassword"> <br>
            <span style="color: yellow;"><?php echo $perror; ?></span>
            </fieldset> 
            <button type="submit" name="sign" id="Sign_up">Sign Up</button>&emsp;&emsp;&emsp;&emsp;
            <a href="index.php" style="font-size:20px;color:yellow;">Back</a>
        </form>
    </div>
</body>


