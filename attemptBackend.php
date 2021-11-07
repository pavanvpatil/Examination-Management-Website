<?php
    $id = $_POST['submitted'];
    session_start();
    $username = $_SESSION['user'];
    $connect = mysqli_connect("localhost", "root", "", $username);
    $sql="SELECT * FROM reg_quizes WHERE id = '$id'";
    $_SESSION['id']= $id;
    $result=mysqli_query($connect, $sql);
    $data=$result->fetch_assoc();
    $_SESSION['q_current_table'] = $data['q_name'];
    $_SESSION['q_host_db'] = $data['host'];
    $_SESSION['q_end_time']=$data['endtime'];
    $_SESSION['q_start_time']=$data['starttime'];
   
    
    header("Location: display-questions.php");
?>