<?php 
    session_start();
    $email=$_SESSION['mail'];
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }
    $connect=mysqli_connect("localhost","root","","userInfo");
    $sql="SELECT * FROM usertable WHERE uGmail='$email'";
    $result=mysqli_query($connect,$sql);
    $row = $result->fetch_assoc();
    $username=$row['uName'];
 
    $conn = mysqli_connect("localhost", "root", "",$username);
    if(!$conn)
    {
        echo "cool";
    }
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

    $id=$_POST['submitted'];
    $sql="SELECT * FROM quizes WHERE id = '$id'";
    $result=mysqli_query($connect, $sql);
    $data=$result->fetch_assoc();

    $q_name=$data['name'];
    $host=$data['host'];
    $q_date=$data['date'];
    $starttime=$data['start time'];
    $endtime=$data['end time'];
    $duration=$data['duration'];

    $sql="SELECT * FROM usertable WHERE uName='$host'";
    $result=mysqli_query($connect,$sql);
    $row = $result->fetch_assoc();
    $host_email=$row['uGmail'];

    $sql = "INSERT INTO reg_quizes (id,host,q_date,starttime,endtime,duration,q_name)  VALUES('$id','$host','$q_date','$starttime','$endtime','$duration','$q_name')";
    mysqli_query($conn, $sql);

    $connect_res= mysqli_connect("localhost","root","",$host);
    $table=$q_name."responses";
    $sql_query="INSERT INTO '$table' (username) VALUES('$username')";
    mysqli_query($connect_res,$sql_query);

    $msg_host="Candidate $username have Registered to quiz: $q_name and quiz-ID: $id";
    $Subject="Regarding Quiz: $q_name registration";
    $headers = "From: SSL@gmail.com" . "\r\n" ."CC: $email ";
    mail("$host_email",$Subject,$msg_host,$headers);
?>

<html>
    <head>
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

    <body>
    <div id="layout"></div>
     <div id="dlgbox">
         <div id="head">Compete</div>
         <div id="body">Registered Successfully</div>
         <div id="footer"><button onclick="ok()">OK</button></div>
     </div>
     <script type="text/javascript">
        function ok()
        {
            var whitebg = document.getElementById("layout");
            var dlg = document.getElementById("dlgbox");
            whitebg.style.display = "none";
            dlg.style.display = "none";
            window.location.href="register.php";
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
    </body>
</html>

<?php echo '<script type="text/javascript">ALERT()</script>'; ?>