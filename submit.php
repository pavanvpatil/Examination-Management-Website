<?php

    session_start();
    $user= $_SESSION['user'];
    $host= $_SESSION['host'];
    $qname= $_SESSION['qname'];
    
    $qname= $qname;

    $qname= $qname."responses";
    
    
   $conn1= mysqli_connect("localhost","root",'',"$host");
    // $sql= "CREATE TABLE IF NOT EXISTS `$host`.`$qname`";
    echo $qname;
    echo "<br>";
    echo $host.$qname;
    $sql= "INSERT INTO `xyzresponses` (`username`) VALUES ('anandishegde@gmail.com');";
   if(! $conn1->query($sql))
   {
       echo $conn1->error;
   }
   echo "<br>";
    $id=$conn1->insert_id;

    $answers= $_POST['values'];
    print_r($answers);
    echo $qname;
    
    for ($i=1;$i<=sizeof($answers);$i++)
    {
        $j= $i-1;
        $val= $answers[$j];
        echo $qname;
        echo "<br>";

        $sql= "UPDATE `".$qname."` SET `$i` = '$val' WHERE `$qname`.`no` = $id;";
        echo $sql;
        if(!$conn1->query($sql))
        {
            echo $conn1->error;
        }
    }


    
    


?>







