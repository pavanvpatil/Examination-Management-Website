<head>
    <title>Compete</title>
    <link rel="stylesheet" href="style_sign.css">
    <link rel="icon" href="Website-icon/letter_q.png">
</head>

<div id="layout"></div>
     <div id="dlgbox">
         <div id="head">Compete</div>
         <div id="body">Username or Email Already Exists</div>
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
    $nameerror=$ageerror=$inerror=$emailerror=$passerror=$cpasserror=$perror="";
    $Username=$cpassword=$password="";
    $conn = mysqli_connect('localhost', 'root', '');
    $sqlQuery = 'CREATE DATABASE IF NOT EXISTS userInfo ;';
    mysqli_query($conn,$sqlQuery);
    $conn1 = mysqli_connect('localhost', 'root', '', 'userInfo');
    $query = 'CREATE TABLE IF NOT EXISTS userTable(
        uName VARCHAR(120) NOT NULL, 
        uGmail VARCHAR(200) NOT NULL,
        uAge INT NOT NULL, 
        uInstitute VARCHAR(120) NOT NULL, 
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

        if($flag!=0)
        {
            $sql= "SELECT uName FROM userTable WHERE uName='$Username'";
            $result= $conn1->query($sql);
            $sql= "SELECT uName FROM userTable WHERE uGmail='$Email'";
            $result1= $conn1->query($sql);
            if($result->num_rows>0)
            {
                echo '<script type="text/javascript">ALERT()</script>';
            }
            else if($result1->num_rows>0)
            {
                echo '<script type="text/javascript">ALERT()</script>';
            }      
            else
            {
                if($flag==1)
                {
                    $sql= "INSERT INTO userTable (uName,uGmail,uAge,uInstitute,uPassword) VALUES('$Username','$Email','$age','$Insti','$password');";
                    if($conn1->query($sql))
                    {
                        //echo 'Created the account successfully';
                        $msg = "*Thank you for Creating Account in our Exam Management Compete\n\n*Following are the information that You have given:\n >>Username= $Username\n >>Password= $password";
                        $subject= "Thank You for Signing Up in Compete Website";
                        // use wordwrap() if lines are longer than 70 characters
                        $msg = wordwrap($msg,70);
                        $txt = "Hello world!";
                        $headers = "From: SSL@gmail.com" . "\r\n" ."BCC: anandishegde@gmail.com";
                        // send email
                        if(mail("$Email",$subject,$msg,$headers))
                        {
                            //echo 'mailed successfully';
                        }
                        else
                        {
                            echo "sesesfes";
                        } 
                        header("location: index.php?flag=$flag");
                    }
                }
            }
        }
    }
?>
<body>
    <h2>SignUp</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="SignUP">
        <div id="userinfo">
        <legend style="font-size:25px;text-align:center">User-details</legend>
        <h3 style="color: yellow;">* Required</h3>
            <span style="color: yellow">*</span> 
            Username: <span style="color: yellow;"><?php echo $nameerror; ?></span>
            <input type="text" name="Username" placeholder="Username"><br>
            <span style="color: yellow">*</span> 
            Age: <span style="color: yellow;"><?php echo $ageerror; ?></span>
            <input type="number" name="Age" placeholder="Age"> <br>
            <span style="color: yellow">*</span> 
            Insititute: <span style="color: yellow;"><?php echo $inerror; ?></span>
            <input type="text" name="Institute" placeholder="Institute"><br>
        </div>
        <div id="login_details">
            <legend style="font-size:25px;text-align:center">Login-details</legend><br><br><br>
            <span style="color: yellow">*</span> 
            Email-ID: <span style="color: yellow;"><?php echo $emailerror; ?></span>
            <input type="text" name="Email" placeholder="Email-Id"><br>
            <span style="color: yellow">*</span> 
            Create Password: <span style="color: yellow;"><?php echo $passerror; ?></span>
            <input type="password" name="CrPassword" placeholder="********"> <br>
            <span style="color: yellow">*</span> 
            Confirm Password: <span style="color: yellow;"><?php echo $cpasserror; ?></span>
            <input type="password" name="CnPassword" placeholder="********">
            <span style="color: yellow;"><br><?php echo $perror; ?></span>
            </div>
        </div>
        <button type="submit" name="sign" id="Sign_up">SignUp</button>
        <a href="index.php" style="font-size:20px;color:blue;">Back</a>
        </form>
</body>


