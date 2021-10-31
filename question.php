<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Extra/letter_q.png">
    <title>Add questions</title>
    <link rel="stylesheet" href="questionsadd.css">
    <style>
        .form{
            display: flex;
            flex-direction:column;
            justify-content: center;
        }
        input{
            margin: 10px 5px;
        }

    </style>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }
    ?>
    
    <div class="x">
        <h1>Host a Quiz</h1>
        <form action="" method="post" >
            <div class="form">    
                <div class="name a">
                <label for="qname">Quiz Name</label><br>
                <input type="text" name="qname" id="qname" placeholder="ex: Programming quiz" required> </div>
                <div class="date a">
                <label for="qdate">Quiz date</label><br>
                <input type="date" name="qdate" id="qdate" required> </div>

                <div class="qstime a">
                <label for="qstime">Quiz Start time: </label><br>
                <input type="time" name="qstime" id="qstime" step="1" required></div>

                <div class="qetime a">
                <label for="qetime">Quiz end time:</label><br>
                <input type="time" name="qetime" id="qetime" step="1" required></div>
                
                <div class="eligibility a">
                <label for="eligibility">Eligibility</label></div><br>
                <div class="submit">

                
                <input type="submit" name="add" value="Create" id="submit"></div>
            </div>
        </form>
    </div>

    <?php
    $conn = mysqli_connect('localhost', 'root', '');
    $sqlQuery = 'CREATE DATABASE IF NOT EXISTS userInfo ;';
    $username= $_SESSION['user'];
    
    $sql= "CREATE DATABASE IF NOT EXISTS `$username`";
    if(!$conn->query($sql))
    {
        echo "eroor creating database";
    }
    
    
    mysqli_query($conn, $sqlQuery);
    $sql= 'CREATE TABLE IF NOT EXISTS `userinfo`.`quizes` ( `id` INT NOT NULL AUTO_INCREMENT ,
    `host-Email` TEXT NOT NULL ,
    `date` DATE NOT NULL , 
    `start time` TIME NOT NULL , 
    `end time` TIME NOT NULL , 
    `duration` TIME NOT NULL ,
    `name` TEXT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $conn->query($sql);
    


    if(isset($_POST['add']))
    {
    $name= $_POST['qname'];
    $stime= $_POST['qstime'];
    $etime=$_POST['qetime'];
    $date= $_POST['qdate'];
     
     
    $start_date = new DateTime("2007-09-01 $stime");
    $since_start = $start_date->diff(new DateTime("2007-09-01 $etime"));
    $seconds= 0;
    $start= strtotime($stime);
    $end= strtotime($etime);
    $seconds= $end- $start; 




    // $seconds += $since_start->h * 60*60;
    // $seconds += $since_start->i*60;
    // $seconds+= $since_start->s;
    
    if($seconds<=0)
    {
        echo "please select proper start and end times";
    }
    else{

    
    $sql= "INSERT INTO `userinfo`.`quizes` (`id`, `host-Email`, `date`, `start time`, `end time`, `duration`, `name`) 
    VALUES (NULL,'$username' , '$date', '$stime', '$etime', '$seconds', '$name');";

    if(!$conn->query($sql))
    {
        echo $conn->error;
    }
    // $conn1 = mysqli_connect('localhost', 'root', '', $username);
    
    $_SESSION['qname']= $name;
    header("Location: questionsadd.php");
    }

    }


    

    



    







    
    
    
   
    ?>


</body>
</html>